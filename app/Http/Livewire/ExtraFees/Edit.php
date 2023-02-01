<?php

namespace App\Http\Livewire\ExtraFees;

use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\ExtraFee;
use App\Models\Driver;
use App\Models\StaticTable;
use App\Models\Route;
use App\Models\Bus;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Edit extends Component
{
    use WithFileUploads;
    public $ids,$description,$driver_id,$bus_id,$date,$type_id,$amount,$distance_reading,$time;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        $drivers=Driver::whereAdminId(Auth::guard('admin')->id())->select('id','name')->get();
        $types=StaticTable::whereAdminId(Auth::guard('admin')->id())->select('id','name')->whereType('extra_fees_type')->get();
        $buses=Bus::whereAdminId(Auth::guard('admin')->id())->select('id','code')->get();
        return view('livewire.extra-fees.edit',compact('drivers','types','buses'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'type_id'=>'required|int',
            'amount'=>'required|int',
            'description'=>'required',
        ]);
        if($this->ids != null){
            $data=ExtraFee::find($this->ids);
        }else{
            $data= new ExtraFee();
        }
        $data->admin_id=Auth::guard('admin')->id();
        $data->type_id=$this->type_id;
        $data->amount=$this->amount;
        $data->driver_id=$this->driver_id;
        $data->description=$this->description;
        $data->bus_id=$this->bus_id;
        $data->distance_reading=$this->distance_reading;
        $data->date=$this->date;
        $data->time=$this->time;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('extra-fees');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->driver_id=$edit_object['driver_id'];
        $this->type_id=$edit_object['type_id'];
        $this->amount=$edit_object['amount'];
        $this->description=$edit_object['description'];
        $this->bus_id=$edit_object['bus_id'];
        $this->distance_reading=$edit_object['distance_reading'];
        $this->date=$edit_object['date'];
        $this->time=$edit_object['time'];
    }
    
    public function resetInput()
    {
        $this->ids=null;
        $this->type_id=null;
        $this->amount=null;
        $this->description=null;
        $this->driver_id=null;
        $this->bus_id=null;
        $this->distance_reading=null;
        $this->date=null;
        $this->time=null;
    }
}
