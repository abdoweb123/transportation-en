<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripDataRequest;
use App\Models\BusType;
use App\Models\Degree;
use App\Models\TripData;
use Illuminate\Http\Request;

class TripDataController extends Controller
{

    /*** index function  ***/
    public function index()
    {
        $tripData = TripData::latest()->paginate(5);
        $busTypes = BusType::whereHas('seats')->select('id','name')->get();
        $degrees = Degree::select('id','name')->get();
        return view('pages.TripData.index', compact('tripData','busTypes','degrees'));
    }



    /*** store function  ***/
    public function store(TripDataRequest $request)
    {
//return $request->degree_id;

        TripData::create([
            'name'=>$request->name,
            'busType_id'=>$request->busType_id,
            'degree_id'=>$request->degree_id,
            'admin_id'=>auth('admin')->id(),
            'notes'=>$request->notes,
        ]);

        return redirect()->route('tripData.index')->with('alert-success','تم تسجيل البيانات بنجاح');
    }



    /*** update function  ***/
    public function update(TripDataRequest $request)
    {
       $tripData = TripData::findOrFail($request->id);

        $tripData->update([
            'name'=>$request->name,
            'busType_id'=>$request->busType_id,
            'degree_id'=>$request->degree_id,
            'admin_id'=>auth('admin')->id(),
//            'type'=>$request->type,
            'notes'=>$request->notes,
        ]);

        return redirect()->route('tripData.index')->with('alert-success','تم تحديث البيانات بنجاح');
    }



    /*** destroy function  ***/
    public function destroy(Request $request)
    {
        $tripData = TripData::findOrFail($request->id)->delete();
        return redirect()->route('tripData.index')->with('alert-success','تم حذف البيانات بنجاح');
    }


} //end of class
