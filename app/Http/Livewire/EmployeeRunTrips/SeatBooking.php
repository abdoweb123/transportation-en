<?php

namespace App\Http\Livewire\EmployeeRunTrips;

use Livewire\Component;
use App\Models\User;
use App\Models\BookingRequest;
use App\Models\EmployeeRunTrip;
use App\Models\Driver;
use App\Models\Bus;
use App\Models\EmployeeRunTripBus;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class SeatBooking extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$tittle,$employee_runTrip_bus_id,$employee_runTrip_id,$templates=[''],$bus_id=[],$driver_id=[],$collection_selected=[],$arr=[],$arr_count=[];
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount($employee_runTrip_id,$employee_runTrip_bus_id)
    {
        $this->employee_runTrip_id=$employee_runTrip_id;
        $this->employee_runTrip_bus_id=$employee_runTrip_bus_id;
    }
    public function render()
    {
        $booking_requests=BookingRequest::with('myEmployee')->where('employeeRunTrip_id',$this->employee_runTrip_id)->get();
        $employee_runtrip=EmployeeRunTrip::with('company')->find($this->employee_runTrip_id);
        $drivers=Driver::select('id','name')->get();

        // $employee=EmployeeRunTripBus::whereDoesntHave('employeeRunTrip',function($q) use ($employee_runtrip){
        //     $q->where('date',$employee_runtrip->date)->where('time',$employee_runtrip->time);
        // })->get();
        // dd($employee->first());
        $buses=Bus::with('busType','employee_run_trip_buses')->whereDoesntHave('employee_run_trip_buses',function($q) use ($employee_runtrip){
            $q->whereDoesntHave('employeeRunTrip',function($q2) use ($employee_runtrip){
                $q2->where('date',$employee_runtrip->date)->where('time',$employee_runtrip->time);
            });
        })->get();

        // $buses=Bus::join('employee_run_trip_buses', 'employee_run_trip_buses.bus_id', '=', 'buses.id')
        //             ->where('users.status', 'active')
        //             // ->where('posts.status','active')
        //             ->get(['buses.*']);
        // dd($buses);
        return view('livewire.employee-run-trips.seat-booking',compact('booking_requests','buses','employee_runtrip','drivers'))->extends('layouts.master');
    }

    function add()
    {
        $this->templates[]='';
    }

    public function count_arr($index,$itemindex)
    {
        // dd(($this->collection_selected));
        if (array_key_exists($itemindex,$this->collection_selected)) {
           if (count($this->collection_selected[$itemindex]) != 1) {
                unset($this->collection_selected[$itemindex]);
                $this->collection_selected +=[$itemindex=>[$index=>$index]];
           }
        }
        // dd($this->collection_selected);
        // return 'fdfdfdfd';
        if (array_key_exists($index,$this->arr_count)) {
            $this->arr_count[$index] +=1; 
        }else{
            $this->arr_count +=[$index=>1];
        }
        // $this->arr+=[$index=>1];
        // if(isset($this->arr[$index])){

        // }
        // $kay=array_keys($this->arr);
        // if (isset($kay[$index])) {
        //     $kay[$index]=$kay[$index]+1;
        //     dd($kay);
        // }else{
        //     array_push($this->arr,[$index=>1]);
        // }
    //    dd($this->arr);
    //     if (isset($this->arr[$index])) {
    //         dd('goood');
    //     }
    //     $this->arr+=[$index=>1];
    //     dd($this->arr);
    }

    public function collection_selecte()
    {
        // $kay=array_keys($this->arr);
        // dd($this->arr_count);
        if (count($this->bus_id) != count($this->templates) ) {
            return session()->flash('alert-danger','plz check select buses!');
        }
        if ( count($this->driver_id) != count($this->templates)) {
            return session()->flash('alert-danger','plz check select drivers!');

        }

        $booking_requests=BookingRequest::with('myEmployee')->where('employeeRunTrip_id',$this->employee_runTrip_id)->get();
       
        if (count($this->collection_selected) != count($booking_requests)) {
            return session()->flash('alert-danger','plz check all checkers!');
        }

        // dd($this->collection_selected);
        // $bus_count=0;
        foreach ($this->templates as $index=>$booking) {

            // $kay=array_keys($this->collection_selected[$index]);
            
            $bus_data=Bus::with('busType')->find($this->bus_id[$index]);
            $bus_count_get=$this->arr_count[$index];
            // dd($bus_count_get);
            if ($bus_data->busType->slug < $bus_count_get) {
                return session()->flash('alert-danger','count of bus('.$bus_data->code.')'.'more than seats number!');
            }
        }
        // dd('dddd');
        foreach ($booking_requests as $index=>$booking) {

            $kay=array_keys($this->collection_selected[$index]);
            
            // dd($kay[0]);
            // dd(array_reverse($this->collection_selected[$index]));
            

            // dd($this->driver_id[$this->collection_selected[$index][$index]]);
            // dd($this->bus_id[$this->collection_selected[$index][$index]]);
            // dd($this->bus_id[$this->collection_selected[$index][$index]]);
            $booking->bus_id= $this->bus_id[$kay[0]];
            $check=$booking->save();

            if ($check) {
                $new=new EmployeeRunTripBus();
                $new->employeeRunTrip_id=$this->employee_runTrip_id;
                $new->driver_id=$this->driver_id[$kay[0]];
                $new->bus_id=$this->bus_id[$kay[0]];
                $new->admin_id=auth()->user()->id;
                $new->started='N';
                $new->ended='N';
                $new->active=1;
                $new->save();
            }

        }
        return redirect()->to('seat-booking/'.$this->employee_runTrip_id.'/'.$this->employee_runTrip_bus_id)->with('alert-success','added successfully');
    }

    public function remove($index)
    {
        unset($this->templates[$index]);
        unset($this->bus_id[$index]);
        unset($this->arr_count[$index]);
    }
}
