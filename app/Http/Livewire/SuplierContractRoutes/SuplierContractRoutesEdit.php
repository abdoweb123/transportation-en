<?php

namespace App\Http\Livewire\SuplierContractRoutes;

use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\StaticTable;
use Livewire\Component;
use App\Models\SublierCotractRoute;
use App\Models\ContractClient;
use App\Models\Route;
use App\Models\BusType;
class SuplierContractRoutesEdit extends Component
{
    use WithFileUploads;
    public $ids,$contracts_id,$suplier_id,$route_id,$bus_type_id
    ,$service_type_id,$service_value;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount($id=0)
    {
        if ($id != 0) {
            $this->ids=$id;
            $contract=SublierCotractRoute::find($id);
            $this->contracts_id=$contract->contracts_id;
            $this->suplier_id=$contract->suplier_id;
            $this->route_id=$contract->route_id;
            $this->bus_type_id=$contract->bus_type_id;
            $this->service_type_id=$contract->service_type_id;
            $this->service_value=$contract->service_value;
            $this->number_of_routes=$contract->number_of_routes;
        }
        $this->chk=true;
    }
    public function render()
    {
        $contracts=ContractClient::select('id','name')->get();
        $supliers=StaticTable::select('id','name')->whereType('suppliers')->get();
        $routes=Route::select('id','name')->get();
        $bus_types=BusType::select('id','name')->get();
        $service_types=StaticTable::select('id','name')->whereType('service')->get();
        return view('livewire.suplier-contract-route.suplier-contract-route-edit',compact('routes','bus_types','service_types','contracts','supliers'))->extends('layouts.master');
    }
    

    public function store_update()
    {
        $validate=$this->validate([
            'contracts_id'=>'required',
            'suplier_id'=>'required',
            'route_id'=>'required',
            'bus_type_id'=>'required',
            'service_type_id'=>'required'
        ]);
        if($this->ids != null){
            $data=SublierCotractRoute::find($this->ids);
        }else{
            $data= new SublierCotractRoute();
            $data->operations_number=SublierCotractRoute::count()+1;
        }
        $data->contracts_id=$this->contracts_id;
        $data->suplier_id=$this->suplier_id;
        $data->route_id=$this->route_id;
        $data->bus_type_id=$this->bus_type_id;
        $data->service_type_id=$this->service_type_id;
        $data->service_value=$this->service_value;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('suplier-contract-route');
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
        $this->suplier_id=null;
        $this->route_id=null;
        $this->bus_type_id=null;
        $this->service_type_id=null;
        $this->service_value=null;
    }
}
