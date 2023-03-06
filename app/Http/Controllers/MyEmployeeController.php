<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyEmployeeRequest;
use App\Imports\EmployeeImport;
use App\Models\Department;
use App\Models\EmployeeJob;
use App\Models\MyEmployee;
use App\Models\Office;
use App\Models\Station;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Imports\EmployeesImport;

class MyEmployeeController extends Controller
{

    /*** index function  ***/
    public function index()
    {
        $data['myEmployees']= MyEmployee::whereAdminId(Auth::guard('admin')->id());
        if (request('company_id')) {
            $data['myEmployees']=$data['myEmployees']->where('company_id',request('company_id'));
        }
        $comapnies=Company::select('id','name')->get();
        $data['myEmployees']=$data['myEmployees']->paginate();
        $request_company_id=request('company_id');
        return view('pages.MyEmployees.index', compact('data','comapnies','request_company_id'));
    }



    /*** create function  ***/
    public function create()
    {
        $data['offices'] = Office::select('id','name')->get();
        $data['stations'] = Station::select('id','name')->get();
        $data['employeeJobs'] = EmployeeJob::select('id','name')->get();
        $data['departments'] = Department::where('type','company')->select('id','name')->get();
        $data['companies'] = Company::select('id','name')->get();
        return view('pages.MyEmployees.create', compact('data'));
    }

    
     public function import_file(Request $request)
        {
            if ($request->excel == null) {
                return redirect()->back()->with('alert-danger','plz check file!');
            }elseif ($request->company_id == null) {
                return redirect()->back()->with('alert-danger','plz check company!');
            } 
            $data=[
                'company_id'=>$request->company_id
            ];
            $dataa=new EmployeesImport($data);
            Excel::import($dataa,$request->excel);
            if($dataa->arr_inf_not_add){
                return redirect()->route('myEmployees.index')->with([ 'dataa' => $dataa->arr_inf_not_add ]);
            }
            return redirect()->route('myEmployees.index')->with('alert-info','تم الاضافه بنجاح');
        }


    /*** store function  ***/
    public function store(MyEmployeeRequest $request)
    {
        $myEmployee = new MyEmployee();
        $myEmployee->name = $request->name;
        $myEmployee->oracle_id = $request->oracle_id;
        $myEmployee->office_id = $request->office_id;
        $myEmployee->collectionPoint_id = $request->collectionPoint_id;
        $myEmployee->employeeJob_id = $request->employeeJob_id;
        $myEmployee->department_id = $request->department_id;
        $myEmployee->address = $request->address;
        $myEmployee->gender = $request->gender;
        $myEmployee->phone = $request->phone;
        $myEmployee->email = $request->email;
        $myEmployee->company_id = $request->company_id;
        $myEmployee->password = Hash::make($request->password);
        $myEmployee->admin_id = auth('admin')->id();
        $myEmployee->active = 1;
        $myEmployee->save();

        return redirect()->route('myEmployees.index')->with('alert-success','تم حفظ البيانات بنجاح');
    }



    /*** edit function  ***/
    public function edit(MyEmployee $myEmployee)
    {
        $data['offices'] = Office::select('id','name')->get();
        $data['stations'] = Station::select('id','name')->get();
        $data['employeeJobs'] = EmployeeJob::select('id','name')->get();
        $data['departments'] = Department::where('type','company')->select('id','name')->get();
        $data['companies'] = Company::select('id','name')->get();
        return view('pages.MyEmployees.edit', compact('data','myEmployee'));
    }



    /*** update function  ***/
    public function update(MyEmployeeRequest $request, MyEmployee $myEmployee)
    {


        if ($request->password === $myEmployee->password)
        {
            $myEmployee->name = $request->name;
            $myEmployee->oracle_id = $request->oracle_id;
            $myEmployee->office_id = $request->office_id;
            $myEmployee->collectionPoint_id = $request->collectionPoint_id;
            $myEmployee->employeeJob_id = $request->employeeJob_id;
            $myEmployee->department_id = $request->department_id;
            $myEmployee->address = $request->address;
            $myEmployee->gender = $request->gender;
            $myEmployee->phone = $request->phone;
            $myEmployee->email = $request->email;
            $myEmployee->company_id = $request->company_id;
            $myEmployee->admin_id = auth('admin')->id();
            $myEmployee->active =$request->active;
            $myEmployee->update();
        }
        else {
            $myEmployee->name = $request->name;
            $myEmployee->oracle_id = $request->oracle_id;
            $myEmployee->office_id = $request->office_id;
            $myEmployee->collectionPoint_id = $request->collectionPoint_id;
            $myEmployee->employeeJob_id = $request->employeeJob_id;
            $myEmployee->department_id = $request->department_id;
            $myEmployee->address = $request->address;
            $myEmployee->gender = $request->gender;
            $myEmployee->phone = $request->phone;
            $myEmployee->email = $request->email;
            $myEmployee->company_id = $request->company_id;
            $myEmployee->password = Hash::make($request->password);
            $myEmployee->admin_id = auth('admin')->id();
            $myEmployee->active =$request->active;
            $myEmployee->update();
        }



        return redirect()->route('myEmployees.index')->with('alert-success','تم تحديث البيانات بنجاح');
    }



    /*** destroy function  ***/
    public function destroy(MyEmployee $myEmployee)
    {
        $myEmployee->delete();
        return redirect()->back()->with('alert-info','تم حذف البيانات بنجاح');
    }



    /*** get excel function  ***/
    public function getExcel()
    {
        return view('pages.MyEmployees.excel');
    }



    /*** import excel function  ***/
    public function import(Request $request)
    {
        if ($request->company_id == 0) {
            return redirect()->back()->with('alert-danger','plz choose company!');
        }
            $file = $request->file('excel');
            $data=[
               'company_id'=> $request->company_id
            ];

            // $file=['1','2'];

            DB::table('excel_employees')->truncate();

            Excel::import(new EmployeeImport($data),$file);

        return redirect()->route('store.employees.data')->with('alert-info','تم إضافة البيانات بنجاح');
    }
  
} //end of class


