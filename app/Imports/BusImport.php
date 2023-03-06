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
use App\Models\Bus;
use App\Models\Route;
use App\Models\Discount;
use App\Models\BusType;
use App\Models\StaticTable;
use App\Models\Driver;

class BusImport implements ToModel ,WithHeadingRow //, WithChunkReading, ShouldQueue
{

    use Importable;
    private $data;
    public $infraction_notadd_count,$arr_inf_not_add=[],$added;
    public function __construct(array $data = [])
    {
        $this->data = $data; 
    }

    public function model(array $row)
    {
        $gas_type=StaticTable::where('name',$row['gas_type'])->whereType('gas_type')->first();
        if ($gas_type == null) {
            $data_type=new StaticTable();
            $data_type->name=$row['gas_type'];
            $data_type->type='gas_type';
            $data_type->admin_id = auth('admin')->id();
            $data_type->save();
            $gas_type_id=$data_type->id;
        }else{
            $gas_type_id=$gas_type->id;
        }

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

        $bus_model=StaticTable::where('name',$row['bus_model'])->whereType('bus_model')->first();
        if ($bus_model == null) {
            $data_type=new StaticTable();
            $data_type->name=$row['bus_model'];
            $data_type->type='bus_model';
            $data_type->admin_id = auth('admin')->id();
            $data_type->save();
            $bus_model_id=$data_type->id;
        }else{
            $bus_model_id=$bus_model->id;
        }

        $insurance_company=StaticTable::where('name',$row['insurance_company'])->whereType('insurance_company')->first();
        if ($insurance_company == null) {
            $data_type=new StaticTable();
            $data_type->name=$row['insurance_company'];
            $data_type->type='insurance_company';
            $data_type->admin_id = auth('admin')->id();
            $data_type->save();
            $insurance_company_id=$data_type->id;
        }else{
            $insurance_company_id=$insurance_company->id;
        }

        $bank=StaticTable::where('name',$row['bank'])->whereType('bank')->first();
        if ($bank == null) {
            $data_type=new StaticTable();
            $data_type->name=$row['bank'];
            $data_type->type='bank';
            $data_type->admin_id = auth('admin')->id();
            $data_type->save();
            $bank_id=$data_type->id;
        }else{
            $bank_id=$bank->id;
        }

        $driver=Driver::where('name',$row['driver'])->first();

        if($driver != null){
            $driver_id=$driver->id;
        }else{
            $driver_id=0;
        }

        $bus_type=BusType::where('name',$row['bus_type'])->first();


       if ($bus_type != null) {
            $check=Bus::where(['name'=>$row['name'],'code'=>$row['code'],'shase_number'=>$row['shase_number']])->first();
            if ($check == null) {
                $data=new Bus;
            }else{
                $data=$check;
            }
            $data->admin_id=auth('admin')->id();
            $data->name=$row['name'];
            $data->code=$row['code'];
            $data->busType_id=$bus_type->id;
            $data->gas_type_id=$gas_type_id;
            $data->motor_number=$row['motor_number'];
            $data->suplier_id=$supplier_id;
            $data->driver_id=$driver_id;
            $data->shase_number=$row['shase_number'];
            $data->bus_model_id=$bus_model_id;
            $data->insurance_company_id=$insurance_company_id;
            $data->bank_id=$bank_id;
            $data->expiration_insurance_from=Date::excelToDateTimeObject($row['insurance_license_start_date'])->format('Y-m-d');
            $data->expiration_insurance_to=Date::excelToDateTimeObject($row['insurance_license_end_date'])->format('Y-m-d');
            $data->insurance_insurance_from=Date::excelToDateTimeObject($row['insurance_taxes_start_date'])->format('Y-m-d');
            $data->insurance_insurance_from=Date::excelToDateTimeObject($row['insurance_taxes_end_date'])->format('Y-m-d');
            $data->save();
            $this->added+=1;
        }else{
            $this->infraction_notadd_count+=1;
            array_push($this->arr_inf_not_add,[$row['name'],$row['code'],$row['shase_number']]);
        }
    }

}

