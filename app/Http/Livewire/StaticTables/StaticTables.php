<?php

namespace App\Http\Livewire\StaticTables;

use App\Models\Booking;
use Livewire\Component;
use App\Models\StaticTable as Static_table;
use App\Models\User;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
class StaticTables extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount($type)
    {
        $this->type=$type;
        $this->tittle=$type;
        if ($this->type == 'discount_type') {
            $this->tittle='List Of Discount Types';
        }elseif ($this->type == 'insurance_kind') {
            $this->tittle='List Of Driving Licences';
        }elseif ($this->type == 'service') {
            $this->tittle='List Of Service Types';
        }elseif ($this->type == 'supplier_type') {
            $this->tittle='List Of Supplier Types';
        }elseif ($this->type == 'suppliers') {
            $this->tittle='List Of Supplier';
        }elseif ($this->type == 'penalty_type') {
            $this->tittle='List Of Penalty Types';
        }elseif ($this->type == 'accident_type') {
            $this->tittle='List Of Accident Types';
        }elseif ($this->type == 'gas_type') {
            $this->tittle='List Of Fuel Types';
        }elseif ($this->type == 'gudget_brand') {
            $this->tittle='List Of Sapre Parts';
        }elseif ($this->type == 'gudget_type') {
            $this->tittle='List Of Sapre Part Types';
        }elseif ($this->type == 'extra_fees_type') {
            $this->tittle='Exter Fees Types';
        }elseif ($this->type == 'vendor_type') {
            $this->tittle='vendor Types';
        }elseif ($this->type == 'borrow_type') {
            $this->tittle='Borrow Types';
        }elseif ($this->type == 'insurance_company') {
            $this->tittle='insurance Companies';
        }elseif ($this->type == 'bus_model') {
            $this->tittle='List Of Models';
        }
        
        $this->showForm=false;
    }
    public function render()
    {
        $results=Static_table::whereAdminId(Auth::guard('admin')->id())->whereType($this->type)->paginate();
        return view('livewire.static-tables.static-tables',[
            'results'=>$results,
        ])->extends('layouts.master');
    }
  
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object= Static_table::whereId($id)->first();
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }
    public function arrived($id)
    {
        $data=Static_table::find($id);
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
    //     $data=Static_table::find($this->user_delete_id);
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
        $data=Static_table::find($this->user_delete_id);
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
        $data=Static_table::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
}
