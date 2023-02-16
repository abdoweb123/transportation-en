<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverStoreRequest;
use App\Http\Requests\DriverUpdateRequest;
use App\Models\Driver;
use App\Models\Office;
use App\Models\DriverImage;
use App\Models\StaticTable;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DriverImport;
class DriverController extends Controller
{
    /*** get all drivers ***/
    public function getAllDrivers()
    {
        $drivers = Driver::latest()->paginate(10);
        $offices = Office::select('id','name')->get();
        $insurance_kinds =StaticTable::whereAdminId(Auth::guard('admin')->id())->select('id','name')->whereType('insurance_kind')->get();
        return view('pages.Drivers.index',compact('drivers','offices','insurance_kinds'));
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
            'national_id' => $request['national_id'],
            'insurance_kind_id' => $request['insurance_kind_id'],
            'expiration_insurance_date' => $request['expiration_insurance_date'],
            'insurance_insurance_date' => $request['insurance_insurance_date'],
        ]);
            if ($request->file('images')) {
                foreach ($request->images as $image) {
                    $path = 'assets/images/drivers/';
                    $photo = time() . rand(1,20000). uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move($path,$photo);
                    $image_path = "$photo";

                    $user_imag=new DriverImage();
                    $user_imag->image=$image_path;
                    $user_imag->driver_id=$driver->id;
                    $user_imag->save();
                }
            }
        return redirect()->back()->with('alert-success','تم إضافة المستخدم بنجاح');
    }


    public function import_file(Request $request)
    {
        if ($request->excel == null) {
            return redirect()->back()->with('alert-danger','plz check file!');
        }
        // $data=[
        //     'company_id'=> $request->company_id
        //  ];
        $dataa=new DriverImport();
        Excel::import($dataa,$request->excel);
        if($dataa->arr_inf_not_add){
            return redirect()->route('getAllDrivers')->with([ 'dataa' => $dataa->arr_inf_not_add ]);
        }
        return redirect()->route('getAllDrivers')->with('alert-info','تم الاضافه بنجاح');
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
