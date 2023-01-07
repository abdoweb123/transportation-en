<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use App\Models\Bus;
use App\Models\BusType;
use App\Models\City;
use App\Models\EmployeeRunTrip;
use App\Models\MyEmployee;
use App\Models\Route;
use App\Models\RouteStation;
use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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



    /*** get add booking function  ***/
    public function getAddBooking()
    {
        $routes = Route::select('id','name')->get();
        $buses = Bus::select('id','code')->get();
        return view('pages.bookingRequests.addBooking',compact('routes','buses'));
    }



    /*** searchEmployeeRunTrip  ***/
    public function searchEmployeeRunTrip(Request $request)
    {
        $routes = Route::select('id','name')->get();
        $buses = Bus::select('id','code')->get();

        if ($request->has('route_id') && $request->has('bus_id') && $request->has('date') && $request->has('time') && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $newBookings = DB::table('employee_run_trips')
                ->join('employee_run_trip_buses','employee_run_trip_buses.employeeRunTrip_id','employee_run_trips.id')
                ->join('routes','employee_run_trips.route_id','routes.id')
                ->join('buses','employee_run_trip_buses.bus_id','buses.id')
                ->where('employee_run_trips.route_id',$request->route_id)
                ->where('employee_run_trips.date',$request->date)
                ->where('employee_run_trip_buses.bus_id',$request->bus_id)
                ->where('employee_run_trips.time',$request->time)->latest()->select('employee_run_trips.*','buses.code as bus_code','routes.name as route_name')->paginate(100);

            return view('pages.bookingRequests.addBooking',compact('newBookings','request','request','routes','buses'));
        }

        return redirect()->back();
    }



    /*** create New Booking function  ***/
    public function createNewBooking(Request $request)
    {

        $myEmployee = MyEmployee::where('oracle_id',$request->oracle_id)->first();
        if ($myEmployee)
        {

            $bookingRequest = new BookingRequest();
            $bookingRequest->collection_point_from_id = $request->collection_point_from_id;
            $bookingRequest->collection_point_to_id = $request->collection_point_to_id;
            $bookingRequest->date = $request->date;
            $bookingRequest->time = $request->time;
            $bookingRequest->route_id = $request->route_id;
            $bookingRequest->employee_id = $myEmployee->id;
            $bookingRequest->employeeRunTrip_id = $request->newEmployeeRunTrip_id;
            $bookingRequest->bus_id = $request->bus_id;
            if ($request->type == 1)
            {
                $bookingRequest->address = $myEmployee->address;
            }
            $bookingRequest->admin_id = auth('admin')->id();
            $bookingRequest->active = 1;
            $bookingRequest->save();

            $new_employeeRunTrip = EmployeeRunTrip::find($request->newEmployeeRunTrip_id);
            $new_employeeRunTrip->total += 1;
            $new_employeeRunTrip->update();

            return redirect()->back()->with('alert-success','Data has been created successfully');
        }
        return redirect()->back()->with('alert-danger','This oracle_id does not exist');

    }



    /*** getAssignEmployee ***/
    public function getAssignEmployee(Request $request)
    {
        if ($request->has('oracle_id') && $request->has('date'))
        {
            $employee = MyEmployee::where('oracle_id',$request->oracle_id)->first();
            $employeeBookings = BookingRequest::where('date',$request->date)->where('employee_id',$employee->id)->latest()->paginate(100);

            return view('pages.bookingRequests.assignEmployee',compact('employeeBookings','request','employee'));
        }

        return view('pages.bookingRequests.assignEmployee');
    }



    /*** swapBus ***/
    public function swapBus(Request $request,$booking_id,$employee_id)
    {
        $booking = BookingRequest::where('id',$booking_id)->first();
        $employeeRunTrip = EmployeeRunTrip::where('id',$booking->employeeRunTrip_id)->first();
        $bus = Bus::where('id',$booking->bus_id)->first();
        $busType = BusType::where('id',$bus->busType_id)->first();
        $routes = Route::select('id','name')->get();
        $buses = Bus::select('id','code')->get();

        if ($request->has('route_id') && $request->has('bus_id') && $request->has('date') && $request->has('time') && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $newBookings = DB::table('employee_run_trips')
                ->join('employee_run_trip_buses','employee_run_trip_buses.employeeRunTrip_id','employee_run_trips.id')
                ->join('routes','employee_run_trips.route_id','routes.id')
                ->join('buses','employee_run_trip_buses.bus_id','buses.id')
                ->where('employee_run_trips.route_id',$request->route_id)
                ->where('employee_run_trips.date',$request->date)
                ->where('employee_run_trip_buses.bus_id',$request->bus_id)
                ->where('employee_run_trips.time',$request->time)->latest()->select('employee_run_trips.*','buses.code as bus_code','routes.name as route_name')->paginate(100);

            return view('pages.bookingRequests.swap',compact('booking','busType','employeeRunTrip','bus','routes','buses','newBookings','request','employee_id'));
        }

        return view('pages.bookingRequests.swap',compact('booking','busType','employeeRunTrip','bus','routes','buses','employee_id'));
    }



    /*** getRouteStations by ajax ***/
    public function getRouteStations($id)
    {
        return  DB::table('route_stations')->join('stations','route_stations.station_id','stations.id')
            ->where("route_stations.route_id", $id)->pluck('route_stations.station_name','stations.id');
    }


    public function swapBusFinal(Request $request)
    {
//        return $request;
       $old_booking_request = BookingRequest::find($request->oldBooking_id);
       $myEmployee = MyEmployee::find($request->employee_id);

       $new_booking_request = new BookingRequest();
       $new_booking_request->collection_point_from_id = $request->collection_point_from_id;
       $new_booking_request->collection_point_to_id = $request->collection_point_to_id;
       $new_booking_request->route_id = $request->route_id;
       $new_booking_request->date = $request->date;
       $new_booking_request->time = $request->time;
       $new_booking_request->employeeRunTrip_id = $request->newEmployeeRunTrip_id;
       $new_booking_request->bus_id = $request->bus_id;
       $new_booking_request->employee_id = $request->employee_id;
       $new_booking_request->shift = $old_booking_request->shift;
       if ($request->type == 1)
       {
           $new_booking_request->address = $myEmployee->address;
       }
       $new_booking_request->admin_id = auth('admin')->id();
       $new_booking_request->active = 1;
       $new_booking_request->save();


        $new_employeeRunTrip = EmployeeRunTrip::find($request->newEmployeeRunTrip_id);
        $new_employeeRunTrip->total += 1;
        $new_employeeRunTrip->update();


        $old_employeeRunTrip = EmployeeRunTrip::find($request->oldEmployeeRunTrip_id);
        $old_employeeRunTrip->total -= 1;
        $old_employeeRunTrip->update();

        $old_booking_request->forceDelete();

        return redirect()->route('bookingRequests.index')->with('alert-info','Data has been saved successfully');
    }


} //end of class
