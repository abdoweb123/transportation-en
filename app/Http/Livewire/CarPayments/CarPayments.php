<?php

namespace App\Http\Livewire\CarPayments;

use App\Models\CarPayment;
use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Bus;

class CarPayments extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type;
    public $bus_id,$total_amount;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle='Car Payments';
        $this->showForm=false;
    }
    public function render()
    {
        $buses=Bus::select('id','code')->get();
        $results=CarPayment::with('bus')->latest()->paginate();
        return view('livewire.car-payments.car-payments',[
            'results'=>$results,
            'buses'=>$buses,
        ])->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'bus_id'=>'required',
            'total_amount'=>'required',
        ]);
        if($this->ids != null){
            $data=CarPayment::find($this->ids);
        }else{
            $data= new CarPayment();
        }
        $data->bus_id=$this->bus_id;
        $data->total_amount=$this->total_amount;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            // return redirect()->to('contract-client');
        }
    }
    
  
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object= CarPayment::whereId($id)->first();
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }
    public function arrived($id)
    {
        $data=CarPayment::find($id);
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
    //     $data=CarPayment::find($this->user_delete_id);
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
        $data=CarPayment::find($this->user_delete_id);
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
        $data=CarPayment::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
    public function resetInput()
    {
        $this->ids=null;
        $this->bus_id=null;
        $this->total_amount=null;
    }
}
