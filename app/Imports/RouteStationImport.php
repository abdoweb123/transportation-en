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
use Illuminate\Support\Facades\Validator;

class RouteStationImport implements ToCollection ,WithHeadingRow //, WithChunkReading, ShouldQueue
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
            '*.route' => 'required',
            '*.station' => 'required',
            // '*.status' => 'required',
        ])->validate();
        foreach ($rows as $row) {
            $route=Route::where('name',$row['route'])->first();
            if ($route == null) {
                $data_type=new Route();
                $data_type->name=$row['route'];
                $data_type->admin_id = auth('admin')->id();
                $data_type->company_id=$this->data['company_id'];
                $data_type->description=$row['route'];
                $data_type->active=1;
                $data_type->save();
                $route_id=$data_type->id;
            }else{
                $route_id=$route->id;
            }

            $station=Station::where('name->ar',$row['station'])->orWhere('name->name_en',$row['station'])->first();
            if ($station != null) {
                $check=RouteStation::where(['route_id'=>$route->id,'station_id'=>$station->id])->first();
                if ($check == null) {
                    $data=new RouteStation;
                }else{
                    $data=$check;
                }
                $data->route_id = $route->id;
                $data->station_id = $station->id;
                $data->station_name=$station->name;
                $data->company_id=$this->data['company_id'];
                $data->admin_id = auth('admin')->id();
                $data->active=$row['status'];
                $data->save();
            }else{
                $this->infraction_notadd_count+=1;
                array_push($this->arr_inf_not_add,[$row['station'],$row['route']]);
            }
        }
    }

}

