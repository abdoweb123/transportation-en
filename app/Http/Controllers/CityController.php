<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestCity;
use App\Http\Requests\UpdateRequestCity;
use App\Models\City;
use App\Models\Company;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CitiesImport;
class CityController extends Controller
{

    /*** index function  ***/
    public function index()
    {
        $cities = City::whereAdminId(Auth::guard('admin')->id());
        $comapnies=Company::select('id','name')->get();
        if (request('company_id')) {
            $cities=$cities->where('company_id',request('company_id'));
        }
        $cities=$cities->paginate();
        $request_company_id=request('company_id');
        return view('pages.Cities.index', compact('cities','comapnies','request_company_id'));
    }
    public function switch_status(Request $request)
    {
        $data=City::find($request->id);

        if ($data->is_active == 'Y') {
            $data->is_active = 'N';
        }else{
            $data->is_active = 'Y';
        }
        $data->save();
        return response()->json('تم التعديل بنجاح');
    }

    public function import_cities(Request $request)
    {
        if ($request->excel == null) {
            return redirect()->back()->with('alert-danger','plz check file!');
        }
        $data=[
            'company_id'=>$request->company_id
        ];
        $dataa=new CitiesImport($data);
        Excel::import($dataa,$request->excel);

        return redirect()->route('cities.index')->with('alert-info','تم الاضافه بنجاح');
    }


    /*** store function  ***/
    public function store(StoreRequestCity $request)
    {
        try {
            $city = new City();
            $city->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $city->admin_id = auth('admin')->id();
            $city->company_id=$request->company_id;
            $city->save();
            return redirect()->back()->with('alert-success',trans('main_trans.success'));
        }
        catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }



    /*** update function  ***/
    public function update(UpdateRequestCity $request)
    {
        try {
            $city = City::findOrFail($request->id);
            $city->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $city->admin_id = auth('admin')->id();
            $city->company_id=$request->company_id;
            $city->update();
            return redirect()->back()->with('alert-info',trans('main_trans.info'));
        }
        catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }

    }



    /*** destroy function  ***/
    public function destroy(Request $request)
    {
        $city = City::findOrFail($request->id)->delete();
        return redirect()->back()->with('alert-success',trans('main_trans.danger'));
    }

} //end of class
