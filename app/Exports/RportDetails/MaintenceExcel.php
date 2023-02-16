<?php

namespace App\Exports\RportDetails;

use App\Models\Infraction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;

class MaintenceExcel implements FromView,WithHeadingRow,WithStyles,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Infraction::all();
    // }
    protected $data;

    function __construct($data) {
        $this->data = $data;
    }
    public function view(): View
    {
        return view('livewire.reports-excel.report-details.maintence-excel', [
            'results' => $this->data
        ])->extends('admin.layouts.app');
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }


}
