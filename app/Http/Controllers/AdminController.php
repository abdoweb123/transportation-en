<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLogin;
use App\Http\Requests\AdminRegister;
use App\Http\Requests\RegisterAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdminController
{

    /*** registerView function ***/
    public function registerView()
    {
        return view('authAdmin.register');
    }



    /*** registerTest function ***/
    public function registerTest(RegisterAdminRequest $request)
    {
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'superVisor_id' => auth('superVisor')->id(),
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->back()->with('alert-success','تم إضافة مدير الفرع بنجاح');
    }




//    /*** adminDashboard function ***/
//    public function adminDashboard()
//    {
//        return view('authAdmin.admin_dashboard');
//    }



} //end of class
