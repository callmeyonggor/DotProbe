<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;

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

    public function profile(REquest $request, $id)
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
                case 'save':
                    dd($request);
                    break;
                case 'cancel':
                    return back();
                    break;
            }
        }
        return view('user/profile', [
            'user' => $user,
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
            if (Auth::check()) {
                foreach ($correctness as $key => $value) {
                    dump($key, $value, $response[$key]);
                }
            }

            $total_set = count($loop);
            $total_correct = array_count_values($correctness);
            $total_congruent = array_count_values($congruent);
            $all_response = array_sum($response);

            foreach(array_keys($congruent, 'congruent') as $value){
                $congruent_response += $response[$value];
            }

            foreach(array_keys($congruent, 'incongruent') as $value){
                $incongruent_response += $response[$value];
            }

            return view('/result/result', [
                'total_correct' => $total_correct['correct'] ?? 0,
                'avg_correct' => round((@$total_correct['correct'] / $total_set) * 100, 2) ?? 0,
                'avg_response' => round(($all_response / $total_set), 2) ?? 0,
                'total_congruents' => @$total_congruent['congruent'] ?? 0,
                'total_incongruents' => @$total_congruent['incongruent'] ?? 0,
                'avg_congruent_response'  => round(($congruent_response / $total_set),2) ?? 0,
                'avg_incongruent_response'  => round(($incongruent_response / $total_set),2) ?? 0,
            ]);
        }
    }
}
