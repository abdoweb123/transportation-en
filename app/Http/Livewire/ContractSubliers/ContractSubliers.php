<?php

namespace App\Http\Livewire\ContractSubliers;

use App\Models\ContractSublier;
use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContractSubliers as importContractSubliers;
class ContractSubliers extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$excel;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle='Suppliers Contracts';
        $this->showForm=false;
    }
    public function render()
    {
        $results=ContractSublier::whereAdminId(Auth::guard('admin')->id())->paginate();
        return view('livewire.contract-subliers.contract-subliers',[
            'results'=>$results,
        ])->extends('layouts.master');
    }
  
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object= ContractSublier::whereId($id)->first();
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }
    public function arrived($id)
    {
        $data=ContractSublier::find($id);
        if($data->arrived == "Y"){
            $data->arrived="N";
        }else{
            $data->arrived="Y";
        }
        $data->save();
    }
 


    public function import_file()
    {
        if ($this->excel == null) {
            return session()->flash('alert-danger','plz check file!');
        }
        Excel::import(new importContractSubliers(),$this->excel);

        return redirect()->to('contract-sublier')->with('alert-info','تم الاضافه بنجاح');
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
    //     $data=ContractSublier::find($this->user_delete_id);
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
        $data=ContractSublier::find($this->user_delete_id);
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
        $data=ContractSublier::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
}
