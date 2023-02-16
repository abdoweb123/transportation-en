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
use App\Exports\RportDetails\ExteraFeesExcel;
use App\Models\ContractClient;
use App\Models\Bus;
class ExterFeesDetails extends Component
{
    use WithFileUploads;
    public $ids,$room_id,$price,$desc,$desc_en,$tittle,$rooms,$start_date,$end_date,$total_amount_driver,$state_id,$results,$company_id,$user_id,$bus_id;
    public function mount($bus_id)
    {
        $this->bus_id=$bus_id;
        $this->tittle='extera fees details';
        $this->results=Bus::with('extera_fees')->find($bus_id);
    }
    public function render()
    {
        return view('livewire.report-details.exter-fees-details')->extends('layouts.master');
    }
    public function download_report_one()
    {
         return Excel::download(new ExteraFeesExcel($this->results), 'ExteraFeesExcel.xlsx');
    }
   
    public function report()
    {
        if($this->start_date != null){
            $this->results=Bus::with(['extera_fees'=>function($q){
                $q->whereBetween('created_at',[$this->start_date,$this->end_date]);
            }])->find($this->bus_id);
        }
    }

}
