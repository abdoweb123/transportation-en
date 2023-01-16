<?php

namespace App\Http\Livewire\Discounts;

use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\StaticTable;
use App\Models\Discount;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$discount_type_id,$amount,$title,$presentage;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        $discount_types=StaticTable::whereType('discount_type')->select('id','name')->get();

        return view('livewire.discounts.edit',compact('discount_types'))->extends('layouts.master');
    }

    public function store_update()
    {
        $validate=$this->validate([
            'discount_type_id'=>'required|int',
            'amount'=>'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'title'=>'required',
            'presentage'=>'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ]);
        if($this->ids != null){
            $data=Discount::find($this->ids);
        }else{
            $data= new Discount();
        }
        $data->discount_type_id=$this->discount_type_id;
        $data->amount=$this->amount;
        $data->title=$this->title;
        $data->presentage=$this->presentage;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('discounts');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->discount_type_id=$edit_object['discount_type_id'];
        $this->amount=$edit_object['amount'];
        $this->title=$edit_object['title'];
        $this->presentage=$edit_object['presentage'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->amount=null;
        $this->title=null;
        $this->presentage=null;
    }
}
