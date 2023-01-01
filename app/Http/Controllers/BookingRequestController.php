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
        if ($request->has('startDate') && $request->has('endDate') && $request->startTime == null && $request->endTime == null && $request->route_id == null && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->get();
        }
        else if ($request->has('startTime') && $request->has('endTime') && $request->startDate == null && $request->endDate == null && $request->route_id == null && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::whereBetween('time',[$request->startTime,$request->endTime])->get();
        }
        else if ($request->has('route_id') && $request->startTime == null && $request->endTime == null && $request->startDate == null && $request->endDate == null && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::where('route_id',$request->route_id)->get();
        }
        else if ($request->has('collection_point_from_id') && $request->has('collection_point_to_id') && $request->startTime == null && $request->endTime == null && $request->route_id == null && $request->startDate == null && $request->endDate == null)
        {
            $bookingRequests = BookingRequest::where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id)->get();
        }
        else if ($request->has('startDate') && $request->has('endDate') && $request->has('startTime') && $request->has('endTime') && $request->route_id == null && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->whereBetween('time',[$request->startTime,$request->endTime])->get();
        }
        else if ($request->has('startTime') && $request->has('endTime') && $request->startDate == null && $request->endDate == null && $request->route_id == null && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::whereBetween('time',[$request->startTime,$request->endTime])->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id)->get();
        }
        else if ($request->has('startTime')  && $request->has('endTime') && $request->has('route_id') && $request->startDate == null && $request->endDate == null  && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::whereBetween('time',[$request->startTime,$request->endTime])->where('route_id',$request->route_id)->get();
        }
        else if ($request->has('startDate')  && $request->has('endDate') && $request->has('route_id') && $request->startTime == null && $request->endTime == null  && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->where('route_id',$request->route_id)->get();
        }
        else if ($request->has('startDate')  && $request->has('endDate') && $request->route_id == null && $request->startTime == null && $request->endTime == null  && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->where('route_id',$request->route_id)->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id)->get();
        }
        else if ($request->startDate == null  && $request->endDate == null && $request->has('route_id') && $request->startTime == null && $request->endTime == null  && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::where('route_id',$request->route_id)->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id)->get();
        }
        else if ($request->has('startDate') && $request->has('endDate') && $request->has('startTime') && $request->has('endTime') && $request->has('route_id') && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->whereBetween('time',[$request->startTime,$request->endTime])->where('route_id',$request->route_id)->get();
        }
        else if ($request->has('startTime')  && $request->has('endTime') && $request->has('route_id') && $request->startDate == null && $request->endDate == null  && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::whereBetween('time',[$request->startTime,$request->endTime])->where('route_id',$request->route_id)->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id)->get();
        }
        else if ($request->has('startDate') && $request->has('endDate') && $request->has('startTime') && $request->has('endTime') && $request->route_id == null && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->whereBetween('time',[$request->startTime,$request->endTime])->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id)->get();
        }
        else if ($request->has('startDate') && $request->has('endDate') && $request->startTime == null && $request->endTime == null && $request->has('route_id') && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->where('route_id',$request->route_id)->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id)->get();
        }
        else if ($request->has('startDate') && $request->has('endDate') && $request->has('startTime') && $request->has('endTime') && $request->has('route_id') && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->whereBetween('time',[$request->startTime,$request->endTime])->where('route_id',$request->route_id)->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id)->get();
        }
        else{
            $bookingRequests = BookingRequest::all();
        }

        $stations = Station::select('id','name')->get();
        $routes = Route::select('id','name')->get();
        return view('pages.bookingRequests.index', compact('bookingRequests','stations','routes','request'));
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



    /*** store function  ***/
    public function store(Request $request)
    {
        $bookingRequest = new BookingRequest();
        $bookingRequest->collection_point_from_id = $request->collection_point_from_id;
        $bookingRequest->collection_point_to_id = $request->collection_point_to_id;
        $bookingRequest->date = $request->date;
        $bookingRequest->time = $request->time;
        $bookingRequest->route_id = $request->route_id;
        $bookingRequest->admin_id = auth('admin')->id();
        $bookingRequest->active = 1;
        $bookingRequest->save();
        return redirect()->back()->with('alert-success','Data has been created successfully');
    }



    /*** update function  ***/
    public function update(Request $request,BookingRequest $bookingRequest)
    {
        $bookingRequest->collection_point_from_id = $request->collection_point_from_id;
        $bookingRequest->collection_point_to_id = $request->collection_point_to_id;
        $bookingRequest->date = $request->date;
        $bookingRequest->time = $request->time;
        $bookingRequest->route_id = $request->route_id;
        $bookingRequest->admin_id = auth('admin')->id();
//        $bookingRequest->active = $request->active;
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
