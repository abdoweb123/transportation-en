<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestStation;
use App\Http\Requests\UpdateRequestStation;
use App\Models\City;
use App\Models\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{

   /*** index function  ***/
    public function index()
    {
        $stations = Station::all();
        $cities = City::select('id','name')->get();
        return view('pages.Stations.index', compact('stations','cities'));
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
            $station->admin_id = auth('admin')->id();
            $station->save();
            return redirect()->back()->with('alert-success',trans('main_trans.success'));
        }
        catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }



    /*** update function  ***/
    public function update(UpdateRequestStation $request)
    {
        try {
            $station = Station::findOrFail($request->id);
            $station->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $station->city_id = $request->city_id;
            $station->lat = $request->lat;
            $station->lon = $request->lon;
            $station->admin_id = auth('admin')->id();
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
