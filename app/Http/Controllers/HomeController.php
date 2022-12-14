<?php

namespace App\Http\Controllers;

use App\Imports\EmployeeExcel;
use App\Imports\EmployeeImport;
use App\Models\ExcelEmployee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }


    public function index()
    {
        return view('dashboard');
    }


    public function import(Request $request)
    {
//        return $request;
        $file = $request->file('excel');

        $dataa=new EmployeeExcel;
        Excel::import($dataa, $file);

//        Excel::queueImport(new EmployeeExcel(), $file);

        return 'success';
    }





//    public function import(Request $request)
//    {
//        $file = $request->file('excel');
//
//        Excel::queueImport(new EmployeeImport(), $file);
//
//        return 'success';
//    }

}
