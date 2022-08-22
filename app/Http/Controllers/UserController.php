<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Attempt;
use App\Models\Result;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
    public function user_listing(Request $request)
    {
        $search = array();
        if ($request->isMethod('post')) {
            $submit_type = $request->input('submit');
            switch ($submit_type) {
                case 'search':
                    session(['user_search' => [
                        "freetext" =>  $request->input('freetext'),
                        "role" =>  $request->input('role'),
                        "sort" =>  $request->input('sort'),
                    ]]);
                    break;
                case 'reset':
                    session()->forget('user_search');
                    break;
            }
        }
        $search = session('user_search') ? session('user_search') : $search;
        return view('user/listing', [
            'submit' =>  route('user_listing'),
            'search' =>  $search,
            'user' => User::get_record($search, 10),
            'role_sel' => [
                ' ' => 'Please Select Role',
                '1' => 'User',
                '2' => 'Admin'
            ],
            'sort_sel' => [
                '1' => 'Ascending',
                '2' => 'Descending'
            ],
        ]);
    }

    public function profile(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('fail_msg', 'Invalid Record, please try again later.');
        };
        if ((string)Auth::id() !== $id) {
            if (Gate::denies('isAdmin')) {
                abort(403, 'Unauthorized.');
            }
        }
        if ($request->isMethod('post')) {
            $submit_type = $request->input('submit');
            switch ($submit_type) {
                case 'update_profile':
                    $post = (object) $request->all();
                    $validator = Validator::make($request->all(), [
                        'age' => ['required', 'numeric', 'gt:0'],
                        'height' => ['required', 'numeric', 'gt:0'],
                        'weight' => ['required', 'numeric', 'gt:0'],
                        'race' => ['required'],
                        'education' => ['required'],
                        'job' => ['required'],
                        'handedness' => ['required'],
                    ])->setAttributeNames([
                        'age' => 'Age',
                        'height' => 'Height',
                        'weight' => 'Weight',
                        'race' => 'Race',
                        'education' => 'Education',
                        'job' => 'Job',
                        'handedness' => 'Handedness',
                    ]);
                    if (!$validator->fails()) {
                        User::find(Auth::id())->update([
                            'age' => $request->input('age'),
                            'height' => $request->input('height'),
                            'weight' => $request->input('weight'),
                            'race' => $request->input('race'),
                            'education' => $request->input('education'),
                            'job' => $request->input('job'),
                            'handedness' => $request->input('handedness'),
                        ]);
                        Session::flash('success_msg', 'Profile update successfully.');
                        return back();
                    }
                    return view('user/profile', [
                        'user' => $user,
                        'handedness_sel' => [
                            ' ' => 'Please Select Handedness',
                            'Right' => 'Right',
                            'Left' => 'Left',
                            'Ambidextrous' => 'Ambidextrous(able to use both hands equally well for any task)'
                        ],
                        'education_sel' => [
                            ' ' => 'Please Select Education',
                            'Primary Level' => 'Primary Level',
                            'Secondary Level' => 'Secondary level (SPM) or equivalent',
                            'Training' => 'Trade/technical/vocational training',
                            'Form6' => 'Foundation, Diploma or equivalent',
                            'Bachelor' => "Bachelor's degree",
                            'Master' => "Master's degree",
                            'Professional' => 'Professional degree',
                            'Doctorate' => 'Doctorate degree',
                            'Other' => 'Other'
                        ],
                        'race_sel' => [
                            ' ' => 'Please Select Races',
                            'chinese' => 'Chinese',
                            'malay' => 'Malay',
                            'indian' => 'Indian',
                            'other' => 'Other'
                        ],
                        'post' => $post
                    ])->withErrors($validator);
                    break;
                case 'change_pass':
                    $validator = Validator::make($request->all(), [
                        'old_password' => ['required', new MatchOldPassword],
                        'new_password' => ['required'],
                        'repeat_password' => ['same:new_password'],
                    ])->setAttributeNames([
                        'old_password' => 'Old password',
                        'new_password' => 'New Password',
                        'repeat_password' => 'Repeat Password',
                    ]);
                    if (!$validator->fails()) {
                        User::find(Auth::id())->update([
                            'password' => Hash::make($request->input('new_password')),
                        ]);
                        Session::flash('success_msg', 'Password change successfully.');
                        return back();
                    }
                    return redirect()->back()->withErrors($validator);
                    break;
                case 'cancel':
                    return redirect()->route('home');
                    break;
            }
        }
        return view('user/profile', [
            'user' => $user,
            'handedness_sel' => [
                ' ' => 'Please Select Handedness',
                'Right' => 'Right',
                'Left' => 'Left',
                'Ambidextrous' => 'Ambidextrous(able to use both hands equally well for any task)'
            ],
            'education_sel' => [
                ' ' => 'Please Select Education',
                'Primary Level' => 'Primary Level',
                'Secondary Level' => 'Secondary level (SPM) or equivalent',
                'Training' => 'Trade/technical/vocational training',
                'Form6' => 'Foundation, Diploma or equivalent',
                'Bachelor' => "Bachelor's degree",
                'Master' => "Master's degree",
                'Professional' => 'Professional degree',
                'Doctorate' => 'Doctorate degree',
                'Other' => 'Other'
            ],
            'race_sel' => [
                ' ' => 'Please Select Races',
                'chinese' => 'Chinese',
                'malay' => 'Malay',
                'indian' => 'Indian',
                'other' => 'Other'
            ]
        ]);
    }

    public function result(Request $request)
    {
        $incongruent_response = 0;
        $congruent_response = 0;
        if ($request->isMethod('post')) {
            $response =  array_slice($request->input('response'), 1);
            $correctness = array_slice($request->input('correctness'), 1);
            $congruent = array_slice($request->input('congruent'), 1);
            $loop = array_slice($request->input('loops'), 1);

            $total_set = count($loop);
            $total_correct = array_count_values($correctness);
            $total_congruent = array_count_values($congruent);
            $all_response = array_sum($response);
            $total_congruents = isset($total_congruent['congruent']) ? $total_congruent['congruent'] : 0;
            $total_incongruents = isset($total_congruent['incongruent']) ? $total_congruent['incongruent'] : 0;
            $avg_response = round(($all_response / $total_set), 2) ?? 0;

            foreach (array_keys($congruent, 'congruent') as $value) {
                $congruent_response += $response[$value];
            }

            foreach (array_keys($congruent, 'incongruent') as $value) {
                $incongruent_response += $response[$value];
            }

            $avg_incongruent_response = $total_incongruents != 0 ? round(($incongruent_response / $total_incongruents), 2) : 0;
            $avg_congruent_response = $total_congruents != 0 ? round(($congruent_response / $total_congruents), 2) : 0;


            if (Auth::check()) {
                $attempt = Attempt::where('user_id', Auth::id())->latest()->get();
                if ($attempt->isEmpty()) {
                    Attempt::create([
                        'user_id' => Auth::id(),
                        'attempt' => 1,
                        'total_correct' => @$total_correct['correct'] ?? 0,
                        'total_incongruents' => $total_incongruents,
                        'total_congruents' => $total_congruents,
                        'avg_response' => $avg_response,
                        'avg_incongruent_response' => $avg_incongruent_response,
                        'avg_congruent_response' => $avg_congruent_response,
                    ]);
                } else {
                    Attempt::create([
                        'user_id' => Auth::id(),
                        'attempt' => $attempt[0]->attempt + 1,
                        'total_correct' => @$total_correct['correct'] ?? 0,
                        'total_incongruents' => $total_incongruents,
                        'total_congruents' => $total_congruents,
                        'avg_response' => $avg_response,
                        'avg_incongruent_response' => $avg_incongruent_response,
                        'avg_congruent_response' => $avg_congruent_response,
                    ]);
                }
                $attempt = Attempt::where('user_id', Auth::id())->latest()->get();
                foreach ($loop as $key => $value) {
                    Result::create([
                        'user_id' => Auth::id(),
                        'attempt' => $attempt[0]->attempt,
                        'response_time' => $response[$key],
                        'correctness' => $correctness[$key],
                        'congruency' => $congruent[$key],
                    ]);
                }
            }

            return view('/result/result', [
                'total_correct' => $total_correct['correct'] ?? 0,
                'avg_response' => $avg_response,
                'total_congruents' => $total_congruents,
                'total_incongruents' => $total_incongruents,
                'avg_congruent_response'  => $avg_congruent_response,
                'avg_incongruent_response'  => $avg_incongruent_response,
            ]);
        }
    }
}
