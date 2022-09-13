<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Exports\ResultsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Attempt;
use App\Models\Result;

class RecordController extends Controller
{
    public function record($id)
    {
        $user = User::find($id);
        $record = Attempt::where('user_id', $id);
        if (!$user) {
            return redirect()->back()->with('fail_msg', 'Invalid Record, please try again later.');
        };

        if ((string)Auth::id() !== $id) {
            if (Gate::denies('isAdmin')) {
                abort(403, 'Unauthorized.');
            }
        }

        return view('/record/record', [
            'user' => $user,
            'record' => $record->paginate(10)
        ]);
    }

    public function record_detail($attempt, $id){
        $user = User::find($id);
        $record_detail = Result::where('user_id', $id)->where('attempt', $attempt);
        if (!$user) {
            return redirect()->back()->with('fail_msg', 'Invalid Record, please try again later.');
        };
        return view('/record/recorddetail', [
            'user' => $user,
            'attempt' => $attempt,
            'record_detail' => $record_detail->get()
        ]);
    }

    public function export($attempt, $id) 
    {
        $user = User::find($id);
        return (new ResultsExport($attempt, $id))->download($user->name.'_attempt_'.$attempt.'_result'.'.xlsx');
    }
}
