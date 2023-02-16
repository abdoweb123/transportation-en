<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
class PublicServiceController extends Controller
{
    public $successStatus=200;
    public function cities()
    {
        $data=City::where('is_active','Y')->get();

        if ($data) {
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data;
            return response()->json($data_json, $this->successStatus);
        }else{
            $data_json['status']=false;
            $data_json['message']='لا يوجد بيانات!';
            $data_json['data']=[];
            return response()->json($data_json, $this->successStatus);
        }
    }
}
