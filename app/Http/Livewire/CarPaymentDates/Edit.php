<?php

namespace App\Http\Livewire\CarPaymentDates;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\CarPaymentDate;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$car_payment_id,$date,$amount,$paid;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount($car_payment_id)
    {
        $this->car_payment_id=$car_payment_id;
        $this->paid="N";
    }
    public function render()
    {
        return view('livewire.car-payment-dates.edit')->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'date'=>'required',
            'amount'=>'required',
        ]);
        if($this->ids != null){
            $data=CarPaymentDate::find($this->ids);
        }else{
            $data= new CarPaymentDate();
        }
        $data->car_payment_id=$this->car_payment_id;
        $data->date=$this->date;
        $data->amount=$this->amount;
        $data->paid=$this->paid;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('car-payment-dates/'.$this->car_payment_id);
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->date=$edit_object['date'];
        $this->amount=$edit_object['amount'];
        $this->paid=$edit_object['paid'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->date=null;
        $this->amount=null;
        $this->paid=null;
    }
}
