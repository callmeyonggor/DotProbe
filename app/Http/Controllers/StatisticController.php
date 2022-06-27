<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class StatisticController extends Controller
{
    public function statistic($id)
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

        return view('/statistic/statistic', [
            'user' => $user,
        ]);
    }
}
