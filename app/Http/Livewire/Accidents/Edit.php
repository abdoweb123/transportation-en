<?php

namespace App\Http\Livewire\Accidents;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Accident;
use App\Models\Driver;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$name,$description,$driver_id,$date,$fixing_amount,$driver_pay,$company_pay,$insurance_pay;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        $drivers=Driver::select('id','name')->get();
        return view('livewire.accidents.edit',compact('drivers'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'description'=>'required',
            'driver_id'=>'required',
            'date'=>'required',
            'fixing_amount'=>'required',
            'driver_pay'=>'required',
            'company_pay'=>'required',
            'insurance_pay'=>'required',
        ]);
        if($this->ids != null){
            $data=Accident::find($this->ids);
        }else{
            $data= new Accident();
        }

        $data->description=$this->description;
        $data->driver_id=$this->driver_id;
        $data->date=$this->date;
        $data->fixing_amount=$this->fixing_amount;
        $data->driver_pay=$this->driver_pay;
        $data->company_pay=$this->company_pay;
        $data->insurance_pay=$this->insurance_pay;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('accidents');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->description=$edit_object['description'];
        $this->driver_id=$edit_object['driver_id'];
        $this->date=$edit_object['date'];
        $this->fixing_amount=$edit_object['fixing_amount'];
        $this->driver_pay=$edit_object['driver_pay'];
        $this->company_pay=$edit_object['company_pay'];
        $this->insurance_pay=$edit_object['insurance_pay'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->description=null;
        $this->driver_id=null;
        $this->date=null;
        $this->fixing_amount=null;
        $this->driver_pay=null;
        $this->company_pay=null;
        $this->insurance_pay=null;
    }
}
