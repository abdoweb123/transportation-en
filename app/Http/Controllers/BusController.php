<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestBus;
use App\Models\Bus;
use App\Models\BusType;
use App\Models\Seat;
use Illuminate\Http\Request;

class BusController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $buses = Bus::latest()->paginate(10);
        $busTypes = BusType::all();
        return view('pages.Buses.index',compact('buses','busTypes'));
    }



    /*** store function ***/
    public function store(RequestBus $request)
    {
        Bus::create([
            'code'=>$request->code,
            'admin_id'=>auth('admin')->id(),
            'busType_id'=>$request->busType_id,
        ]);
        return redirect()->route('buses.index')->with('alert-success','تم حفظ البيانات بنجاح');
    }



    /*** update function ***/
    public function update(RequestBus $request, Bus $bus)
    {
        $bus->update([
            'code'=>$request->code,
            'admin_id'=>auth('admin')->id(),
            'busType_id'=>$request->busType_id,
        ]);
        return redirect()->route('buses.index')->with('alert-info','تم تعديل البيانات بنجاح');
    }



    /*** showBusSeats function  ***/
    public function showBusSeats($id)
    {
        $busType_id = Bus::findOrFail($id)->busType->id;
        $busType = Bus::findOrFail($id)->busType;
        $seats = Seat::where('busType_id',$busType_id)->get();
        return view('pages.Buses.show_bus_seats',compact('seats','busType'));
    }


    /*** destroy function ***/
    public function destroy(Bus $bus)
    {

        $seat_id = Seat::where('bus_id',$bus->id)->pluck('bus_id');

        if($seat_id->count() == 0)
        {
            $bus = Bus::findOrFail($bus->id)->delete();
            return redirect()->route('buses.index')->with('alert-danger','تم حذف البيانات بنجاح');
        }
        else{
            return redirect()->route('cities.index')->with('alert-danger','حدث خطأ ما أثناء عملية الحذف');
        }

    }

} //end of class
