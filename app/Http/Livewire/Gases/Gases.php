<?php

namespace App\Http\Livewire\Gases;

use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Gas;
use App\Models\Driver;
use App\Models\Bus;
use App\Models\BusType;
use Illuminate\Support\Facades\Auth;
class Gases extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$driver_id,$bus_id,$bus_type;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle='Gas';
        $this->showForm=false;
    }
    public function render()
    {
        $results=Gas::whereAdminId(Auth::guard('admin')->id())->with('driver','bus_type','route');
        if ($this->driver_id != null) {
            $results=$results->where('driver_id',$this->driver_id);
        }
        if ($this->bus_id != null) {
            $results=$results->where('bus_id',$this->bus_id);
        }
        if ($this->bus_type != null) {
            $results=$results->where('bus_type_id',$this->bus_type);
        }
        $results=$results->paginate();
        $drivers=Driver::whereAdminId(Auth::guard('admin')->id())->select('id','name')->get();
        $buses=Bus::whereAdminId(Auth::guard('admin')->id())->select('id','code')->get();
        $bus_types=BusType::whereAdminId(Auth::guard('admin')->id())->select('id','name')->get();
        return view('livewire.gases.gases',[
            'results'=>$results,
            'drivers'=>$drivers,
            'buses'=>$buses,
            'bus_types'=>$bus_types,
        ])->extends('layouts.master');
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
    // public function delete_at()
    // {
    //     $data=Gas::find($this->user_delete_id);
    //     dd('good');
    //     if ($data->deleted_at != null) {
    //         $data->deleted_at= null;
    //     }else{
    //         $data->deleted_at= now();
    //     }
    //     $data->save();
    //     session()->flash('success_message','deleted successfully');
    //     $this->emit('remove_modal');
    // }
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
