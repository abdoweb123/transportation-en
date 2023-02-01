<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfficeRequest;
use App\Models\City;
use App\Models\Office;
use App\Models\Station;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeController extends Controller
{

    /*** get all offices ***/
    public function index()
    {
        $offices = Office::whereAdminId(Auth::guard('admin')->id());
        $cities = City::select('id','name')->get();
        $stations = Station::select('id','name')->get();
        $comapnies=Company::select('id','name')->get();
        if (request('company_id')) {
            $offices=$offices->where('company_id',request('company_id'));
        }
        $offices=$offices->paginate();
        $request_company_id=request('company_id');
        return view('pages.Offices.index', compact('offices','cities','stations','comapnies','request_company_id'));
    }
    public function switch_status(Request $request)
    {
        $data=Office::find($request->id);

        if ($data->is_active == 'Y') {
            $data->is_active = 'N';
        }else{
            $data->is_active = 'Y';
        }
        $data->save();
        return response()->json('تم التعديل بنجاح');
    }


    /*** create an office ***/
    public function store(OfficeRequest $request)
    {
        try {
            $office = new Office();
            $office->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $office->city_id = $request->city_id;
            $office->station_id = $request->station_id;
            $office->company_id = $request->company_id;
            $office->admin_id = auth('admin')->id();
            $office->save();
            return redirect()->back()->with('alert-success','Data is saved successfully');
        }
        catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }



    /*** update the office ***/
    public function update(OfficeRequest $request)
    {
        try {
            $office = Office::findOrFail($request->id);
            $office->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $office->city_id = $request->city_id;
            $office->station_id = $request->station_id;
            $office->company_id = $request->company_id;
            $office->admin_id = auth('admin')->id();
            $office->update();
            return redirect()->back()->with('alert-success','Data is updated successfully');
        }
        catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }



    /*** delete the office ***/
    public function destroy(Request $request)
    {
        $office = Office::findOrFail($request->id)->delete();
        return redirect()->back()->with('alert-success','Data is deleted successfully');
    }

} //end of class
