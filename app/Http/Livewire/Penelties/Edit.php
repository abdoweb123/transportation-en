<?php

namespace App\Http\Livewire\Penelties;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\StaticTable;
use Livewire\Component;
use App\Models\Penelty;
use App\Models\Driver;
use App\Models\Company;
use App\Models\EmployeeRunTrip;
use App\Models\Bus;
class Edit extends Component
{
    use WithFileUploads;
    public $ids,$description,$driver_id,$penelty_type_id,$date,$time,$amount
    ,$distance_reading,$driver_pay,$company_pay,$employee_run_trip_id,$bus_id;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount($id=0)
    {
        if ($id != 0) {
            $this->ids=$id;
            $data=Penelty::find($id);
            $this->description=$data->description;
            $this->driver_id=$data->driver_id;
            $this->penelty_type_id=$data->penelty_type_id;
            $this->date=$data->date;
            $this->time=$data->time;
            $this->amount=$data->amount;
            $this->driver_pay=$data->driver_pay;
            $this->company_pay=$data->company_pay;
            $this->distance_reading=$data->distance_reading;
            $this->employee_run_trip_id=$data->employee_run_trip_id;
            $this->bus_id=$data->bus_id;
        }
        $this->chk=true;
    }
    public function render()
    {
        $penelty_types=StaticTable::select('id','name')->where('type','penalty_type')->get();
        $drivers=Driver::select('id','name')->get();
        $run_trip_emplyees=EmployeeRunTrip::select('id','date', 'time','route_id')->get();
        $buses=Bus::select('id','code')->get();
        return view('livewire.penelties.edit',compact('penelty_types','drivers','buses','run_trip_emplyees'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'description'=>'required',
            'penelty_type_id'=>'required',
            'driver_id'=>'required',
            'date'=>'required',
            'time'=>'required',
            'amount'=>'required',
            'driver_pay'=>'required',
            'company_pay'=>'required'
        ]);
        if (($this->driver_pay + $this->company_pay) != $this->amount) {
            return session()->flash('error_message','plz check amount in amount');
        }
        if($this->ids != null){
            $data=Penelty::find($this->ids);
        }else{
            $data= new Penelty();
        }

        $data->description=$this->description;
        $data->driver_id=$this->driver_id;
        $data->penelty_type_id=$this->penelty_type_id;
        $data->date=$this->date;
        $data->time=$this->time;
        $data->amount=$this->amount;
        $data->driver_pay=$this->driver_pay;
        $data->company_pay=$this->company_pay;
        $data->distance_reading=$this->distance_reading;
        $data->employee_run_trip_id=$this->employee_run_trip_id;
        $data->bus_id=$this->bus_id;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('penelties');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->description=$edit_object['description'];
        $this->driver_id=$edit_object['driver_id'];
        $this->penelty_type_id=$edit_object['penelty_type_id'];
        $this->date=$edit_object['date'];
        $this->time=$edit_object['time'];
        $this->amount=$edit_object['amount'];
        $this->employee_run_trip_id=$edit_object['employee_run_trip_id'];
        $this->distance_reading=$edit_object['distance_reading'];
        $this->company_pay=$edit_object['company_pay'];
        $this->bus_id=$edit_object['bus_id'];
        $this->driver_pay=$edit_object['driver_pay'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->description=null;
        $this->penelty_type_id=null;
        $this->driver_id=null;
        $this->date=null;
        $this->time=null;
        $this->amount=null;
        $this->driver_pay=null;
        $this->company_pay=null;
        $this->employee_run_trip_id =null;
        $this->distance_reading =null;
        $this->bus_id=null;
    }
}
