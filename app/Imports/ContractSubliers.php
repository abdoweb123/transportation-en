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
use App\Models\ContractSublier;
use App\Models\StaticTable;
use Illuminate\Support\Facades\Validator;
class ContractSubliers implements ToCollection ,WithHeadingRow //, WithChunkReading, ShouldQueue
{

    use Importable;
    private $data;
    public function __construct(array $data = [])
    {
        $this->data = $data; 
    }

    public function collection(Collection $rows)
    {    Validator::make($rows->toArray(), [
        '*.name' => 'required',
        '*.supplier' => 'required',
        '*.start_date' => 'required',
        '*.end_date' => 'required',
        '*.number_of_routes' => 'required',
    ])->validate();
    foreach ($rows as $row) {
            $supplier=StaticTable::where('name',$row['supplier'])->whereType('suppliers')->first();
            if ($supplier == null) {
                $data_type=new StaticTable();
                $data_type->name=$row['supplier'];
                $data_type->type='suppliers';
                $data_type->admin_id = auth('admin')->id();
                $data_type->save();
                $supplier_id=$data_type->id;
            }else{
                $supplier_id=$supplier->id;
            }

            $check=ContractSublier::where(['name'=>$row['name']])->first();
            if ($check == null) {
                $data=new ContractSublier;
            }else{
                $data=$check;
            }
            $data->name = $row['name'];
            $data->admin_id = auth('admin')->id();
            $data->sublier_id=$supplier_id;
            $data->start_date =Date::excelToDateTimeObject($row['start_date'])->format('Y-m-d') ;
            $data->end_date =Date::excelToDateTimeObject($row['end_date'])->format('Y-m-d') ;
            $data->number_of_routes = $row['number_of_routes'];
            $data->save();
        }
    }

}

