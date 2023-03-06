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
use App\Models\ContractClient;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;
class ContractClientImport implements ToCollection ,WithHeadingRow //, WithChunkReading, ShouldQueue
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
            '*.start_date' => 'required',
            '*.company' => 'required',
            '*.end_date' => 'required',
            '*.number_of_routes' => 'required',
        ])->validate();
       

        foreach ($rows as $row) {

            $company_check=Company::where('id',$row['company'])->orWhere('name',$row['company'])->first();
            if ($company_check != null) {
                $company_id=$company_check->id;
            }else {
                $company=new Company();
                $company->name=$row['company'];
                $company->admin_id=auth('admin')->user()->id;
                $company->save();
                $company_id=$company->id;
            }

            $check=ContractClient::where(['name'=>$row['name'],'company_id'=>$company_id])->first();
            if ($check == null) {
                $data_new=new ContractClient();
            }else{
                $data_new=$check;
            }
          
            $data_new->name = $row['name'];
            $data_new->admin_id = auth('admin')->id();
            $data_new->company_id=$company_id;
            $data_new->start_date =Date::excelToDateTimeObject($row['start_date'])->format('Y-m-d');
            $data_new->end_date =Date::excelToDateTimeObject($row['end_date'])->format('Y-m-d');
            $data_new->number_of_routes = $row['number_of_routes'];
            // dd($company_id);
            $data_new->save();
        }
    }

}

