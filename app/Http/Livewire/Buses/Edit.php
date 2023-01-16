<?php

namespace App\Http\Livewire\Buses;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Company;
use App\Models\Driver;
use App\Models\StaticTable;
use App\Models\Route;
use App\Models\Bus;
use App\Models\BusType;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$name,$code,$busType_id,$gas_type_id,$motor_number
    ,$suplier_id,$driver_id,
    $shase_number,$bus_model_id,$insurance_company_id,$bank_id,
    $image_face,$image_left,
    $expiration_insurance_from,$expiration_insurance_to,
    $insurance_insurance_from,$insurance_insurance_to;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        $busTypes = BusType::whereAdminId(Auth::guard('admin')->id())->select('id','name')->get();
        $gas_types = StaticTable::whereAdminId(Auth::guard('admin')->id())->select('id','name')->whereType('gas_type')->get();
        $supliers = StaticTable::whereAdminId(Auth::guard('admin')->id())->select('id','name')->whereType('suppliers')->get();
        $drivers = Driver::whereAdminId(Auth::guard('admin')->id())->select('id','name')->get();
        $bus_models = StaticTable::whereAdminId(Auth::guard('admin')->id())->select('id','name')->whereType('bus_model')->get();
        $insurance_companies = StaticTable::whereAdminId(Auth::guard('admin')->id())->select('id','name')->whereType('insurance_company')->get();
        $banks = StaticTable::whereAdminId(Auth::guard('admin')->id())->select('id','name')->whereType('bank')->get();
        return view('livewire.buses.edit',compact('busTypes','drivers','insurance_companies','banks','bus_models','gas_types','supliers'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'name'=>'required',
            'code'=>'required',
            'busType_id'=>'required',
            'gas_type_id'=>'required',
            'motor_number'=>'required',
            'suplier_id'=>'required',
            'driver_id'=>'required',
            'shase_number'=>'required',
            'bus_model_id'=>'required',
            'insurance_company_id'=>'required',
            'bank_id'=>'required',
            'expiration_insurance_from'=>'required',
            'expiration_insurance_to'=>'required',
            'insurance_insurance_from'=>'required',
            'insurance_insurance_to'=>'required',
        ]);
        if($this->ids != null){
            $data=Bus::find($this->ids);
        }else{
            $data= new Bus();
        }
        $data->name=$this->name;
        $data->code=$this->code;
        $data->busType_id=$this->busType_id;
        $data->gas_type_id=$this->gas_type_id;
        $data->motor_number=$this->motor_number;
        $data->suplier_id=$this->suplier_id;
        $data->driver_id=$this->driver_id;
        $data->shase_number=$this->shase_number;
        $data->bus_model_id=$this->bus_model_id;
        $data->insurance_company_id=$this->insurance_company_id;
        $data->bank_id=$this->bank_id;
        $data->expiration_insurance_from=$this->expiration_insurance_from;
        $data->expiration_insurance_to=$this->expiration_insurance_to;
        $data->insurance_insurance_from=$this->insurance_insurance_from;
        $data->insurance_insurance_to=$this->insurance_insurance_to;

        if( $this->image_face )
        {
            $image = $this->image_face;
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data->image_face = "$photo";
        }

        if( $this->image_left )
        {
            $image = $this->image_left;
            $path = 'assets/images/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data->image_left = "$photo";
        }

        $data->admin_id=Auth::guard('admin')->id();
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('buses');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->name=$edit_object['name'];
        $this->code=$edit_object['code'];
        $this->busType_id=$edit_object['busType_id'];
        $this->gas_type_id=$edit_object['gas_type_id'];
        $this->motor_number=$edit_object['motor_number'];
        $this->suplier_id=$edit_object['suplier_id'];
        $this->driver_id=$edit_object['driver_id'];
        $this->shase_number=$edit_object['shase_number'];
        $this->bus_model_id=$edit_object['bus_model_id'];
        $this->insurance_company_id=$edit_object['insurance_company_id'];
        $this->bank_id=$edit_object['bank_id'];
        $this->expiration_insurance_from=$edit_object['expiration_insurance_from'];
        $this->expiration_insurance_to=$edit_object['expiration_insurance_to'];
        $this->insurance_insurance_from=$edit_object['insurance_insurance_from'];
        $this->insurance_insurance_to=$edit_object['insurance_insurance_to'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->name=null;
        $this->code=null;
        $this->busType_id=null;
        $this->gas_type_id=null;
        $this->motor_number=null;
        $this->suplier_id=null;
        $this->driver_id=null;
        $this->shase_number=null;
        $this->bus_model_id=null;
        $this->insurance_company_id=null;
        $this->bank_id=null;
        $this->expiration_insurance_from=null;
        $this->expiration_insurance_to=null;
        $this->insurance_insurance_from=null;
        $this->insurance_insurance_to=null;
    }
}
