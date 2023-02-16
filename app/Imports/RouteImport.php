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
use App\Models\Route;
use Illuminate\Support\Facades\Validator;

class RouteImport implements ToCollection ,WithHeadingRow //, WithChunkReading, ShouldQueue
{

    use Importable;
    private $data;
    public function __construct(array $data = [])
    {
        $this->data = $data; 
    }

    public function collection(Collection $rows)
    {   
        Validator::make($rows->toArray(), [
            '*.name' => 'required',
            '*.active' => 'required',
        ])->validate();
        foreach ($rows as $row) {
            $check=Route::where(['name'=>$row['name'],'company_id'=>$this->data['company_id']])->first();
            if ($check == null) {
                $data=new Route;
            }else{
                $data=$check;
            }
            $data->name =$row['name'];
            $data->admin_id = auth('admin')->id();
            $data->company_id=$this->data['company_id'];
            $data->active=$row['active'];
            $data->save();
        }
    }

}

