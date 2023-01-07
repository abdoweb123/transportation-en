<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReminderRequest;
use App\Models\Bus;
use App\Models\Issue;
use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{

    /*** index function  ***/
    public function index()
    {
        $data['reminders']= Reminder::latest()->paginate(50);
        return view('pages.Reminders.index', compact('data'));
    }



    /*** create function  ***/
    public function create()
    {
        $data['buses'] = Bus::select('id','code')->get();
        $data['issues'] = Issue::select('id','category_id')->get();
        return view('pages.Reminders.create', compact('data'));
    }



    /*** store function  ***/
    public function store(ReminderRequest $request)
    {
        $reminder = new Reminder();
        $reminder->bus_id = $request->bus_id;
        $reminder->issue_id = $request->issue_id;
        $reminder->reminder_days = $request->reminder_days;
        $reminder->threeshold_days = $request->threeshold_days;
        $reminder->start_date = $request->start_date;
        $reminder->distance = $request->distance;
        $reminder->threeshold_distance = $request->threeshold_distance;
        $reminder->task = $request->task;
        $reminder->admin_id = auth('admin')->id();
        $reminder->active = 1;
        $reminder->save();

        return redirect()->back()->with('alert-success','Data is saved successfully');
    }



    /*** edit function  ***/
    public function edit(Reminder $reminder)
    {
        $data['buses'] = Bus::select('id','code')->get();
        $data['issues'] = Issue::select('id','category_id')->get();
        return view('pages.Reminders.edit', compact('data','reminder'));
    }



    /*** update function  ***/
    public function update(ReminderRequest $request, Reminder $reminder)
    {
        $reminder->bus_id = $request->bus_id;
        $reminder->issue_id = $request->issue_id;
        $reminder->reminder_days = $request->reminder_days;
        $reminder->threeshold_days = $request->threeshold_days;
        $reminder->start_date = $request->start_date;
        $reminder->distance = $request->distance;
        $reminder->threeshold_distance = $request->threeshold_distance;
        $reminder->task = $request->task;
        $reminder->admin_id = auth('admin')->id();
        $reminder->active = $request->active;
        $reminder->update();

        return redirect()->back()->with('alert-success','Data is updated successfully');
    }



    /*** destroy function  ***/
    public function destroy(Reminder $reminder)
    {
        $reminder->delete();
        return redirect()->back()->with('alert-info','Data is deleted successfully');
    }


} //end of class
