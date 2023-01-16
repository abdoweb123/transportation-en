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
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$name,$email,$password,$confirm_password;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        return view('livewire.companies.edit')->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|same:confirm_password',
            'confirm_password'=>'required',
        ]);
        if($this->ids != null){
            $data=Company::find($this->ids);
        }else{
            $data= new Company();
        }
        $data->name=$this->name;
        $data->email=$this->email;
        $data->admin_id=Auth::guard('admin')->id();
        $data->active=1;
        $data->password=Hash::make($this->password);
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('companies');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->name=$edit_object['name'];
        $this->email=$edit_object['email'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->name=null;
        $this->email=null;
        $this->password=null;
    }
}
