<?php

namespace App\Http\Livewire\ReportDetails;

use App\Exports\ReportOne;
use App\Models\Booking;
use App\Models\Option;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;
use App\Models\Room;
use App\Models\JobTask;
use App\Models\Company;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RportDetails\MaintenceExcel;
use App\Models\ContractClient;
use App\Models\Bus;
class Maintance extends Component
{
    use WithFileUploads;
    public $ids,$room_id,$price,$desc,$desc_en,$tittle,$bus_id,$rooms,$start_date,$end_date,$total_amount_driver,$state_id,$results,$company_id,$user_id;
    public function mount($bus_id)
    {
        $this->bus_id=$bus_id;
        $this->tittle='maintenance details';
        $this->results=Bus::with('reminder_histories')->find($bus_id);
    }
    public function render()
    {
        return view('livewire.report-details.maintance')->extends('layouts.master');
    }
    public function download_report_one()
    {
         return Excel::download(new MaintenceExcel($this->results), 'MaintenceExcel.xlsx');
    }
   
    public function report()
    {
        if($this->start_date != null){
            $this->results=Bus::with(['reminder_histories'=>function($q){
                $q->whereHas('reminder',function($qq){
                    $qq->whereBetween('start_date',[$this->start_date,$this->end_date]);
                });
            }])->find($this->bus_id);
        }
    }

}
