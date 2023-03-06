<?php

namespace App\Http\Livewire\ExpenseExpens;

use App\Models\Price;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\ExpenseExpen;
use App\Models\StaticTable;
use App\Models\Company;
use App\Models\Driver;
use App\Models\Bus;
use App\Models\Route;
use App\Models\ExpenseExpenBus;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$code,$solar_g=0,$date,$solar_liter=0,$bus_id,$solar_g_liter=0,$km=0,$solar_esthlak=0,$zeyout=0,$kawetch=0,$btarya=0
    ,$zogag=0,$ghasel_tashhim=0,$maintance_flater=0,$eslah_kt_ghear=0,$grash_edafy=0,$ather=0,$total=0;
    public $notes,$supplier_value;
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function render()
    {
        $buses=Bus::whereAdminId(Auth::guard('admin')->id())->select('id','code')->get();
        return view('livewire.expense-expens.edit',compact('buses'))->extends('layouts.master');
    }

    public function total_price()
    {
        $this->total=$this->solar_g + $this->solar_liter+ $this->solar_g_liter + $this->km +$this->solar_esthlak + $this->zeyout
                    +$this->kawetch + $this->btarya +$this->zogag +$this->ghasel_tashhim +$this->maintance_flater +$this->eslah_kt_ghear+$this->grash_edafy+$this->ather;
    }
    public function store_update()
    {
        $validate=$this->validate([
            'code'=>'required',
            'solar_g'=>'required',
            'date'=>'required',
        ]);
        if($this->ids != null){
            $data=ExpenseExpen::find($this->ids);
        }else{
            $data= new ExpenseExpen();
        }

        $data->code=$this->code;
        $data->solar_g=$this->solar_g;
        $data->solar_g_liter=$this->solar_g_liter;
        $data->km=$this->km;
        $data->bus_id=$this->bus_id;
        $data->solar_esthlak=$this->solar_esthlak;
        $data->zeyout=$this->zeyout;
        $data->kawetch=$this->kawetch;
        $data->btarya=$this->btarya;
        $data->date=$this->date;
        $data->zogag=$this->zogag;
        $data->ghasel_tashhim=$this->ghasel_tashhim;
        $data->maintance_flater=$this->maintance_flater;
        $data->eslah_kt_ghear=$this->eslah_kt_ghear;
        $data->grash_edafy=$this->grash_edafy;
        $data->ather=$this->ather;
        $data->total=$this->total;
        $data->solar_liter=$this->solar_liter;
        $check=$data->save();

        if ($check) {
            $this->resetInput();
            return redirect()->to('expense-expense')->with('alert-success','تم حفظ البيانات بنجاح');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->code=$edit_object['code'];
        $this->solar_g=$edit_object['solar_g'];
        $this->date=$edit_object['date'];
        $this->solar_liter=$edit_object['solar_liter'];
        $this->solar_g_liter=$edit_object['solar_g_liter'];
        $this->km=$edit_object['km'];
        $this->solar_esthlak=$edit_object['solar_esthlak'];
        $this->zeyout=$edit_object['zeyout'];
        $this->kawetch=$edit_object['kawetch'];
        $this->btarya=$edit_object['btarya'];
        $this->zogag=$edit_object['zogag'];
        $this->ghasel_tashhim=$edit_object['ghasel_tashhim'];
        $this->maintance_flater=$edit_object['maintance_flater'];
        $this->eslah_kt_ghear=$edit_object['eslah_kt_ghear'];
        $this->total=$edit_object['total'];
        $this->ather=$edit_object['ather'];
        $this->bus_id=$edit_object['bus_id'];
        // if ($edit_object['id']) {
        //     $this->bus_id=ExpenseExpenBus::where('ExpenseExpen_id',$edit_object['id'])->pluck('bus_id');
        // }
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->code=null;
        $this->solar_g=null;
        $this->date=null;
        $this->solar_liter=null;
        $this->bus_id=null;
        $this->km=null;
        $this->solar_g_liter=null;
        $this->solar_esthlak=null;
        $this->zeyout=null;
        $this->kawetch=null;
        $this->btarya=null;
        $this->zogag=null;
        $this->ghasel_tashhim=null;
    }
}
