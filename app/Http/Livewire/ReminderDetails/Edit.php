<?php

namespace App\Http\Livewire\ReminderDetails;

use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Reminder;
use App\Models\StaticTable;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\ReminderHistory;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;
    public $ids,$reminder_id,
    $supplier_id,$total_paid,
    $cost_per_day,$admin_id
    ,$gudget_brand_id,$gudget_type_id,
    $number_of_gudgets=0
    ,$cost_of_gudget=0,$fixing_cost=0;
   
    public $showIndex,$showForm;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount($id)
    {
        $this->reminder_id=$id;
    }
    public function render()
    {
        $suppliers=StaticTable::select('id','name')->where('is_active','Y')->whereType('suppliers')->get();
        $admins=Admin::select('id','name')->get();
        $gudget_brands=StaticTable::select('id','name')->whereType('gudget_brand')->get();
        $gudget_types=StaticTable::select('id','name')->whereType('gudget_type')->get();
        return view('livewire.reminder-details.edit',compact('suppliers','admins','gudget_types','gudget_brands'))->extends('layouts.master');
    }
    public function total_apied()
    {
        $this->total_paid=$this->number_of_gudgets + $this->cost_of_gudget + $this->fixing_cost;
    }
    public function store_update()
    {
        $validate=$this->validate([
            'supplier_id'=>'required|int',
            'total_paid'=>'required|int',
            'cost_per_day'=>'required|int',
            'gudget_brand_id'=>'required|int',
            'gudget_type_id'=>'required|int',
            'number_of_gudgets'=>'required|int',
            'cost_of_gudget'=>'required|int',
            'fixing_cost'=>'required|int',
        ]);
        if($this->ids != null){
            $data=ReminderHistory::find($this->ids);
        }else{
            $data= new ReminderHistory();
        }
        $data->reminder_id=$this->reminder_id;
        $data->supplier_id=$this->supplier_id;
        $data->total_paid=$this->total_paid;
        $data->cost_per_day=$this->cost_per_day;
        $data->done=1;
        $data->admin_id=$this->admin_id;
        $data->gudget_brand_id=$this->gudget_brand_id;
        $data->gudget_type_id=$this->gudget_type_id;
        $data->number_of_gudgets=$this->number_of_gudgets;
        $data->cost_of_gudget=$this->cost_of_gudget;
        $data->fixing_cost=$this->fixing_cost;
        $data->active=1;
        $check=$data->save();

        if ($check) {
            $reminder=Reminder::find($this->reminder_id);
            $reminder->start_date=date('Y-m-d');
            $reminder->save();
            $this->resetInput();
            return redirect()->to('reminder-history?id='.$this->reminder_id)->with('alert-success','تم حفظ البيانات بنجاح');
        }
    }
    
    public function get_object($edit_object)
    {
        $this->ids=$edit_object['id'];
        $this->reminder_id=$edit_object['reminder_id'];
        $this->supplier_id=$edit_object['supplier_id'];
        $this->total_paid=$edit_object['total_paid'];
        $this->cost_per_day=$edit_object['cost_per_day'];
        $this->admin_id=$edit_object['admin_id'];
        $this->number_of_gudgets=$edit_object['number_of_gudgets'];
        $this->cost_of_gudget=$edit_object['cost_of_gudget'];
        $this->fixing_cost=$edit_object['fixing_cost'];
    }

    public function resetInput()
    {
        $this->ids=null;
        $this->date=null;
        $this->bus_type_id=null;
        $this->route_id=null;
        $this->bus_id=null;
        $this->kilometer=null;
        $this->gas_amount=null;
        $this->paid_amount=null;
    }
}
