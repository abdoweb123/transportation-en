<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{

    /*** index function  ***/
    public function index()
    {
        $departments = Department::whereAdminId(Auth::guard('admin')->id())->latest()->paginate(10);
        $comapnies=Company::select('id','name')->get();
        return view('pages.Departments.index', compact('departments','comapnies'));
    }



    /*** store function  ***/
    public function store(Request $request)
    {
        $rules = [
            'name'=>'required',
        ];
        $messages = [
            'name.required'=>'اسم الوظيفة مطلوب',
        ];

        $this->validate($request,$rules,$messages);

        $department = new Department();
        $department->name = $request['name'];
        $department->company_id= $request['company_id'];
        $department->admin_id = auth('admin')->id();
        $department->active = 1;
        $department->save();
        return redirect()->route('departments.index')->with('alert-success','Data is stored successfully');
    }



    /*** update function  ***/
    public function update(Request $request, Department $department)
    {
        $rules = [
            'name'=>'required',
        ];
        $messages = [
            'name.required'=>'اسم الوظيفة مطلوب',
        ];

        $this->validate($request,$rules,$messages);

        $department->name = $request['name'];
        $department->admin_id = auth('admin')->id();
        $department->company_id= $request['company_id'];

        $department->active = $request['active'];
        $department->update();
        return redirect()->route('departments.index')->with('alert-success','Data is updated successfully');

    }



    /*** destroy function  ***/
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('alert-success','Data is deleted successfully');
    }

} //end of class
