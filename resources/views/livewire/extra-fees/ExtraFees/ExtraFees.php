<?php

namespace App\Http\Livewire\ExtraFees;

use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\ExtraFee;
use App\Models\Driver;
use App\Models\Bus;
use App\Models\StaticTable;
use Illuminate\Support\Facades\Auth;
class ExtraFees extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$driver_id,$bus_id,$type_id;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle='Extra Fees';
        $this->showForm=false;
    }
    public function render()
    {
        $results=ExtraFee::whereAdminId(Auth::guard('admin')->id())->with('type','bus','driver');
        if ($this->driver_id != null) {
            $results=$results->where('driver_id',$this->driver_id);
        }
        if ($this->bus_id != null) {
            $results=$results->where('bus_id',$this->bus_id);
        }
        if ($this->type_id != null) {
            $results=$results->where('type_id',$this->type_id);
        }
        $results=$results->paginate();
        $drivers=Driver::whereAdminId(Auth::guard('admin')->id())->select('id','name')->get();
        $buses=Bus::whereAdminId(Auth::guard('admin')->id())->select('id','code')->get();
        $bus_types=StaticTable::whereAdminId(Auth::guard('admin')->id())->select('id','name')->whereType('extra_fees_type')->get();
        return view('livewire.extra-fees.extra-fees',[
            'results'=>$results,
            'drivers'=>$drivers,
            'buses'=>$buses,
            'bus_types'=>$bus_types,
        ])->extends('layouts.master');
    }
  
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object= ExtraFee::whereId($id)->first();
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }
    public function arrived($id)
    {
        $data=ExtraFee::find($id);
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
    //     $data=ExtraFee::find($this->user_delete_id);
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
        $data=ExtraFee::find($this->user_delete_id);
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
        $data=ExtraFee::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
}
