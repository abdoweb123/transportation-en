<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Api\MyEmployee;
use App\Models\BookingRequest;
use App\Models\EmployeeRunTripBus;
use App\Models\SwapRequest;
use App\Models\Review;

class EmployeeController extends Controller
{
    public $successStatus=200;
    public function login()
    {
        if(Auth::guard('employee')->attempt(['phone' => request('phone_email'), 'password' => request('password')])){
            $user_id = Auth::guard('employee')->id();

            $data_fc_token = MyEmployee::with('admin:id,name','office:id,name','collectionPoint:id,name','EmployeeJob:id,name','department:id,name')->find($user_id);
            $data_fc_token['token'] =  $data_fc_token->createToken('submarin')->accessToken;
           
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data_fc_token;
            return response()->json($data_json, $this->successStatus);
        }elseif(Auth::guard('employee')->attempt(['email' => request('phone_email'), 'password' => request('password')])){
            $user_id = Auth::guard('employee')->id();

            $data_fc_token = MyEmployee::with('admin:id,name','office:id,name','collectionPoint:id,name','EmployeeJob:id,name','department:id,name')->find($user_id);
            $data_fc_token['token'] =  $data_fc_token->createToken('submarin')->accessToken;
           
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data_fc_token;
            return response()->json($data_json, $this->successStatus);
        }elseif(Auth::guard('employee')->attempt(['oracle_id' => request('phone_email'), 'password' => request('password')])){
            $user_id = Auth::guard('employee')->id();

            $data_fc_token = MyEmployee::with('admin:id,name','office:id,name','collectionPoint:id,name','EmployeeJob:id,name','department:id,name')->find($user_id);
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
 
    public function booking_request()
    {
        $employee_id = Auth::guard('employee-api')->id();
        $data=BookingRequest::with('collection_point_from:id,name','collection_point_to:id,name','route:id,name','bus:id,name,code','employee_run_trip:id,date,time')->where('employee_id',$employee_id)->get();

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
    public function booking_request_details($id)
    {
        $data=BookingRequest::with('collection_point_from:id,name','collection_point_to:id,name','route:id,name','bus','employee_run_trip:id,date,time')->find($id);
        $data['employee_run_trip_bus']=EmployeeRunTripBus::with('drivers:id,name,mobile')
                                                            ->where(['employeeRunTrip_id'=>$data->employeeRunTrip_id,'bus_id'=>$data->bus_id])
                                                            ->select('id','employeeRunTrip_id','driver_id','bus_id','started','ended')
                                                            ->first();
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
    public function swap_request(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'booking_request_id'=>'required',
            'from'=>'required',
            'to'=>'required',
            'date'=>'required',
            'time'=>'required',
         ],[
            'booking_request_id.required'=>'booking_request field required !',
            'from.required'=>'from field required !',
            'to.required'=>'to field required !',
            'date.required'=>'date field required !',
            'time.required'=>'time field required !',
         ]);
         if ($validator->fails())
         {
            $message = $validator->errors()->first();
            $data_json['status']=false;
            $data_json['message']=$message;
            return response()->json($data_json, 200);
         }
         $employee_id = Auth::guard('employee-api')->id();

         $check=SwapRequest::where(['employee_id'=>$employee_id,'booking_request_id'=>$request->booking_request_id])->first();
         if ($check) {
            $data_json['status']=false;
            $data_json['message']='Ordered before!';
            return response()->json($data_json, 200);
         }

         $data=new SwapRequest();
         $data->employee_id=$employee_id;
         $data->booking_request_id=$request->booking_request_id;
         $data->from=$request->from;
         $data->to=$request->to;
         $data->date=$request->date;
         $data->time=$request->time;
         $data->comment=$request->comment;
         $data->save();

         if ($data) {
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data;
            return response()->json($data_json, $this->successStatus);
        }else{
            $data_json['status']=false;
            $data_json['message']='Some thig wrong';
            $data_json['data']=[];
            return response()->json($data_json, $this->successStatus);
        }
    }
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'oracle_id' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'gender' => 'required',
        ],[
            'name.required' => 'الاسم مطلوب',
            'oracle_id.required' => ' oracl_id مطلوب',
            'address.required' => 'العنوان مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'email.required' => 'الايميل  مطلوب',
            'gender.required' => 'النوع مطلوب',
        ]);
           $this->message='تم التعديل بنجاح ';
           $this->message_not_fond='لا يوجد بيانات';
           
        if (request()->header('lang') == 'en') {
            $this->message='successfully updated';
            $this->message_not_fond='There are no data';
        }
        if ($validator->fails()) {
            $errors=$validator->errors();
            $error_mg='';
            foreach ($errors->all() as $error) {
                $error_mg.=$error.' . ';
            }
            $data_json['result']=false;
            $data_json['error_message']=$error_mg;
            $data_json['error_message_en']=$error_mg;
            return response()->json($data_json, 200);
        }
    
        $employee_id = Auth::guard('employee-api')->id();
        $data=MyEmployee::find($employee_id);
        $data->name=$request->name;
        $data->oracle_id=$request->oracle_id;
        $data->address=$request->address;
        $data->phone=$request->phone;
        $data->email=$request->email;
        $data->gender=$request->gender;
        $data->save();
        if ($data) {
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data;
            return response()->json($data_json, $this->successStatus);
        }else{
            $data_json['status']=false;
            $data_json['message']='Some thig wrong';
            $data_json['data']=[];
            return response()->json($data_json, $this->successStatus);
        }
    }
    public function add_review(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'booking_request_id' => 'required',
            'driver_id' => 'required',
            'rate' => 'required',
        ],[
            'name.required' => 'الاسم مطلوب',
            'driver_id.required' => ' السواق مطلوب',
            'rate.required' => 'التقييم مطلوب',
        ]);
           $this->message='تم التعديل بنجاح ';
           $this->message_not_fond='لا يوجد بيانات';
           
        if (request()->header('lang') == 'en') {
            $this->message='successfully updated';
            $this->message_not_fond='There are no data';
        }
        if ($validator->fails()) {
            $errors=$validator->errors();
            $error_mg='';
            foreach ($errors->all() as $error) {
                $error_mg.=$error.' . ';
            }
            $data_json['result']=false;
            $data_json['error_message']=$error_mg;
            $data_json['error_message_en']=$error_mg;
            return response()->json($data_json, 200);
        }

        $employee_id = Auth::guard('employee-api')->id();
        $data=new Review();
        $data->employee_id=$employee_id;
        $data->driver_id=$request->driver_id;
        $data->booking_request_id=$request->booking_request_id;
        $data->rate=$request->rate;
        $data->comment=$request->comment;
        $data->save();
        if ($data) {
            $data_json['status']=true;
            $data_json['message']='';
            $data_json['data']=$data;
            return response()->json($data_json, $this->successStatus);
        }else{
            $data_json['status']=false;
            $data_json['message']='Some thig wrong';
            $data_json['data']=[];
            return response()->json($data_json, $this->successStatus);
        }

    }
}
