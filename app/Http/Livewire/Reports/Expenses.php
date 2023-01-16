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
use App\Exports\ExpensesExcel;
use App\Models\ContractClient;
use App\Models\Bus;
class Expenses extends Component
{
    use WithFileUploads;
    public $ids,$room_id,$price,$desc,$desc_en,$tittle,$rooms,$start_date,$end_date,$total_amount_driver,$state_id,$results,$company_id,$user_id;
    public function mount()
    {
        $this->tittle='Expenses';
        // $dataa=ContractClient::withCount('cotract_routes')->whereMonth('created_at',date('m'));
        $dataa=Bus::with('busType','reminders','penelties','accidents','payments','gas','extera_fees');
        $this->results=$dataa->get();
        $this->total_amount_driver=0;
        foreach ($this->results as  $result) {
            foreach ($result->employee_run_trip_buses as $value) {
                if (@$value->driver->driver_salary->payment_type == 1 || @$value->driver->driver_salary->payment_type == 2|| @$value->driver->driver_salary->payment_type == 3) {
                    $this->total_amount_driver += (@$result->employee_run_trip_buses->count() * @$value->driver->driver_salary->amount);
                }elseif(@$value->driver->driver_salary->payment_type == 5){
                    $this->total_amount_driver += ((@$result->employee_run_trip_buses->count() / 7) * @$value->driver->driver_salary->amount);
                }elseif(@$value->driver->driver_salary->payment_type == 6){
                    $this->total_amount_driver += ((@$result->employee_run_trip_buses->count() / 30) * @$value->driver->driver_salary->amount);
                }
            }
        }
    }
    public function render()
    {
        return view('livewire.reports.expenses')->extends('layouts.master');
    }
    public function download_report_one()
    {
         return Excel::download(new ExpensesExcel($this->results), 'ExpensesExcel.xlsx');
    }
   
    public function report()
    {
        if($this->start_date != null){
            $dataa=Bus::with('busType','reminders','penelties','accidents','payments','gas','extera_fees')->whereBetween('created_at',[$this->start_date,$this->end_date]);
            $this->results=$dataa->get();
            $this->total_amount_driver=0;
            foreach ($this->results as  $result) {
                foreach ($result->employee_run_trip_buses as $value) {
                    if (@$value->driver->driver_salary->payment_type == 1 || @$value->driver->driver_salary->payment_type == 2|| @$value->driver->driver_salary->payment_type == 3) {
                        $this->total_amount_driver += (@$result->employee_run_trip_buses->count() * @$value->driver->driver_salary->amount);
                    }elseif(@$value->driver->driver_salary->payment_type == 5){
                        $this->total_amount_driver += ((@$result->employee_run_trip_buses->count() / 7) * @$value->driver->driver_salary->amount);
                    }elseif(@$value->driver->driver_salary->payment_type == 6){
                        $this->total_amount_driver += ((@$result->employee_run_trip_buses->count() / 30) * @$value->driver->driver_salary->amount);
                    }
                }
            }
        }
    }

}
