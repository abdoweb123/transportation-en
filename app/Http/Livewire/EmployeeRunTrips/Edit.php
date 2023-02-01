<?php

namespace App\Http\Livewire\EmployeeRunTrips;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\EmployeeRunTrip;
use App\Models\StaticTable;
use App\Models\Company;
use App\Models\Driver;
use App\Models\Bus;
use App\Models\Route;
use App\Models\EmployeeRunTripBus;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$name,$route_id,$driver_id,$date,$time,$fixing_amount,$driver_pay,$EmployeeRunTrip_type_id,$bus_id=[],$penelty_value,$service_value,$penalty_type_id,$company_id;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        $drivers=Driver::whereAdminId(Auth::guard('admin')->id())->select('id','name')->get();
        $buses=Bus::whereAdminId(Auth::guard('admin')->id())->select('id','code')->get();
        $routes=Route::select('id','name')->get();
        $penalty_types=StaticTable::whereType('penalty_type')->select('id','name')->get();
        $companies=Company::select('id','name')->get();
        return view('livewire.employee-run-trips.edit',compact('drivers','buses','routes','companies','penalty_types'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'route_id'=>'required',
            'driver_id'=>'required',
            'date'=>'required',
            'time'=>'required',
            'penalty_type_id'=>'required',
            'company_id'=>'required',
        ]);
        if($this->ids != null){
            $data=EmployeeRunTrip::find($this->ids);
        }else{
            $data= new EmployeeRunTrip();
        }

        $data->route_id=$this->route_id;
        $data->driver_id=$this->driver_id;
        $data->penelty_value=$this->penelty_value;
        $data->service_value=$this->service_value;
        $data->penalty_type_id=$this->penalty_type_id;
        $data->company_id=$this->company_id;
        $data->date=$this->date;
        $data->time=$this->time;
        $data->admin_id=Auth::guard('admin')->id();
        $data->active=1;
        $check=$data->save();

        if ($check) {
            foreach ($this->bus_id as $bus) {
                $e_r_t_b=new EmployeeRunTripBus();
                $e_r_t_b->bus_id=$bus;
                $e_r_t_b->driver_id=$this->driver_id;
                $e_r_t_b->employeeRunTrip_id=$data->id;
                $e_r_t_b->admin_id=Auth::guard('admin')->id();
                $e_r_t_b->active=1;
                $e_r_t_b->save();
            }

            $this->resetInput();
            return redirect()->to('employeeRunTripsNew');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->route_id=$edit_object['route_id'];
        $this->driver_id=$edit_object['driver_id'];
        $this->date=$edit_object['date'];
        $this->time=$edit_object['time'];
        $this->penelty_value=$edit_object['penelty_value'];
        $this->service_value=$edit_object['service_value'];
        $this->penalty_type_id=$edit_object['penalty_type_id'];
        $this->company_id=$edit_object['company_id'];
        if ($edit_object['id']) {
            $this->bus_id=EmployeeRunTripBus::where('employeeRunTrip_id',$edit_object['id'])->pluck('bus_id');
        }
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->route_id=null;
        $this->driver_id=null;
        $this->date=null;
        $this->time=null;
        $this->bus_id=null;
    }
}
