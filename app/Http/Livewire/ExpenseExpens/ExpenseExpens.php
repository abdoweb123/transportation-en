<?php

namespace App\Http\Livewire\ExpenseExpens;

use Livewire\Component;
use App\Models\User;
use App\Models\ExpenseExpen;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
class ExpenseExpens extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$tittle ;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle ='ExpenseExpenss';
        $this->showForm=false;
    }
    public function render()
    {
        $results=ExpenseExpen::paginate();
        return view('livewire.expense-expens.expense-expens',[
            'results'=>$results,
        ])->extends('layouts.master');
    }
  
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object= ExpenseExpen::whereId($id)->first();
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }
    public function arrived($id)
    {
        $data=ExpenseExpen::find($id);
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
    //     $data=ExpenseExpen::find($this->user_delete_id);
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
        $data=ExpenseExpen::find($this->user_delete_id);
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
        $data=ExpenseExpen::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
}
