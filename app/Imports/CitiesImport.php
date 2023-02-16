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
use Illuminate\Support\Facades\Validator;
use App\Models\City;
class CitiesImport implements ToCollection ,WithHeadingRow //, WithChunkReading, ShouldQueue
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
            '*.arabic_name' => 'required',
            '*.english_name' => 'required',
            '*.active' => 'required',
        ])->validate();
        foreach ($rows as $row) {
            $check=City::where(['name->ar'=>$row['arabic_name'] ,'name->en'=>$row['english_name'] ,'company_id'=>$this->data['company_id']])->first();
            if ($check == null) {
                $data=new City;
            }else{
                $data=$check;
            }
            $data->name = ['ar' => $row['arabic_name'], 'en' => $row['english_name']];
            $data->admin_id = auth('admin')->id();
            $data->company_id=$this->data['company_id'];
            $data->is_active=$row['active'];
            $data->save();
        }
    }

}

