<?php

namespace App\Http\Livewire\Companies;

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
use App\Models\City;
use App\Models\Country;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$name,$email,$password,$confirm_password,$user_name,$address,$city_id,$government_id,$phone_one,$phone_one_w,$phone_two,$phone_two_w,$fax,$job,$tax_card,$commercial_register;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        $cities=City::select('id','name')->get();
        $governments=Country::select('id','name')->get();
        return view('livewire.companies.edit',compact('governments','cities'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'name'=>'required',
            'password'=>'required|same:confirm_password',
            'confirm_password'=>'required',
        ]);
        if($this->ids != null){
            $data=Company::find($this->ids);
        }else{
            $data= new Company();
        }
        $data->name=$this->name;
        $data->user_name=$this->user_name;
        $data->address=$this->address;
        $data->city_id=$this->city_id;
        $data->email=$this->email;
        $data->government_id=$this->government_id;
        $data->phone_one=$this->phone_one;
        if($this->phone_one_w ==0 || $this->phone_one_w == null){
            $data->phone_one_w='N';
        }else{
            $data->phone_one_w='Y';
        }
        $data->phone_two=$this->phone_two;
        if($this->phone_two_w ==0 || $this->phone_two_w == null){
            $data->phone_two_w='N';
        }else{
            $data->phone_two_w='Y';
        }
        $data->fax=$this->fax;
        $data->job=$this->job;
        $data->tax_card=$this->tax_card;
        $data->commercial_register=$this->commercial_register;
        $data->admin_id=Auth::guard('admin')->id();
        $data->active=1;
        $data->password=Hash::make($this->password);
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('companies')->with('alert-success','تم حفظ البيانات بنجاح');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->name=$edit_object['name'];
        $this->email=$edit_object['email'];
        $this->user_name=$edit_object['user_name'];
        $this->address=$edit_object['address'];
        $this->city_id=$edit_object['city_id'];
        $this->government_id=$edit_object['government_id'];
        $this->phone_one=$edit_object['phone_one'];
        $this->phone_one_w=$edit_object['phone_one_w'];
        $this->phone_two=$edit_object['phone_two'];
        $this->phone_two_w=$edit_object['phone_two_w'];
        $this->fax=$edit_object['fax'];
        $this->job=$edit_object['job'];
        $this->tax_card=$edit_object['tax_card'];
        $this->commercial_register=$edit_object['commercial_register'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->name=null;
        $this->email=null;
        $this->password=null;
        $this->user_name=null;
        $this->address=null;
        $this->city_id=null;
        $this->government_id=null;
        $this->phone_one=null;
        $this->phone_one_w=null;
        $this->phone_two=null;
        $this->phone_two_w=null;
        $this->fax=null;
        $this->job=null;
        $this->tax_card=null;
        $this->commercial_register=null;
    }
}
