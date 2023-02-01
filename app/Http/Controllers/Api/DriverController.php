<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\ClientTracker;
use App\Models\Review;
use App\Models\LocationTracker;
use App\Models\StationTracker;
use App\Models\EmployeeRunTripBus;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public $successStatus=200;
    public function login()
    {
        if(Auth::guard('driver')->attempt(['mobile' => request('phone'), 'password' => request('password')])){
            $user_id = Auth::guard('driver')->id();

            $data_fc_token = Driver::with('admin:id,name','office:id,name')->find($user_id);
            $data_fc_token['token'] =  $data_fc_token->createToken('submarin')->accessToken;
           
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data_fc_token;
            return response()->json($data_json, $this->successStatus);
        }else{
            $message='This data dont match with our records!';
            if (request()->header('lang') == 'ar') {
                $message='هذه البيانات ليست لدي سجلاتنا';
            }elseif (request()->header('lang') == 'en') {
                $message='This data I do not have our records';
            }
            $data_json['status']=false;
            $data_json['message']=$message;
            $data_json['data']=[];
            return response()->json($data_json, $this->successStatus);
        }
    }
    public function employeeRunTripsBuses()
    {
        $driver_id = Auth::guard('driver-api')->id();
        $data=EmployeeRunTripBus::with(['employeeRunTrip'=>function($employeeRunTrip){
            $employeeRunTrip->with('route:id,name');
        },'bus:id,code,name'])->select('id','employeeRunTrip_id','driver_id','bus_id')->where('driver_id',$driver_id)->get();
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
    public function employeeRunTripsBusesDetails($employee_run_trip_bus_id)
    {
        $driver_id = Auth::guard('driver-api')->id();
        $data=EmployeeRunTripBus::with(['employeeRunTrip'=>function($employeeRunTrip){
            $employeeRunTrip->with('route:id,name','employees');
        },'bus:id,code,name','client_trackers','station_tracker'])->select('id','employeeRunTrip_id','driver_id','bus_id','started','ended')->find($employee_run_trip_bus_id);
        // $data['station_tracker']=StationTracker::where('driver_id',$driver_id)->get();
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
    public function location_tracker(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'bus_id'=>'required',
            'lat'=>'required',
            'long'=>'required',
         ],[
            'bus_id.required'=>'bus_id field required !',
            'lat.required'=>'lat field required !',
            'long.required'=>'long field required !',
         ]);
         $driver_id = Auth::guard('driver-api')->id();

         $data=LocationTracker::where(['bus_id'=>$request->bus_id,'driver_id'=>$driver_id])->first();
         if ($data) {
            $data->lat=$request->lat;
            $data->long=$request->long;
            $data->driver_id=$driver_id;
            $data->save();
         }else{
            $data=new LocationTracker();
            $data->bus_id=$request->bus_id;
            $data->lat=$request->lat;
            $data->long=$request->long;
            $data->driver_id=$driver_id;
            $data->save();
         }
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

    public function station_tracker(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'route_station_id'=>'required',
         ],[
            'route_station_id.required'=>'route_station_id field required !',
         ]);

        $driver_id = Auth::guard('driver-api')->id();

         $data=StationTracker::where(['route_station_id'=>$request->route_station_id,'driver_id'=>$driver_id,'employee_run_trip_bus_id'=>$request->employee_run_trip_bus_id])->first();
         if ($data) {
            if ($request->enter == 1) {
                $data->enter='Y';
            }else{
                $data->enter='N';
            }

            if ($request->left == 1) {
                $data->left='Y';
            }else{
                $data->left='N';
            }
            $data->save();
         }else{
            $data=new StationTracker();
            $data->driver_id=$driver_id;
            $data->route_station_id=$request->route_station_id;
            $data->employee_run_trip_bus_id=$request->employee_run_trip_bus_id;

            if ($request->enter == 1) {
                $data->enter='Y';
            }else{
                $data->enter='N';
            }

            if ($request->left == 1) {
                $data->left='Y';
            }else{
                $data->left='N';
            }
            $data->save();
         }
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
    public function started_trip($id)
    {
        $data=EmployeeRunTripBus::find($id);
        $data->started='Y';
        $data->save();

        $data_json['status']=true;
        $data_json['message']='edit successfully';
        $data_json['data']=$data;
        return response()->json($data_json, $this->successStatus);
    }
    public function end_trip($id)
    {
        $data=EmployeeRunTripBus::find($id);
        $data->ended='Y';
        $data->save();
        
        $data_json['status']=true;
        $data_json['message']='edit successfully';
        $data_json['data']=$data;
        return response()->json($data_json, $this->successStatus);
    }
    public function client_tracker(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'employee_run_trip_bus_id'=>'required',
            'bus_id'=>'required',
            'employee_id'=>'required',
         ],[
            'employee_run_trip_bus_id.required'=>'employee_run_trip_bus_id field required !',
            'bus_id.required'=>'bus_id field required !',
            'employee_id.required'=>'employee_id field required !',
         ]);
 
         $data=ClientTracker::where(['employee_run_trip_bus_id'=>$request->employee_run_trip_bus_id,'employee_id'=>$request->employee_id,'bus_id'=>$request->bus_id])->first();
         if ($data) {
            $data->enter=$request->enter;
            $data->leave=$request->leave;
            $data->not_found=$request->not_found;
            $data->save();
         }else{
            $data=new ClientTracker();
            $data->employee_run_trip_bus_id=$request->employee_run_trip_bus_id;
            $data->bus_id=$request->bus_id;
            $data->employee_id=$request->employee_id;
            $data->enter=$request->enter;
            $data->leave=$request->leave;
            $data->not_found=$request->not_found;
            $data->save();
         }
         if ($data) {
            $data_json['status']=true;
            $data_json['message']='added successfully';
            $data_json['data']=$data;
            return response()->json($data_json, $this->successStatus);
        }else{
            $data_json['status']=false;
            $data_json['message']='لا يوجد بيانات!';
            $data_json['data']=[];
            return response()->json($data_json, $this->successStatus);
        }
    }
    
    public function get_review($id)
    {
        $data['review']=Review::where('driver_id',$id)->get();
        $data['sum_rate']=$data['review']->sum('rate');
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
