<?php

namespace App\Http\Livewire\CompanyContractRoutes;

use App\Models\CotractRoute as CpmanyContractRoute;
use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\ContractClient;
use App\Models\Route;
use App\Models\BusType;
use App\Models\StaticTable;

class CompanyContractRoutes extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type;
    public $contracts_id,$company_id,$route_id,$bus_type_id,$service_type_id,$service_value;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle='Company Contract Routes';
        $this->showForm=false;
    }
    public function render()
    {
        $results=CpmanyContractRoute::paginate();
        $contracts=ContractClient::select('id','name')->get();
        $companies=StaticTable ::select('id','name')->whereType('company')->get();
        $routes=Route::select('id','name')->get();
        $bus_types=BusType::select('id','name')->get();
        $service_types=StaticTable::select('id','name')->whereType('service')->get();
        return view('livewire.company-contract-route.company-contract-route',compact('routes','bus_types','service_types','contracts','companies','results'))->extends('layouts.master');
    }
  
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object= CpmanyContractRoute::whereId($id)->first();
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }
    public function arrived($id)
    {
        $data=CpmanyContractRoute::find($id);
        if($data->arrived == "Y"){
            $data->arrived="N";
        }else{
            $data->arrived="Y";
        }
        $data->save();
    }
    public function switch()
    {
        $this->showForm= !$this->showForm;
    }
    public function make_delete($id)
    {
        $this->user_delete_id=$id;
        $this->emit('showDelete');
    }
    // public function delete_at()
    // {
    //     $data=CpmanyContractRoute::find($this->user_delete_id);
    //     dd('good');
    //     if ($data->deleted_at != null) {
    //         $data->deleted_at= null;
    //     }else{
    //         $data->deleted_at= now();
    //     }
    //     $data->save();
    //     session()->flash('success_message','deleted successfully');
    //     $this->emit('remove_modal');
    // }
    public function delete_at()
    {
        $data=CpmanyContractRoute::find($this->user_delete_id);
        // if ($data->deleted_at != null) {
        //     $data->deleted_at= null;
        // }else{
        //     $data->deleted_at= now();
        // }
        $data->delete();
        session()->flash('success_message','deleted successfully');
        $this->emit('remove_modal');
    }
    public function store_update()
    {
        $validate=$this->validate([
            'contracts_id'=>'required',
            'company_id'=>'required',
            'route_id'=>'required',
            'bus_type_id'=>'required',
            'service_type_id'=>'required'
        ]);
        if($this->ids != null){
            $data=CpmanyContractRoute::find($this->ids);
        }else{
            $data= new CpmanyContractRoute();
            $data->operations_number=CpmanyContractRoute::count()+1;
        }
        $data->contracts_id=$this->contracts_id;
        $data->company_id=$this->company_id;
        $data->route_id=$this->route_id;
        $data->bus_type_id=$this->bus_type_id;
        $data->service_type_id=$this->service_type_id;
        $data->service_value=$this->service_value;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            $this->emit('toggle');
            // return redirect()->to('company-contract-route');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->contracts_id=$edit_object['contracts_id'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->contracts_id=null;
        $this->company_id=null;
        $this->route_id=null;
        $this->bus_type_id=null;
        $this->service_type_id=null;
        $this->service_value=null;
    }
    public function active_ms($id)
    {
        $data=CpmanyContractRoute::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
}
