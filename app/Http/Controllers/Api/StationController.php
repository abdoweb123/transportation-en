<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Station;
use Illuminate\Support\Facades\Auth;
class StationController extends Controller
{
    public $successStatus=200;
    public function get_stations()
    {
        $data=Station::where('is_active','Y')->get();

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

    public function add_stations(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name_ar'=>'required|unique:stations,name->ar',
            'name_en'=>'required|unique:stations,name->en',
            'lat'=>'required',
            'long'=>'required',
            'city_id'=>'required',
         ],[
            'name_ar.required'=>'name ar field required !',
            'name_ar.unique'=>'name ar already existed!',
            'name_en.required'=>'name en field required !',
            'name_en.unique'=>'name en already existed!',
            'lat.required'=>'lat field required !',
            'long.required'=>'long field required !',
            'city_id.required'=>'city field required !',
         ]);
         if ($validator->fails())
         {
            $message = $validator->errors()->first();
            $data_json['status']=false;
            $data_json['message']=$message;
            return response()->json($data_json, 200);
         }
         $admin_id = Auth::guard('admin-api')->id();

         $data=new Station();
         $data->name=['ar'=>$request->name_ar,'name_en'=>$request->name_en];
         $data->admin_id=$admin_id;
         $data->lat=$request->lat;
         $data->lon=$request->long;
         $data->city_id=$request->city_id;
         $data->description=$request->description;
         $data->description_en=$request->description_en;
         $data->save();

         if ($data) {
            $data_json['status']=true;
            $data_json['message']='added successfully';
            $data_json['data']=[];
            return response()->json($data_json, $this->successStatus);
        }else{
            $data_json['status']=false;
            $data_json['message']='Some thig wrong';
            $data_json['data']=[];
            return response()->json($data_json, $this->successStatus);
        }
    }
}
