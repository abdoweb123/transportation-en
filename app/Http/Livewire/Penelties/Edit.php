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
class Edit extends Component
{
    use WithFileUploads;
    public $ids,$description,$driver_id,$penelty_type_id,$date,$amount,$driver_pay,$company_pay;
   
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
            $this->amount=$data->amount;
            $this->driver_pay=$data->driver_pay;
            $this->company_pay=$data->company_pay;
        }
        $this->chk=true;
    }
    public function render()
    {
        $penelty_types=StaticTable::select('id','name')->where('type','penalty_type')->get();
        $drivers=Driver::select('id','name')->get();
        return view('livewire.penelties.edit',compact('penelty_types','drivers'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'description'=>'required',
            'penelty_type_id'=>'required',
            'driver_id'=>'required',
            'date'=>'required',
            'amount'=>'required',
            'driver_pay'=>'required',
            'company_pay'=>'required'
        ]);
        if($this->ids != null){
            $data=Penelty::find($this->ids);
        }else{
            $data= new Penelty();
        }

        $data->description=$this->description;
        $data->driver_id=$this->driver_id;
        $data->penelty_type_id=$this->penelty_type_id;
        $data->date=$this->date;
        $data->amount=$this->amount;
        $data->driver_pay=$this->driver_pay;
        $data->company_pay=$this->company_pay;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('penelties');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        // $this->name=$edit_object['name'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->description=null;
        $this->penelty_type_id=null;
        $this->driver_id=null;
        $this->date=null;
        $this->amount=null;
        $this->driver_pay=null;
        $this->company_pay=null;
    }
}
