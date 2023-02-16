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
use App\Models\CotractRoute;
use App\Models\Route;
use App\Models\Discount;
use App\Models\BusType;
use App\Models\StaticTable;
use App\Models\ContractClient;
use Illuminate\Support\Facades\Validator;
class ClientContractRouteImport implements ToCollection ,WithHeadingRow //, WithChunkReading, ShouldQueue
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
            '*.bus_type' => 'required',
            '*.service_type' => 'required',
            '*.discount_copoun' => 'required',
            '*.contract' => 'required',
            '*.payment_type' => 'required',
            '*.service_value' => 'required',
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


            $service_type=StaticTable::where('name',$row['service_type'])->whereType('service')->first();
            if ($service_type == null) {
                $data_type=new StaticTable();
                $data_type->name=$row['service_type'];
                $data_type->type='service';
                $data_type->admin_id = auth('admin')->id();
                $data_type->save();
                $service_type_id=$data_type->id;
            }else{
                $service_type_id=$service_type->id;
            }

            // $supplier=StaticTable::where('name',$row['supplier'])->whereType('suppliers')->first();
            // if ($supplier == null) {
            //     $data_type=new StaticTable();
            //     $data_type->name=$row['supplier'];
            //     $data_type->type='suppliers';
            //     $data_type->admin_id = auth('admin')->id();
            //     $data_type->save();
            //     $supplier_id=$data_type->id;
            // }else{
            //     $supplier_id=$supplier->id;
            // }

            $discount=Discount::where('title',$row['discount_copoun'])->first();

            $contract=ContractClient::where('name',$row['contract'])->first();

            $bus_type=BusType::where('name',$row['bus_type'])->first();


        if ($bus_type != null && $discount != null && $contract != null) {
                $check=CotractRoute::where(['contracts_id'=>$contract->id,'route_id'=>$route_id,'bus_type_id'=>$bus_type->id,'service_type_id'=>$service_type_id])->first();
                if ($check == null) {
                    $data=new CotractRoute;
                }else{
                    $data=$check;
                }
                $data->contracts_id=$contract->id;
                $data->company_id=$this->data['company_id'];
                $data->route_id=$route_id;
                $data->bus_type_id=$bus_type->id;
                $data->service_type_id=$service_type_id;
                $data->payment_type=$row['payment_type'];
                $data->operations_number=CotractRoute::count()+1;
                $data->discount_id=$discount->id;
                $data->service_value=$row['service_value'];
                $data->save();
                $this->added+=1;
            }else{
                $this->infraction_notadd_count+=1;
                array_push($this->arr_inf_not_add,[$row['route'],$row['bus_type'],$row['service_type']]);
            }
        }
    }

}

