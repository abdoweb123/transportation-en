<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestStation;
use App\Http\Requests\UpdateRequestStation;
use App\Models\City;
use App\Models\Station;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StationImport;
use App\Exports\StationExport;

class StationController extends Controller
{

   /*** index function  ***/
    public function index()
    {
        $stations = Station::whereAdminId(Auth::guard('admin')->id());
        $cities = City::select('id','name')->get();
        $comapnies=Company::select('id','name')->get();
        if (request('company_id')) {
            $stations=$stations->where('company_id',request('company_id'));
        }
        $stations=$stations->paginate();
        $request_company_id=request('company_id');
        return view('pages.Stations.index', compact('stations','cities','comapnies','request_company_id'));
    }
    public function export_excel()
    {
        $stations = Station::whereAdminId(Auth::guard('admin')->id())->get();
        // return Excel::download(new ExpensesExcel($this->results), 'ExpensesExcel.xlsx');
        return Excel::download(new StationExport($stations), 'stations.xlsx');
    }
    

    /*** store function  ***/
    public function store(StoreRequestStation $request)
    {
        try {
            $station = new Station();
            $station->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $station->city_id = $request->city_id;
            $station->lat = $request->lat;
            $station->lon = $request->lon;
            $station->description = $request->description;
            $station->description_en = $request->description_en;
            $station->lon = $request->lon;
            // $station->company_id = $request->company_id;
            $station->admin_id = auth('admin')->id();
            $station->save();
            return redirect()->back()->with('alert-success',trans('main_trans.success'));
        }
        catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    
    
    public function import_file(Request $request)
    {
        if ($request->excel == null) {
            return redirect()->back()->with('alert-danger','plz check file!');
        }
        $data=[
            'company_id'=>$request->company_id
        ];
        $dataa=new StationImport($data);
        Excel::import($dataa,$request->excel);
        if ($dataa->arr_inf_not_add) {
            return redirect()->to('stations')->with(['dataa'=>$dataa->arr_inf_not_add]);
        }
        return redirect()->to('stations')->with('alert-info','تم الاضافه بنجاح');
    }

    public function switch_status(Request $request)
    {
        $data=Station::find($request->id);

        if ($data->is_active == 'Y') {
            $data->is_active = 'N';
        }else{
            $data->is_active = 'Y';
        }
        $data->save();
        return response()->json('تم التعديل بنجاح');
    }

    /*** update function  ***/
    public function update(UpdateRequestStation $request)
    {
        try {
            $station = Station::findOrFail($request->id);
            $station->name = ['name_en' => $request->name_en, 'ar' => $request->name_ar];
            $station->city_id = $request->city_id; 
            $station->lat = $request->lat;
            $station->lon = $request->lon;
            // $station->company_id = $request->company_id;
            $station->admin_id = auth('admin')->id();
            $station->description = $request->description;
            $station->description_en = $request->description_en;
            $station->update();
            return redirect()->back()->with('alert-success',trans('main_trans.success'));
        }
        catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }



    /*** destroy function  ***/
    public function destroy(Request $request)
    {
        $station = Station::findOrFail($request->id)->delete();
        return redirect()->back()->with('alert-success',trans('main_trans.danger'));
    }


} //end of class
