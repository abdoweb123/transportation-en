<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;
use App\Models\Room;
use App\Models\JobTask;
use App\Models\Route;
use App\Models\Company;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class PerContractRoute extends Component
{
    use WithFileUploads;
    public $ids,$room_id,$price,$desc,$desc_en,$tittle,$rooms,$start_date,$end_date,$state_id,$results,$company_id,$user_id;
    public function mount()
    {
        $this->tittle='per contract route';
    }
    public function render()
    {
        $route=Route::with('company_contract_route')->find(98);
        dd($route);
        return view('livewire.reports.revenues')->extends('layouts.master');
    }
    public function download_report_one()
    {
         return Excel::download(new RevenusExcel($this->results), 'RevenusExcel.xlsx');
    }
}
