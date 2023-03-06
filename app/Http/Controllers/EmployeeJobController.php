<?php

namespace App\Http\Controllers;

use App\Models\EmployeeJob;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EmployeeJobController extends Controller
{

    /*** index function  ***/
    public function index($type)
    {
        $employeeJobs = EmployeeJob::whereType($type)->whereAdminId(Auth::guard('admin')->id());
        $comapnies=Company::select('id','name')->get();
        $employeeJobs=$employeeJobs->latest()->paginate(10);
        $request_company_id=request('company_id');
        $type=$type;
        return view('pages.EmployeeJobs.index', compact('employeeJobs','comapnies','request_company_id','type'));
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

        $employeeJob = new EmployeeJob();
        $employeeJob->name = $request['name'];
        $employeeJob->company_id = $request['company_id'];
        $employeeJob->type = $request['type'];
        $employeeJob->admin_id = auth('admin')->id();
        $employeeJob->active = 1;
        $employeeJob->save();
        return redirect()->to('employeeJobs/'.$request['type'])->with('alert-success','Data is stored successfully');
    }



    /*** update function  ***/
    public function update(Request $request, EmployeeJob $employeeJob)
    {
        $rules = [
            'name'=>'required',
        ];
        $messages = [
            'name.required'=>'اسم الوظيفة مطلوب',
        ];

        $this->validate($request,$rules,$messages);

        $employeeJob->name = $request['name'];
        $employeeJob->company_id = $request['company_id'];
        $employeeJob->admin_id = auth('admin')->id();
        $employeeJob->active = $request['active'];
        $employeeJob->update();
        return redirect()->to('employeeJobs/'.$employeeJob->type)->with('alert-success','Data is updated successfully');

    }



    /*** destroy function  ***/
    public function destroy(EmployeeJob $employeeJob)
    {
        $employeeJob->delete();
        return back()->with('alert-success','Data is deleted successfully');
    }

} //end of class
