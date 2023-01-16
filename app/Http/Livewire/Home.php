<?php

namespace App\Http\Livewire;

use App\Models\SublierCotractRoute;
use Livewire\Component;
use App\Models\Reminder;
use App\Models\Driver;
use App\Models\Company;
use App\Models\Vendor;
use App\Models\Bus;
use App\Models\BookingRequest;
use App\Models\ReminderHistory;
use App\Models\Gas;
use App\Models\DriverSalary;
class Home extends Component
{
    public function render()
    {
        $results=SublierCotractRoute::paginate();
        $reminders=Reminder::where('start_date','<=',date('Y-m-d'))->get();
        $reminder_array=[];
        foreach ($reminders as $key => $reminder) {
            $daies=now()->diffInDays($reminder->start_date);
            if ($daies == $reminder->reminder_days) {
                array_push($reminder_array,$reminder->id);
            }
        }
        if ($reminder_array != null) {
            $reminders_exist=Reminder::whereIn('id',$reminder_array)->get();
            // $this->emit('show_modal');
        }else{
            $reminders_exist=null;
        }
        $drivers=Driver::count();
        $buses=Bus::count();
        $companies=Company::count();
        $vendors=Vendor::count();
        $booging_request=BookingRequest::latest()->take(10)->get();
        $reminderhistories=ReminderHistory::latest()->take(10)->get();
        $gases=Gas::latest()->take(10)->get();
        $driver_salaries=DriverSalary::latest()->take(10)->get();
        return view('livewire.home',compact('reminders_exist','driver_salaries','gases','reminderhistories','booging_request','vendors','companies','buses','drivers'))->extends('layouts.master');
    }
  
}
