<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function user_listing(Request $request){
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
        return view('user/listing',[
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
}
