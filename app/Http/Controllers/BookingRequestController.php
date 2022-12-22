<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use App\Models\City;
use App\Models\EmployeeRunTrip;
use App\Models\MyEmployee;
use App\Models\Route;
use App\Models\RouteStation;
use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingRequestController extends Controller
{

    /*** index function  ***/
    public function index(Request $request)
    {


        $bookingRequests = BookingRequest::all();
//        $bookingRequests = [];
        $stations = Station::select('id','name')->get();
        $routes = Route::select('id','name')->get();
        return view('pages.bookingRequests.index', compact('bookingRequests','stations','routes'));
    }



    /*** bookingRequestsData function  ***/
    public function bookingRequestsData()
    {
        $data['stations'] = Station::where('lat',null)->where('lon',null)->get();
        $data['routes'] = Route::whereDate('created_at',Carbon::today())->get();
        $data['routeStations'] = RouteStation::whereDate('created_at',Carbon::today())->get();
        $data['employees'] = MyEmployee::whereDate('created_at',Carbon::today())->get();
        $cities = City::select('id','name')->get();
        $routes = Route::select('id','name')->get();
        $stations = Station::select('id','name')->get();

        return view('pages.bookingRequests.bookingRequestsData',compact('data','cities','routes','stations'));
    }



    /*** bookingRequestsData function  ***/
    public function employeeRunTrip()
    {
        $employeeRunTrip = EmployeeRunTrip::whereDate('created_at',Carbon::today())->with('bus')->get();
        return view('pages.bookingRequests.employeeRunTrip',compact('employeeRunTrip'));
    }




    /*** update function  ***/
    public function update(Request $request,BookingRequest $bookingRequest)
    {
        $bookingRequest->collection_point_from_id = $request->collection_point_from_id;
        $bookingRequest->collection_point_to_id = $request->collection_point_to_id;
        $bookingRequest->date = $request->date;
        $bookingRequest->time = $request->time;
        $bookingRequest->update();
        return redirect()->back()->with('alert-success','Data has been updated successfully');
    }



    /*** destroy function  ***/
    public function destroy(BookingRequest $bookingRequest)
    {
        $bookingRequest->delete();
        return redirect()->back()->with('alert-info','Data has been deleted successfully');
    }

} //end of class
