<?php

namespace App\Http\Livewire\Reports;

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
use App\Exports\RevenusExcel;
use App\Models\ContractClient;
use App\Models\CotractRoute;
class Revenues extends Component
{
    use WithFileUploads;
    public $ids,$room_id,$price,$desc,$desc_en,$tittle,$rooms,$start_date,$end_date,$state_id,$results,$company_id,$user_id;
    public function mount()
    {
        $this->tittle='Revenues';
        // $dataa=ContractClient::withCount('cotract_routes')->whereMonth('created_at',date('m'));
        $dataa=CotractRoute::with(['contract','company','service_type','route'=>function($route){
            $route->with(['employeeRunTrips'=>function($empoyee_run_trip){
                $empoyee_run_trip->withCount('penelties')->withSum('penelties','amount');
            }]);
        }])->withSum('discounts','discount_value'); 
        $this->results=$dataa->get();
    }
    public function render()
    {
        return view('livewire.reports.revenues')->extends('layouts.master');
    }
    public function download_report_one()
    {
         return Excel::download(new RevenusExcel($this->results), 'RevenusExcel.xlsx');
    }
   
    public function report()
    {
        if($this->start_date != null){
            $dataa=CotractRoute::with(['contract','company','service_type','route'=>function($route){
                $route->with(['employeeRunTrips'=>function($empoyee_run_trip){
                    $empoyee_run_trip->withCount('penelties')->withSum('penelties','amount');
                }]);
            }])->whereBetween('created_at',[$this->start_date,$this->end_date]);
            $this->results=$dataa->get();
        }
    }

}
