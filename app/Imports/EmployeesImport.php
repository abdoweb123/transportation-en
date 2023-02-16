<?php

namespace App\Imports;


use App\Models\ExcelEmployee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\MyEmployee;
use App\Models\Office;
use App\Models\Station;
use App\Models\EmployeeJob;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
class EmployeesImport implements ToCollection ,WithHeadingRow //, WithChunkReading, ShouldQueue
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
            '*.gender' => 'required',
            '*.office' => 'required',
            '*.name' => 'required',
            '*.email' => 'required',
            '*.phone' => 'required',
            '*.oracle_id' => 'required',
            '*.password' => 'required',
            '*.collection_point' => 'required',
            '*.department' => 'required',
            '*.address' => 'required',
            '*.job' => 'required',
        ])->validate();
        foreach ($rows as $row) {
            $office=Office::where(['name->ar'=>$row['office']])->orWhere('name->en',$row['office'])->first();
            $collection_point=Station::where(['name->ar'=>$row['collection_point']])->orWhere('name->en',$row['collection_point'])->first();
            $job=EmployeeJob::where(['name'=>$row['job']])->first();
            $department=Department::where(['name'=>$row['department']])->first();
            if ($office != null && $collection_point != null && $job != null && $department!= null) {
                $check=MyEmployee::where(['name'=>$row['name'],'oracle_id'=>$row['oracle_id'],'company_id'=>$this->data['company_id']])->first();
                if ($check == null) {
                    $data=new MyEmployee;
                }else{
                    $data=$check;
                }
                $data->name = $row['name'];
                $data->admin_id = auth('admin')->id();
                $data->company_id=$this->data['company_id'];
                $data->oracle_id=$row['oracle_id'];
                $data->office_id=$office->id;
                $data->collectionPoint_id=$collection_point->id;
                $data->employeeJob_id=$job->id;
                $data->department_id=$department->id;
                $data->address=$row['address'];
                $data->gender=$row['gender'];
                $data->phone=$row['phone'];
                $data->email=$row['email'];
                $data->password=Hash::make($row['password']) ;
                $data->active=1;
                $data->save();
            }else{
                $this->infraction_notadd_count+=1;
                array_push($this->arr_inf_not_add,[$row['name'],$row['oracle_id']]);
            }
        }
    }

}

