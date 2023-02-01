<?php

namespace App\Http\Livewire\Gases;

use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Gas;
use App\Models\Driver;
use App\Models\BusType;
use App\Models\StaticTable;
use App\Models\Bus;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Edit extends Component
{
    use WithFileUploads;
    public $ids,$bus_id,$kilometer,$gas_amount,$paid_amount,$driver_id,$date,$bus_type_id,$suplier_type_id;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        $drivers=Driver::whereAdminId(Auth::guard('admin')->id())->select('id','name')->get();
        $bus_types=BusType::whereAdminId(Auth::guard('admin')->id())->select('id','name')->get();
        // $routes=Route::whereAdminId(Auth::guard('admin')->id())->select('id','name')->get();
        $buses=Bus::whereAdminId(Auth::guard('admin')->id())->select('id','code')->get();
        $suplier_types=StaticTable::select('id','name')->whereType('supplier_type')->get();
        return view('livewire.gases.edit',compact('drivers','bus_types','suplier_types','buses'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'driver_id'=>'required|int',
            'bus_type_id'=>'required|int',
            'suplier_type_id'=>'required|int',
            'bus_id'=>'required|int',
        ]);
        if($this->ids != null){
            $data=Gas::find($this->ids);
        }else{
            $data= new Gas();
        }
        $data->driver_id=$this->driver_id;
        $data->admin_id=Auth::guard('admin')->id();
        $data->bus_type_id=$this->bus_type_id;
        $data->suplier_type_id=$this->suplier_type_id;
        $data->gas_amount=$this->gas_amount;
        $data->bus_id=$this->bus_id;
        $data->paid_amount=$this->paid_amount;
        $data->kilometer=$this->kilometer;

        $data_befor=Gas::where(['driver_id'=>$this->driver_id,'bus_type_id'=>$this->bus_type_id,'bus_id'=>$this->bus_id])->latest()->first();
        if ($data_befor != null) {
            $data->distance =$this->kilometer - $data_befor->kilometer;
            $data->leter_k =$this->gas_amount / $data->distance;
            $data->amount_k =$this->paid_amount / $data->distance;
        }else{
            $data->distance =$this->kilometer;
            $data->leter_k =$this->gas_amount / $this->kilometer;
            $data->amount_k =$this->paid_amount / $this->kilometer;
        }
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
        $this->suplier_type_id=$edit_object['suplier_type_id'];
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
        $this->suplier_type_id=null;
        $this->bus_id=null;
        $this->kilometer=null;
        $this->gas_amount=null;
        $this->paid_amount=null;
    }
}
