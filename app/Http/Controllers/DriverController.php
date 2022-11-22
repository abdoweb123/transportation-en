<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverStoreRequest;
use App\Http\Requests\DriverUpdateRequest;
use App\Models\Driver;
use App\Models\Office;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    /*** get all drivers ***/
    public function getAllDrivers()
    {
        $drivers = Driver::latest()->paginate(10);
        $offices = Office::select('id','name')->get();
        return view('pages.Drivers.index',compact('drivers','offices'));
    }



    /*** create drivers ***/
    public function create(DriverStoreRequest $request)
    {
        $data = $request->all();
        if( $image = $request->file('image'))
        {
            $path = 'assets/images/drivers/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['image'] = "$photo";
        }

        $driver = Driver::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'image' => $data['image'],
            'admin_id' => auth('admin')->id(),
            'office_id' => $request['office_id'],
            'password' => Hash::make($request['password']),
            'title' => $request['title'],
            'role' => $request['role'],
            'email_verified_at' => $request['email_verified_at'],
            'fcm_token' => $request['fcm_token'],
            'bio' => $request['bio'],
            'balance' => $request['balance'],
            'real_balance' => $request['real_balance'],
            'percentage' => $request['percentage'],
            'manager' => $request['manager'],
        ]);

        return redirect()->back()->with('alert-success','تم إضافة المستخدم بنجاح');
    }



    /*** update drivers ***/
    public function update(DriverUpdateRequest $request)
    {
        $data = $request->all();
        $driver = Driver::findOrFail($request->id);

        if( $image = $request->file('image'))
        {
            $path = 'assets/images/drivers/';
            $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path,$photo);
            $data['image'] = "$photo";
        }else{
            $data['image'] = $driver->image;
        }


        if ($request->password === $driver->password)
        {
            $driver->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'image' => $data['image'],
                'admin_id' => auth('admin')->id(),
                'office_id' => $request['office_id'],
                'title' => $request['title'],
                'role' => $request['role'],
                'email_verified_at' => $request['email_verified_at'],
                'fcm_token' => $request['fcm_token'],
                'bio' => $request['bio'],
                'balance' => $request['balance'],
                'real_balance' => $request['real_balance'],
                'percentage' => $request['percentage'],
                'manager' => $request['manager'],
            ]);
        }
        else{
            $driver->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'image' => $data['image'],
                'admin_id' => auth('admin')->id(),
                'office_id' => $request['office_id'],
                'password' => Hash::make($request['password']),
                'title' => $request['title'],
                'role' => $request['role'],
                'email_verified_at' => $request['email_verified_at'],
                'fcm_token' => $request['fcm_token'],
                'bio' => $request['bio'],
                'balance' => $request['balance'],
                'real_balance' => $request['real_balance'],
                'percentage' => $request['percentage'],
                'manager' => $request['manager'],
            ]);
        }

        return redirect()->back()->with('alert-success','تم تحديث بيانات المستخدم بنجاح');
    }



    /*** create drivers ***/
    public function delete(Request $request)
    {
        $driver = Driver::findOrFail($request->id);
        $image_path = 'assets/images/drivers/'.$driver->image;

        if (file_exists($image_path))
        {
            @unlink($image_path);
        }

        $driver->delete();
        return redirect()->back()->with('alert-success','تم حذف المستخدم بنجاح');
    }


} //end of class
