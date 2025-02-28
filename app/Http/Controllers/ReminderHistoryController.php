<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\ReminderHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ReminderHistoryController extends Controller
{

    /*** index function  ***/
    public function index()
    {
        $reminderHistory= ReminderHistory::whereAdminId(Auth::guard('admin')->id())->paginate();
        return view('pages.ReminderHistory.index', compact('reminderHistory'));
    }



    /*** destroy function  ***/
    public function destroy(ReminderHistory $reminderHistory)
    {
        $reminderHistory->delete();
        return redirect()->back()->with('alert-info','Data is deleted successfully');
    }


    /*** destroy function  ***/
    public function getReminder($id)
    {
        $data['reminders'] = Reminder::whereAdminId(Auth::guard('admin')->id())->where('id',$id)->get();
        return view('pages.Reminders.index', compact('data'));
    }


} //end of class
