<?php

namespace App\Http\Livewire\SuplierContractRoutes;

use App\Models\SublierCotractRoute;
use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\ContractClient;
use App\Models\Route;
use App\Models\BusType;
use App\Models\StaticTable;
use App\Models\Discount;
use App\Models\Company;
use App\Models\contractDiscount;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SupplierContractRouteImport;
class SuplierContractRoutes extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$company_id,$excel,$result_export;
    public $suplier_contract_id,$suplier_id,$route_id,$bus_type_id,$discount_id
    ,$service_type_id,$service_value;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount($suplier_contract_id)
    {
        $this->tittle='suplier Contract Routes';
        $this->showForm=false;
        // // $this->suplier_contract_id=$suplier_contract_id;
    }
    public function render()
    { 
        $results=SublierCotractRoute::with('suplier_contract')->paginate();

        $supliers=StaticTable::select('id','name')->whereType('suppliers')->get();
        $routes=Route::select('id','name')->get();
        $bus_types=BusType::select('id','name')->get();
        $service_types=StaticTable::select('id','name')->whereType('service')->get(); 
        $discounts=Discount::select('id','title')->get();
        $companies=Company::select('id','name')->get();
        return view('livewire.suplier-contract-route.suplier-contract-route',compact('discounts','companies','routes','bus_types','service_types','supliers','results'))->extends('layouts.master');
    }
  
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object= SublierCotractRoute::whereId($id)->first();
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }
    public function import_file()
    {
        if ($this->excel == null) {
            return session()->flash('alert-danger','plz check file!');
        }elseif ($this->company_id == null) {
            return session()->flash('alert-danger','plz check company!');
        }
        $data=[
            'company_id'=> $this->company_id
         ];
        $dataa=new SupplierContractRouteImport($data);

        Excel::import( $dataa,$this->excel);
        if ($dataa->arr_inf_not_add) {
            $this->result_export=$dataa->arr_inf_not_add;
          }else{
              return redirect()->route('store.employees.data')->with('alert-info','تم الاضافه بنجاح');
          }
    }
    public function arrived($id)
    {
        $data=SublierCotractRoute::find($id);
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
    //     $data=SublierCotractRoute::find($this->user_delete_id);
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
        $data=SublierCotractRoute::find($this->user_delete_id);
        // if ($data->deleted_at != null) {
        //     $data->deleted_at= null;
        // }else{
        //     $data->deleted_at= now();
        // }
        $data->delete();
        session()->flash('success_message','deleted successfully');
        $this->emit('remove_modal');
    }
    public function active_ms($id)
    {
        $data=SublierCotractRoute::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
    public function store_update()
    {
        $validate=$this->validate([
            // 'suplier_contract_id'=>'required',
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
        $data->suplier_contract_id=$this->suplier_contract_id;
        $data->suplier_id=$this->suplier_id;
        $data->route_id=$this->route_id;
        $data->bus_type_id=$this->bus_type_id;
        $data->service_type_id=$this->service_type_id;
        $data->service_value=$this->service_value;
        $check=$data->save();

        if ($check) {
            // $discount_defin=Discount::find($this->discount_id);
            // if ($discount_defin->presentage != null) {
            //     $amount_after_discount=($discount_defin->presentage * $this->service_value)/100;
            // }elseif ($discount_defin->amount != null) {
            //     $amount_after_discount=$discount_defin->amount;
            // }else{
            //     $amount_after_discount=$this->service_value;
            // }

            // $discount_data=new contractDiscount();
            // $discount_data->contract_client_id=$this->contracts_id;
            // $discount_data->company_contract_id=$data->id;
            // $discount_data->discount_id=$this->discount_id;
            // $discount_data->discount_value=$amount_after_discount;
            // $discount_data->save();
            $this->resetInput();
            // return redirect()->to('suplier-contract-route');
        }
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
