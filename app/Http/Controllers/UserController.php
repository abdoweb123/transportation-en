<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*** get all users ***/
    public function getAllUsers()
    {
        $users = User::latest()->paginate(10);
//        $packages = Package::select('id','title')->get();
        return view('pages.Users.index',compact('users'));
    }



    /*** create user ***/
    public function create(UserRequest $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'admin_id' => auth('admin')->id(),
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->back()->with('alert-success','تم إضافة المستخدم بنجاح');
    }



    /*** update user ***/
    public function update(UserRequest $request)
    {
        $user = User::findOrFail($request->id);

        if ($request->password === $user->password)
        {
            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'admin_id' => auth('admin')->id(),
            ]);
        }
        else{
            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'admin_id' => auth('admin')->id(),
                'password' => Hash::make($request['password']),
            ]);
        }

        return redirect()->back()->with('alert-success','تم تحديث بيانات المستخدم بنجاح');
    }



    /*** create user ***/
    public function delete(Request $request)
    {
        $driver = User::findOrFail($request->id)->delete();
        return redirect()->back()->with('alert-success','تم حذف المستخدم بنجاح');
    }


} //end of class
