<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function user_listing(){
        $user = User::paginate(15);
        return view('user/listing',['user' => $user]);
    }
}
