<?php

namespace App\Http\Livewire\Borrows;

use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Company;
use App\Models\Driver;
use App\Models\StaticTable;
use App\Models\Borrow;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Edit extends Component
{
    use WithFileUploads;
    public $ids,$name,$driver_id,$company_id,$borrow_type_id,$date,$amount;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        // $companies=Company::select('id','company_name')->get();
        $drivers=Driver::select('id','name')->get();
        $borrow_types=StaticTable::select('id','name')->whereType('borrow_type')->get();
        return view('livewire.borrows.edit',compact('drivers','borrow_types'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'driver_id'=>'required',
            'borrow_type_id'=>'required',
            'date'=>'required',
            'amount'=>'required',
        ]);
        if($this->ids != null){
            $data=Borrow::find($this->ids);
        }else{
            $data= new Borrow();
        }

        $data->driver_id=$this->driver_id;
        $data->admin_id=Auth::guard('admin')->id();
        $data->borrow_type_id=$this->borrow_type_id;
        $data->date=$this->date;
        $data->amount=$this->amount;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('borrows')->with('alert-success','تم حفظ البيانات بنجاح');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->driver_id=$edit_object['driver_id'];
        $this->borrow_type_id=$edit_object['borrow_type_id'];
        $this->date=$edit_object['date'];
        $this->amount=$edit_object['amount'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->driver_id=null;
        $this->borrow_type_id=null;
        $this->date=null;
        $this->amount=null;
    }
}
