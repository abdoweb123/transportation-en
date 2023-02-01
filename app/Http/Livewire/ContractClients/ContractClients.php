<?php

namespace App\Http\Livewire\ContractClients;

use App\Models\ContractClient;
use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\StaticTable;
use App\Models\Company;

class ContractClients extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type;
    public $name,$company_id,$start_date,$end_date,$number_of_routes,$serches,$chk,$company_id_search;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle='Contract Clients';
        $this->showForm=false;
    }
    public function render()
    {
        $results=ContractClient::whereAdminId(Auth::guard('admin')->id())->with('company');
        if ($this->company_id_search != null) {
            // dd('ff');
            $results=$results->whereCompanyId($this->company_id_search);
        }
        $comapnies =Company::select('id','name')->get();
        return view('livewire.contract-clients.contract-clients',[
            'results'=>$results->paginate(),
            'comapnies'=>$comapnies,
        ])->extends('layouts.master');
    }
    public function togglee()
    {
        $this->emit('toggle');
    }

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
        $company=Company::where('name','like','%'.$this->company_id.'%')->first();
        if ($company != null) {
            $company_id_get=$company->id;
        }else{
            $new_company=new Company();
            $data->admin_id=Auth::guard('admin')->id();
            $new_company->name=$this->company_id;
            $new_company->save();
            $company_id_get=$new_company->id;
        }

        $data->name=$this->name;
        $data->company_id=$company_id_get;
        $data->start_date=$this->start_date;
        $data->admin_id=Auth::guard('admin')->id();
        $data->end_date=$this->end_date;
        $data->number_of_routes=$this->number_of_routes;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            // return redirect()->to('contract-client');
        }
    }
    
  
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object= ContractClient::whereId($id)->first();
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }
    public function arrived($id)
    {
        $data=ContractClient::find($id);
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
    //     $data=ContractClient::find($this->user_delete_id);
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
        $data=ContractClient::find($this->user_delete_id);
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
        $data=ContractClient::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
    public function resetInput()
    {
        $this->ids=null;
        $this->name=null;
        $this->company_id=null;
        $this->start_date=null;
        $this->end_date=null;
        $this->number_of_routes=null;
        $this->end_date=null;
    }
}
