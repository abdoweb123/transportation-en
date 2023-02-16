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
use App\Models\Station;
use App\Models\City;
use Illuminate\Support\Facades\Validator;
class StationImport implements ToCollection ,WithHeadingRow //, WithChunkReading, ShouldQueue
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
            '*.arabic_name' => 'required',
            '*.english_name' => 'required',
            '*.city' => 'required',
            '*.latitude' => 'required',
            '*.longitude' => 'required',
            '*.active' => 'required',
        ])->validate();
        foreach ($rows as $row) {
            $city=City::where('name->ar',$row['city'])->orWhere('name->en',$row['city'])->first();
            if ($city != null) {
                $check=Station::where(['name->ar'=>$row['arabic_name'] ,'name->en'=>$row['english_name'],'company_id'=>$this->data['company_id']])->first();
                if ($check == null) {
                    $data=new Station;
                }else{
                    $data=$check;
                }
                $data->name = ['ar' => $row['arabic_name'], 'en' => $row['english_name']];
                $data->admin_id = auth('admin')->id();
                // $data->company_id=$this->data['company_id'];
                $data->city_id=$city->id;
                $data->lat = $row['latitude'];
                $data->lon = $row['longitude'];
                $data->is_active=$row['active'];
                $data->save();
            }else{
                $this->infraction_notadd_count+=1;
                array_push($this->arr_inf_not_add,[$row['arabic_name'],$row['english_name']]);
            }
        }
    }

}

