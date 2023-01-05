<?php

namespace App\Http\Livewire\DriverSalaries;

use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\DriverSalary;
use App\Models\Driver;
use App\Models\BusType;
use App\Models\Route;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$driver_id,$date,$payment_type,$bus_type_id,$route_id;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        $drivers=Driver::select('id','name')->get();
        $bus_types=BusType::select('id','name')->get();
        $routes=Route::select('id','name')->get();
        return view('livewire.driver-salaries.edit',compact('drivers','bus_types','routes'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'driver_id'=>'required|int',
            'payment_type'=>'required',
            'bus_type_id'=>'required|int',
            'route_id'=>'required|int',
        ]);
        if($this->ids != null){
            $data=DriverSalary::find($this->ids);
        }else{
            $data= new DriverSalary();
        }
        $data->driver_id=$this->driver_id;
        $data->payment_type=$this->payment_type;
        $data->bus_type_id=$this->bus_type_id;
        $data->route_id=$this->route_id;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('driver-salary');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->driver_id=$edit_object['driver_id'];
        $this->payment_type=$edit_object['payment_type'];
        $this->bus_type_id=$edit_object['bus_type_id'];
        $this->route_id=$edit_object['route_id'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->date=null;
        $this->payment_type=null;
        $this->bus_type_id=null;
        $this->route_id=null;
    }
}
