<?php

namespace App\Http\Livewire\Gases;

use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Gas;
use App\Models\Driver;
use App\Models\BusType;
use App\Models\Route;
use App\Models\Bus;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$bus_id,$kilometer,$gas_amount,$paid_amount,$driver_id,$date,$bus_type_id,$route_id;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        $drivers=Driver::select('id','name')->get();
        $bus_types=BusType::select('id','name')->get();
        $routes=Route::select('id','name')->get();
        $buses=Bus::select('id','code')->get();
        return view('livewire.gases.edit',compact('drivers','bus_types','routes','buses'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'driver_id'=>'required|int',
            'bus_type_id'=>'required|int',
            'route_id'=>'required|int',
            'bus_id'=>'required|int',
        ]);
        if($this->ids != null){
            $data=Gas::find($this->ids);
        }else{
            $data= new Gas();
        }
        $data->driver_id=$this->driver_id;
        $data->bus_type_id=$this->bus_type_id;
        $data->route_id=$this->route_id;
        $data->gas_amount=$this->gas_amount;
        $data->bus_id=$this->bus_id;
        $data->paid_amount=$this->paid_amount;
        $data->kilometer=$this->kilometer;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('gases');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->driver_id=$edit_object['driver_id'];
        $this->bus_type_id=$edit_object['bus_type_id'];
        $this->route_id=$edit_object['route_id'];
        $this->bus_id=$edit_object['bus_id'];
        $this->kilometer=$edit_object['kilometer'];
        $this->gas_amount=$edit_object['gas_amount'];
        $this->paid_amount=$edit_object['paid_amount'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->date=null;
        $this->bus_type_id=null;
        $this->route_id=null;
        $this->bus_id=null;
        $this->kilometer=null;
        $this->gas_amount=null;
        $this->paid_amount=null;
    }
}
