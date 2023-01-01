<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRunTripRequest;
use App\Models\BookingRequest;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\EmployeeRunTrip;
use App\Models\Route;
use Illuminate\Http\Request;

class EmployeeRunTripController extends Controller
{

    /*** get all offices ***/
    public function index()
    {
        $employeeRunTrips = EmployeeRunTrip::all();
        $routes = Route::select('id','name')->get();
        $drivers = Driver::select('id','name')->get();
        $buses = Bus::select('id','code')->get();

        return view('pages.EmployeeRunTrips.index', compact('employeeRunTrips','routes','drivers','buses'));
    }



    /*** update the office ***/
    public function update(EmployeeRunTripRequest $request)
    {
//        $employeeRunTrip = EmployeeRunTrip::findOrFail($request->id);
//        return $employeeRunTrip->bus;
        try {
            $employeeRunTrip = EmployeeRunTrip::findOrFail($request->id);
            $employeeRunTrip->route_id = $request->route_id;
            $employeeRunTrip->date = $request->date;
            $employeeRunTrip->time = $request->time;
            $employeeRunTrip->driver_id = $request->driver_id;
            $employeeRunTrip->admin_id = auth('admin')->id();
            $employeeRunTrip->update();

            $employeeRunTrip->bus()->syncWithoutDetaching($request->bus_id);
//            $employeeRunTrip->bus()->syncWithoutDetaching([$request->bus_id,auth('admin')->id()]);
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
        $employeeRunTrip = EmployeeRunTrip::findOrFail($request->id)->delete();
        return redirect()->back()->with('alert-success','Data is deleted successfully');
    }

} //end of class
