<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{

    /*** index function  ***/
    public function index($type)
    {
        $departments = Department::where('type',$type)->whereAdminId(Auth::guard('admin')->id());
        $comapnies=Company::select('id','name')->get();
        $departments=$departments->latest()->paginate(10);
        $request_company_id=request('company_id');
        $type=$type;
        return view('pages.Departments.index', compact('departments','comapnies','request_company_id','type'));
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
        $department->type= $request['type'];
        $department->admin_id = auth('admin')->id();
        $department->active = 1;
        $department->save();
        return redirect()->to('departments/'.$request['type'])->with('alert-success','Data is stored successfully');
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
        return redirect()->to('departments/'.$department->type)->with('alert-success','Data is updated successfully');

    }



    /*** destroy function  ***/
    public function destroy(Department $department)
    {
        $department->delete();
        return back()->with('alert-success','Data is deleted successfully');
    }

} //end of class
