<?php

namespace App\Http\Livewire\Accidents;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Accident;
use App\Models\Driver;
use App\Models\Bus;
use App\Models\StaticTable;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$name,$description,$driver_id,$date,$time,$fixing_amount,$driver_pay,$accident_type_id,$company_pay,$insurance_pay,$bus_id,$distance_reading,$stop_car;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount()
    {
        $this->stop_car="N";
    }
    public function render()
    {
        $drivers=Driver::whereAdminId(Auth::guard('admin')->id())->select('id','name')->get();
        $buses=Bus::whereAdminId(Auth::guard('admin')->id())->select('id','code')->get();
        $accident_types=StaticTable::select('id','name')->whereType('accident_type')->get();
        return view('livewire.accidents.edit',compact('drivers','buses','accident_types'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'description'=>'required',
            'driver_id'=>'required',
            'date'=>'required',
            'time'=>'required',
            'fixing_amount'=>'required',
            'driver_pay'=>'required',
            'accident_type_id'=>'required',
            'company_pay'=>'required',
            'insurance_pay'=>'required',
        ]);
        if (($this->insurance_pay + $this->company_pay + $this->driver_pay) != $this->fixing_amount) {
            return session()->flash('alert-danger','plz check fixing amount');
        }
        if($this->ids != null){
            $data=Accident::find($this->ids);
        }else{
            $data= new Accident();
        }

        $data->description=$this->description;
        $data->bus_id=$this->bus_id;
        $data->driver_id=$this->driver_id;
        $data->accident_type_id=$this->accident_type_id;
        $data->date=$this->date;
        $data->time=$this->time;
        $data->fixing_amount=$this->fixing_amount;
        $data->driver_pay=$this->driver_pay;
        $data->company_pay=$this->company_pay;
        $data->insurance_pay=$this->insurance_pay;
        $data->distance_reading=$this->distance_reading;
        $data->stop_car=$this->stop_car;
        $data->admin_id=Auth::guard('admin')->id();
        $check=$data->save();

        if ($check) {
            if ($this->stop_car == "Y") {
                $bus = Bus::find($this->bus_id);
                $bus->is_active='N';
                $bus->save();
            }
            $this->resetInput();
            return redirect()->to('accidents');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->description=$edit_object['description'];
        $this->driver_id=$edit_object['driver_id'];
        $this->accident_type_id=$edit_object['accident_type_id'];
        $this->date=$edit_object['date'];
        $this->time=$edit_object['time'];
        $this->fixing_amount=$edit_object['fixing_amount'];
        $this->driver_pay=$edit_object['driver_pay'];
        $this->company_pay=$edit_object['company_pay'];
        $this->insurance_pay=$edit_object['insurance_pay'];
        $this->distance_reading=$edit_object['distance_reading'];
        $this->bus_id=$edit_object['bus_id'];
        $this->stop_car=$edit_object['stop_car'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->description=null;
        $this->driver_id=null;
        $this->accident_type_id=null;
        $this->date=null;
        $this->time=null;
        $this->fixing_amount=null;
        $this->driver_pay=null;
        $this->company_pay=null;
        $this->insurance_pay=null;
        $this->bus_id=null;
        $this->distance_reading=null;
    }
}
