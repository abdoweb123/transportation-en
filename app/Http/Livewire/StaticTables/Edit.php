<?php

namespace App\Http\Livewire\StaticTables;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\StaticTable;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$name,$type,$amount=0,$supplier_kind_id=0;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount($type)
    {
        $this->type=$type;
    }
    public function render()
    {
        $supplier_kinds=null;
        if($this->type == 'suppliers'){
            $supplier_kinds=StaticTable::whereType('suppliers_kind')->whereIsActive('Y')->get();
        }
        return view('livewire.static-tables.edit',compact('supplier_kinds'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'name'=>'required',
        ]);
        if($this->ids != null){
            $data=StaticTable::find($this->ids);
        }else{
            $data= new StaticTable();
        }

        $data->name=$this->name;
        $data->type=$this->type;
        $data->amount=$this->amount;
        $data->parent_id=$this->supplier_kind_id;
        $data->admin_id=Auth::guard('admin')->id();
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('static-table/'.$this->type)->with('alert-success','تم حفظ البيانات بنجاح');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->name=$edit_object['name'];
        $this->amount=$edit_object['amount'];
        $this->supplier_kind_id=$edit_object['parent_id'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->name=null;
    }
}
