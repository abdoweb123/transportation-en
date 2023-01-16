<?php

namespace App\Http\Livewire\Notifactions;

use Livewire\Component;
use App\Models\Reminder;
class Notifactions extends Component
{
    public function render()
    {
        $reminders=Reminder::where('start_date','<=',date('Y-m-d'))->get();
        $reminder_array=[];
        foreach ($reminders as $key => $reminder) {
            $daies=now()->diffInDays($reminder->start_date);
            if ($daies == $reminder->reminder_days) {
                array_push($reminder_array,$reminder->id);
            }
        }
        if ($reminder_array != null) {
            $results=Reminder::whereIn('id',$reminder_array)->get();
            // $this->emit('show_modal');
        }else{
            $results=null;
        }
        return view('livewire.notifactions.notifactions',compact('results'));
    }
}