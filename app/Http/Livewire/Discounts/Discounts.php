<?php

namespace App\Http\Livewire\Discounts;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Discount;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DiscountImport;

class Discounts extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$excel;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle='Discounts';
        $this->showForm=false;
    }
    public function render()
    {
        $results=Discount::with('discount_type')->paginate();
        return view('livewire.discounts.discounts',[
            'results'=>$results,
        ])->extends('layouts.master');
    }
  
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object= Discount::whereId($id)->first();
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }

    public function import_file()
    {
        if ($this->excel == null) {
            return session()->flash('alert-danger','plz check file!');
        }
        Excel::import(new DiscountImport(),$this->excel);

        return redirect()->route('discounts')->with('alert-info','تم الاضافه بنجاح');
    }

    public function arrived($id)
    {
        $data=Discount::find($id);
        if($data->arrived == "Y"){
            $data->arrived="N";
        }else{
            $data->arrived="Y";
        }
        $data->save();
    }
    public function switch_status($id)
    {
        $data=Discount::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
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
    //     $data=Discount::find($this->user_delete_id);
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
        $data=Discount::find($this->user_delete_id);
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
        $data=Discount::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
}
