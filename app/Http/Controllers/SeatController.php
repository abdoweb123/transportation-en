<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeatRequest;
use App\Models\Bus;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{

    /*** index function  ***/
    public function index()
    {
        $seats = Seat::all();
        return view('pages.Seats.index', compact('seats'));
    }



    /*** create function  ***/
    public function create()
    {
       $buses = Bus::whereDoesntHave('seats')->get();
        return view('pages.Seats.create', compact('buses'));
    }



    /*** store function  ***/
    public function store(StoreSeatRequest $request)
    {
          $bus = Bus::findOrFail($request->bus_id);
          $bus->width = $request->width;
          $bus->length = $request->length;
          $bus->slug = $request->slug;
          $bus->update();


        $inputs = $request->input('type');
        foreach ($inputs as $id => $value)
        {
            if ($value == null)
                $value = 'acceptable';

                Seat::create([
                   'name'=>$id,
                   'bus_id'=>$request->bus_id,
                   'type'=>$value,
                ]);
        }
         return redirect()->back()->with('alert-success', 'تم حفظ البيانات بنجاح');
    }



    /*** show function  ***/
    public function showBusSeats($id)
    {
        $bus = Bus::findOrFail($id);
        $seats = Seat::where('bus_id',$id)->get();
        return view('pages.Seats.show_bus_seats',compact('bus','seats'));
    }






    /*** update function  ***/
    public function update(Request $request)
    {
        $inputs = $request->input('type');
        foreach ($inputs as $name =>$value)
        {
            $seat = Seat::where('name',$name)->first();
            $seat->update([
                'type'=>$value,
           ]);
        }
        return redirect()->back()->with('alert-success', 'تم تعديل البيانات بنجاح');
    }



    /*** destroy function  ***/
    public function destroy(Seat $seat)
    {
        //
    }



    public function testpage()
    {
        $seats = Seat::latest()->paginate(10);
        return view('pages.Seats.choose', compact('seats'));
    }


    public function test(Request $request)
    {

        if (is_array($request->seats))
        {
            if ($seats = Seat::whereIn('id', $request->seats)){
                $seats->update(['type'=>'unacceptable']);
            }
            if ($seats = Seat::whereNotIn('id', $request->seats))
            {
                $seats->update(['type'=>'acceptable']);
            }
            return redirect()->back()->with('alert-info','تم تعديل البيانات بنجاح');
        }
        else{
            return redirect()->back()->with('alert-danger','حدث خطأ ما أثناء عملية الحذف');
        }


//
    }



} //end of class
