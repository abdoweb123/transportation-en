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
use App\Models\Discount;
use App\models\StaticTable;
use Illuminate\Support\Facades\Validator;
class DiscountImport implements ToCollection ,WithHeadingRow //, WithChunkReading, ShouldQueue
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
            '*.discount_type' => 'required',
            '*.title' => 'required',
            '*.amount' => 'required',
            '*.percentage' => 'required',
        ])->validate();
        foreach ($rows as $row) {
                $discount_type=StaticTable::where('name',$row['discount_type'])->whereType('discount_type')->first();
                if ($discount_type == null) {
                    $data_type=new StaticTable();
                    $data_type->name=$row['discount_type'];
                    $data_type->type='discount_type';
                    $data_type->admin_id = auth('admin')->id();
                    $data_type->save();
                    $discount_type_id=$data_type->id;
                }else{
                    $discount_type_id=$discount_type->id;
                }
                $check=Discount::where(['title'=>$row['title']])->first();
                if ($check == null) {
                    $data=new Discount;
                }else{
                    $data=$check;
                }
                $data->title = $row['title'];
                $data->discount_type_id= $discount_type_id;
                $data->amount = $row['amount'];
                $data->presentage = $row['percentage'];
                $data->save();
            }
    }

}

