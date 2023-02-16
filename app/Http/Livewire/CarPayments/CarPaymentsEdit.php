<?php

namespace App\Http\Livewire\CarPayments;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\StaticTable;
use Livewire\Component;
use App\Models\CarPayment;
use App\Models\Company;
use App\Models\Bus;

class CarPaymentsEdit extends Component
{
    use WithFileUploads;
    public $ids,$bus_id,$total_amount,$serches,$chk;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount($payment_id=0)
    {
        if ($payment_id != 0) {
            $this->ids=$payment_id;
            $carpayment=CarPayment::find($payment_id);
            $this->bus_id=$carpayment->bus_id;
            $this->total_amount=$carpayment->total_amount;
        }
        $this->chk=true;
    }
    public function render()
    {
        $buses=Bus::whereAdminId(Auth::guard('admin')->id())->select('id','code')->get();

        return view('livewire.car-payments.car-payments-edit',compact('buses'))->extends('layouts.master');
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
        $data->admin_id=Auth::guard('admin')->id();
        $data->total_amount=$this->total_amount;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('car-payments')->with('alert-success','تم حفظ البيانات بنجاح');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->bus_id=$edit_object['bus_id'];
        $this->total_amount=$edit_object['total_amount'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->bus_id=null;
        $this->total_amount=null;
    }
}
