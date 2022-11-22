<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLogin;
use App\Http\Requests\AdminRegister;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\RegisterAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdminController
{

    /*** get all ( employees || managers ) ***/
    public function getAllAdmins($id)
    {
        if ($id == 3){
            $employees = Admin::where('type','3')->with('parent')->latest()->paginate(10);
            return view('pages.Employees.index',compact('employees'));
        }
        elseif($id == 2){
            $managers = Admin::where('type','2')->latest()->paginate(10);
            return view('pages.Managers.index',compact('managers'));
        }
    }



    /*** create admins ( managers or employee ) ***/
    public function create(AdminRegister $request)
    {
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'admin_id' => auth('admin')->id(),
            'type' => $request['type'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->back()->with('alert-success','تم إضافة المستخدم بنجاح');
    }



    /*** update admins ( managers or employee ) ***/
    public function update(AdminUpdateRequest $request)
    {
        $admin = Admin::findOrFail($request->id);
        if ($request->password === $admin->password)
        {
            $admin->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'admin_id' => auth('admin')->id(),
            ]);
        }
         else{
             $admin->update([
                 'name' => $request['name'],
                 'email' => $request['email'],
                 'password' => Hash::make($request['password']),
                 'admin_id' => auth('admin')->id(),
             ]);
         }

        return redirect()->back()->with('alert-success','تم تحديث بيانات المستخدم بنجاح');
    }



    /*** create admins ( managers or employee ) ***/
    public function delete(Request $request)
    {
        Admin::findOrFail($request->id)->delete();
        return redirect()->back()->with('alert-success','تم حذف المستخدم بنجاح');
    }



} //end of class
