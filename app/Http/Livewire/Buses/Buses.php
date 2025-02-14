<?php

namespace App\Http\Livewire\Buses;

use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\StaticTable;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BusImport;
class Buses extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$driver_id,$bus_id,$type_id,$excel,$result_export;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle='List Of Buses';
        $this->showForm=false;
    }
    public function render()
    {
        $results=Bus::whereAdminId(Auth::guard('admin')->id())->paginate();
        return view('livewire.buses.buses',[
            'results'=>$results,
        ])->extends('layouts.master');
    }

    public function import_file()
    {
        if ($this->excel == null) {
            return session()->flash('alert-danger','plz check file!');
        }

        $dataa=new BusImport();

        Excel::import( $dataa,$this->excel);
        if ($dataa->arr_inf_not_add) {
            $this->emit('remove_model_export');
          $this->result_export=$dataa->arr_inf_not_add;
        }else{
            return redirect()->to('buses')->with('alert-info','تم الاضافه بنجاح');
        }
    }

    public function switch_status($id)
    {
        $data=Bus::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
    public function edit_form($id)
    {
        $this->showForm=!$this->showForm;
        $edit_object= Bus::whereId($id)->first();
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }
    public function arrived($id)
    {
        $data=Bus::find($id);
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
    //     $data=Bus::find($this->user_delete_id);
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
        $data=Bus::find($this->user_delete_id);
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
        $data=Bus::find($id);
        if($data->is_active == "Y"){
            $data->is_active="N";
        }else{
            $data->is_active="Y";
        }
        $data->save();
    }
}
