<?php

namespace App\Http\Livewire\ReminderDetails;

use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Gas;
use App\Models\Driver;
use App\Models\Bus;
use App\Models\ReminderHistory;

class ReminderDetails extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$driver_id,$bus_id,$bus_type,$reminder_id;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle='reminder history';
        if(request()->action=="edit"){
            $this->showForm=true;
        }else{
            $this->showForm=false;
        }
        $this->reminder_id=request()->id;
    }
    public function render()
    {
        $results=ReminderHistory::paginate();
        return view('livewire.reminder-details.reminder-details',compact('results'))->extends('layouts.master');
    }
  
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object= Gas::whereId($id)->first();
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }
    public function arrived($id)
    {
        $data=Gas::find($id);
        if($data->arrived == "Y"){
            $data->arrived="N";
        }else{
            $data->arrived="Y";
        }
        $data->save();
    }
    public function switch()
    {
        $this->showForm= !$this->showForm;
    }
    public function make_delete($id)
    {
        $this->user_delete_id=$id;
        $this->emit('showDelete');
    }
    public function delete_at()
    {
        $data=Gas::find($this->user_delete_id);
        // if ($data->deleted_at != null) {
        //     $data->deleted_at= null;
        // }else{
        //     $data->deleted_at= now();
        // }
        $data->delete();
        session()->flash('success_message','deleted successfully');
        $this->emit('remove_modal');
    }
    public function active_ms($id)
    {
        $data=Gas::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
}
