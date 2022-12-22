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
        $cities = City::all();
        return view('pages.Cities.index', compact('cities'));
    }



    /*** store function  ***/
    public function store(StoreRequestCity $request)
    {
        try {
            $city = new City();
            $city->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $city->admin_id = auth('admin')->id();
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
