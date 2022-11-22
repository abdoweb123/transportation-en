<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripStationRequest;
use App\Models\Station;
use App\Models\TripData;
use App\Models\TripStation;
use Illuminate\Http\Request;

class TripStationController extends Controller
{

    /*** getStationsOfTrip function  ***/
    public function getStationsOfTrip($id)
    {
        $tripStations = TripStation::where('tripData_id',$id)->orderBy('rank')->paginate(10);
//        $tripStations = TripStation::all();
//        return $tripStations;
        $tripData = TripData::find($id);
        $stations = Station::select('id','name')->get();
        return view('pages.TripData.TripStations.index', compact('tripData','tripStations','stations'));
    }



    /*** store function  ***/
    public function store(TripStationRequest $request)
    {
        TripStation::create([
            'station_id'=>$request->station_id,
            'tripData_id'=>$request->tripData_id,
            'admin_id'=>auth('admin')->id(),
            'type'=>$request->type,
            'typeInMinutes'=>$request->typeInMinutes,
            'rank'=>$request->rank,
            'printTimes'=>$request->printTimes,
        ]);

        return redirect()->back()->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** update function  ***/
    public function update(TripStationRequest $request)
    {
        $tripStation = TripStation::findOrFail($request->id);

        $tripStation->update([
            'station_id'=>$request->station_id,
            'tripData_id'=>$request->tripData_id,
            'admin_id'=>auth('admin')->id(),
            'type'=>$request->type,
            'typeInMinutes'=>$request->typeInMinutes,
            'rank'=>$request->rank,
            'printTimes'=>$request->printTimes,
        ]);

        return redirect()->back()->with('alert-success','تم تحديث البيانات بنجاح');
    }



    /*** destroy function  ***/
    public function destroy(Request $request)
    {
        $tripStation = TripStation::findOrFail($request->id)->delete();
        return redirect()->route('tripStations.index')->with('alert-success','تم حذف البيانات بنجاح');
    }


} //end of class
