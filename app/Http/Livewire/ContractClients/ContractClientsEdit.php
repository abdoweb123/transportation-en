<?php

namespace App\Http\Livewire\ContractClients;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\StaticTable;
use Livewire\Component;
use App\Models\ContractClient;
class ContractClientsEdit extends Component
{
    use WithFileUploads;
    public $ids,$name,$company_id,$start_date,$end_date,$number_of_routes,$serches,$chk;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount($id=0)
    {
        if ($id != 0) {
            $this->ids=$id;
            $contract=ContractClient::find($id);
            $this->name=$contract->name;
            $this->company_id=$contract->company->name;
            $this->start_date=$contract->start_date;
            $this->end_date=$contract->end_date;
            $this->number_of_routes=$contract->number_of_routes;
        }
        $this->chk=true;
    }
    public function render()
    {
        if($this->company_id != null && $this->chk == true){
            $this->serches=StaticTable::where('type','company')->where('name','like',$this->company_id.'%')->get();
        }else{
            $this->serches=null;
            $this->chk == true;
        }
        return view('livewire.contract-clients.contract-clients-edit')->extends('layouts.master');
    }
    // public function get_comapny()
    // {
    //     if($this->company_id != null && $this->chk == true){
    //         $this->serches=StaticTable::where('type','company')->where('name','like',$this->company_id.'%')->get();
    //     }else{
    //         $this->serches=null;
    //     }
    // }
    public function defin_company($id)
    {
        $comp_defin=StaticTable::find($id);
        $this->company_id=$comp_defin->name;
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
            $data=ContractClient::find($this->ids);
        }else{
            $data= new ContractClient();
        }
        $company=StaticTable::where('name','like','%'.$this->company_id.'%')->first();
        if ($company != null) {
            $company_id_get=$company->id;
        }else{
            $new_company=new StaticTable();
            $new_company->type='company';
            $new_company->name=$this->company_id;
            $new_company->save();
            $company_id_get=$new_company->id;
        }

        $data->name=$this->name;
        $data->company_id=$company_id_get;
        $data->start_date=$this->start_date;
        $data->end_date=$this->end_date;
        $data->number_of_routes=$this->number_of_routes;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('contract-client');
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
