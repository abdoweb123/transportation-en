<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
class AdminController extends Controller
{
    public $successStatus=200;
    public function login()
    {
        if(Auth::guard('admin')->attempt(['email' => request('phone_email'), 'password' => request('password')])){
            $user_id = Auth::guard('admin')->id();

            $data_fc_token = Admin::find($user_id);
            $data_fc_token['token'] =  $data_fc_token->createToken('admin')->accessToken;
           
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
}
