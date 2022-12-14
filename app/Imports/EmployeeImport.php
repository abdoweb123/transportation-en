<?php

namespace App\Imports;


use App\Models\ExcelEmployee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EmployeeImport implements ToModel ,WithHeadingRow, WithChunkReading, ShouldQueue
{

    use Importable;

    public function model(array $row)
    {
        return new ExcelEmployee([
            'name' => $row[0],
            'lob' => $row[1],
            'oracle' => $row[2],
            'site' => $row[3],
            'route' => $row[4],
            'cp' => $row[5],
            'gender' => $row[6],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }


}

