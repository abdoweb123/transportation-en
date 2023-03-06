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
use App\Models\RouteStation;
use App\Models\Station;
use App\Models\Route;
use App\Models\Office;
use App\Models\Driver;
use App\Models\StaticTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DriverImport implements ToCollection ,WithHeadingRow //, WithChunkReading, ShouldQueue
{

    use Importable;
    private $data;
    public $infraction_notadd_count,$arr_inf_not_add=[],$added;
    public function __construct(array $data = [])
    {
        $this->data = $data; 
    }

    public function collection(Collection $rows)
    {   
        Validator::make($rows->toArray(), [
            // '*.license_type' => 'required',
            // '*.office' => 'required',
            '*.name' => 'required',
            // '*.email' => 'required',
            '*.phone' => 'required',
            // '*.job_description' => 'required',
            // '*.id_number' => 'required',
            '*.password' => 'required',
            // '*.license_expire_date' => 'required',
        ])->validate();
        foreach ($rows as $row) {
            $insurance_kind=StaticTable::where('name',$row['license_type'])->whereType('insurance_kind')->first();
            if ($insurance_kind == null) {
                $data_type=new StaticTable();
                $data_type->name=$row['license_type'];
                $data_type->type='insurance_kind';
                $data_type->admin_id = auth('admin')->id();
                $data_type->save();
                $insurance_kind_id=$data_type->id;
            }else{
                $insurance_kind_id=$insurance_kind->id;
            }

            $office=Office::where(['name->ar'=>$row['office']])->orWhere('name->en',$row['office'])->first();
            if ($office != null) {
                $office_id=$office->id;
            }else{
                $office_id=0;
            }

            // if ($office != null) {
                $check=Driver::where(['name'=>$row['name'],'mobile'=>$row['phone']])->first();
                if ($check == null) {
                    $data=new Driver;
                }else{
                    $data=$check;
                }
                $data->admin_id = auth('admin')->id();
                $data->name =$row['name'];
                $data->email = $row['email'];
                $data->mobile=$row['phone'];
                $data->title=$row['job_description'];
                $data->password=Hash::make($row['password']);
                $data->office_id = $office_id;
                $data->national_id = $row['id_number'];
                $data->insurance_kind_id = $insurance_kind_id;
                $data->expiration_insurance_date =  Date::excelToDateTimeObject($row['license_expire_date'])->format('Y-m-d');
                $data->save();
            // }else{
            //     $this->infraction_notadd_count+=1;
            //     array_push($this->arr_inf_not_add,[$row['name'],$row['email'],$row['phone']]);
            // }
        }
    }

}

