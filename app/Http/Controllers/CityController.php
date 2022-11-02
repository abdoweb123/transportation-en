<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestCity;
use App\Http\Requests\UpdateRequestCity;
use App\Models\City;
use App\Models\Station;
use Illuminate\Http\Request;

class CityController extends Controller
{

    /*** index function  ***/
    public function index()
    {
        $cities = City::latest()->paginate(5);
        return view('pages.Cities.index', compact('cities'));
    }



    /*** store function  ***/
    public function store(StoreRequestCity $request)
    {
        try {
            $city = new City();
            $city->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $city->save();
            return redirect()->route('cities.index')->with('alert-success',trans('main_trans.success'));
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
            $city->update();
            return redirect()->route('cities.index')->with('alert-info',trans('main_trans.info'));
        }
        catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }

    }



    /*** destroy function  ***/
    public function destroy(Request $request)
    {
        $city_id = Station::where('city_id',$request->id)->pluck('city_id');

        if($city_id->count() == 0)
        {
            $city = City::findOrFail($request->id)->delete();
            return redirect()->route('cities.index')->with('alert-success',trans('main_trans.danger'));
        }
        else{
            return redirect()->route('cities.index')->with('alert-danger',trans('main_trans.delete_error'));
        }
    }

} //end of class
