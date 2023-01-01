<?php

namespace App\Http\Livewire\ContractSubliers;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\StaticTable;
use Livewire\Component;
use App\Models\ContractSublier;
class ContractSubliersEdit extends Component
{
    use WithFileUploads;
    public $ids,$name,$sublier_id,$start_date,$end_date,$number_of_routes,$serches,$chk;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount($id=0)
    {
        if ($id != 0) {
            $this->ids=$id;
            $contract=ContractSublier::find($id);
            $this->name=$contract->name;
            $this->sublier_id=$contract->sublier->name;
            $this->start_date=$contract->start_date;
            $this->end_date=$contract->end_date;
            $this->number_of_routes=$contract->number_of_routes;
        }
        $this->chk=true;
    }
    public function render()
    {
        if($this->sublier_id != null && $this->chk == true){
            $this->serches=StaticTable::where('type','suppliers')->where('name','like',$this->sublier_id.'%')->get();
        }else{
            $this->serches=null;
            $this->chk == true;
        }
        return view('livewire.contract-subliers.contract-subliers-edit')->extends('layouts.master');
    }
    // public function get_comapny()
    // {
    //     if($this->sublier_id != null && $this->chk == true){
    //         $this->serches=StaticTable::where('type','sublier')->where('name','like',$this->sublier_id.'%')->get();
    //     }else{
    //         $this->serches=null;
    //     }
    // }
    public function defin_sublier($id)
    {
        $comp_defin=StaticTable::find($id);
        $this->sublier_id=$comp_defin->name;
        $this->serches=null;
        $this->chk=false;
    }

    public function store_update()
    {
        $validate=$this->validate([
            'name'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'number_of_routes'=>'required'
        ]);
        if($this->ids != null){
            $data=ContractSublier::find($this->ids);
        }else{
            $data= new ContractSublier();
        }
        $sublier=StaticTable::where('name','like','%'.$this->sublier_id.'%')->first();
        if ($sublier != null) {
            $sublier_id_get=$sublier->id;
        }else{
            $new_sublier=new StaticTable();
            $new_sublier->type='sublier';
            $new_sublier->name=$this->sublier_id;
            $new_sublier->save();
            $sublier_id_get=$new_sublier->id;
        }

        $data->name=$this->name;
        $data->sublier_id=$sublier_id_get;
        $data->start_date=$this->start_date;
        $data->end_date=$this->end_date;
        $data->number_of_routes=$this->number_of_routes;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('contract-sublier');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->name=$edit_object['name'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->name=null;
    }
}
