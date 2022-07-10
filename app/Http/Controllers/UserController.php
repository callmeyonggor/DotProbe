<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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

    public function result(Request $request){
        if ($request->isMethod('post')) {
        }

        return 1;
    }
}
