<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestBus;
use App\Models\Bus;
use App\Models\BusType;
use App\Models\EmployeeRunTrip;
use App\Models\EmployeeRunTripBus;
use App\Models\MyEmployee;
use App\Models\RunTrip;
use App\Models\Seat;
use App\Models\Route;
use App\Models\Station;
use App\Models\StaticTable;
use App\Models\BookingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmptySeatsPerCarExcel;
use App\Exports\BusdetailsbookingrequestExcel;
use App\Exports\BookingRequestExcel;

class BusController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $buses = Bus::whereAdminId(Auth::guard('admin')->id())->latest()->paginate(10);
        $busTypes = BusType::select('id','name')->get();
        $gas_types = StaticTable::select('id','name')->whereType('gas_type')->get();
        return view('pages.Buses.index',compact('buses','busTypes','gas_types'));
    }



    /*** store function ***/
    public function store(RequestBus $request)
    {
        Bus::create([
            'code'=>$request->code,
            'admin_id'=>auth('admin')->id(),
            'busType_id'=>$request->busType_id,
            'gas_type_id'=>$request->gas_type_id,
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
            'gas_type_id'=>$request->gas_type_id,
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



    /*** Empty Seats Per Bus  ***/
    public function emptySeatsPerBus(Request $request)
    {
        $buses_data = DB::table('buses')->join('bus_types','buses.busType_id','bus_types.id')
        ->join('employee_run_trip_buses','employee_run_trip_buses.bus_id','buses.id')
        ->join('employee_run_trips','employee_run_trip_buses.employeeRunTrip_id','employee_run_trips.id') 
        ->join('routes','employee_run_trips.route_id','routes.id')
        ->select('buses.id','buses.code','bus_types.slug','employee_run_trips.total as booked_seats',
            'routes.name as route_name','employee_run_trips.date','employee_run_trips.time','employee_run_trips.id as employee_run_trip_id');
            
        if ($request->has('startDate') || $request->has('endDate')) {
            $buses_data=$buses_data->whereBetween('employee_run_trips.date',[$request->startDate,$request->endDate]);
        }

        if ($request->has('route_id')) {
            $buses_data=$buses_data->where('employee_run_trips.route_id',$request->route_id);
        }

        $buses= $buses_data->paginate(100);

        $routes=Route::select('id','name')->get();
         return view('pages.Reports.emptySeatsPerCar',compact('buses','routes','request'));
    }
    public function excelemptySeatsPerBus()
    {
        $buses_data = DB::table('buses')->join('bus_types','buses.busType_id','bus_types.id')
        ->join('employee_run_trip_buses','employee_run_trip_buses.bus_id','buses.id')
        ->join('employee_run_trips','employee_run_trip_buses.employeeRunTrip_id','employee_run_trips.id')
        ->join('routes','employee_run_trips.route_id','routes.id')
        ->select('buses.id','buses.code','bus_types.slug','employee_run_trips.total as booked_seats',
            'routes.name as route_name','employee_run_trips.date','employee_run_trips.time');
        if (request('startDate') != null || request('endDate') != null) {
            $buses_data=$buses_data->whereBetween('employee_run_trips.date',[request('startDate'),request('endDate')]);
        }
        if ( request('route_id') != null) {
            $buses_data=$buses_data->where('employee_run_trips.route_id',request('route_id'));
        }
        $buses= $buses_data->get();

        return Excel::download(new EmptySeatsPerCarExcel($buses), 'EmptySeatsPerCarExcel.xlsx');
    }


    public function BusdetailsbookingrequestExcel()
    {
        $results = BookingRequest::with('myEmployee')->where(['bus_id'=>request('bus_id'),'employeeRunTrip_id'=>request('employeeRunTrip_id')])->get();
        return Excel::download(new BusdetailsbookingrequestExcel($results), 'BusdetailsbookingrequestExcel.xlsx');
    }

    public function busdetailsbookingrequest(Request $request)
    {
        $results = BookingRequest::with('myEmployee')->where(['bus_id'=>$request->bus_id,'employeeRunTrip_id'=>$request->employee_run_trip_id])->paginate(100);
        $employee_run_trip_id=$request->employee_run_trip_id;
        $bus_id=$request->bus_id;
        $employee_run_trip=EmployeeRunTrip::with('company','route')->find($employee_run_trip_id);
         return view('pages.Reports.busdetailsbookingrequest',compact('results','employee_run_trip','employee_run_trip_id','bus_id'));
    }

    public function bookingrequest_report(Request $request)
    {
        $bookingRequests = null;

        if ($request->has('startDate') && $request->has('endDate') && $request->startTime == null && $request->endTime == null && $request->route_id == null && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate]);
        }
        else if ($request->has('startTime') && $request->has('endTime') && $request->startDate == null && $request->endDate == null && $request->route_id == null && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::whereBetween('time',[$request->startTime,$request->endTime]);
        }
        else if ($request->has('route_id') && $request->startTime == null && $request->endTime == null && $request->startDate == null && $request->endDate == null && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::where('route_id',$request->route_id);
        }
        else if ($request->has('collection_point_from_id') && $request->has('collection_point_to_id') && $request->startTime == null && $request->endTime == null && $request->route_id == null && $request->startDate == null && $request->endDate == null)
        {
            $bookingRequests = BookingRequest::where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id);
        }
        else if ($request->has('startDate') && $request->has('endDate') && $request->has('startTime') && $request->has('endTime') && $request->route_id == null && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->whereBetween('time',[$request->startTime,$request->endTime]);
        }
        else if ($request->has('startTime') && $request->has('endTime') && $request->startDate == null && $request->endDate == null && $request->route_id == null && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::whereBetween('time',[$request->startTime,$request->endTime])->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id);
        }
        else if ($request->has('startTime')  && $request->has('endTime') && $request->has('route_id') && $request->startDate == null && $request->endDate == null  && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::whereBetween('time',[$request->startTime,$request->endTime])->where('route_id',$request->route_id);
        }
        else if ($request->has('startDate')  && $request->has('endDate') && $request->has('route_id') && $request->startTime == null && $request->endTime == null  && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->where('route_id',$request->route_id);
        }
        else if ($request->has('startDate')  && $request->has('endDate') && $request->route_id == null && $request->startTime == null && $request->endTime == null  && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->where('route_id',$request->route_id)->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id);
        }
        else if ($request->startDate == null  && $request->endDate == null && $request->has('route_id') && $request->startTime == null && $request->endTime == null  && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::where('route_id',$request->route_id)->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id);
        }
        else if ($request->has('startDate') && $request->has('endDate') && $request->has('startTime') && $request->has('endTime') && $request->has('route_id') && $request->collection_point_from_id == null && $request->collection_point_to_id == null)
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->whereBetween('time',[$request->startTime,$request->endTime])->where('route_id',$request->route_id);
        }
        else if ($request->has('startTime')  && $request->has('endTime') && $request->has('route_id') && $request->startDate == null && $request->endDate == null  && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::whereBetween('time',[$request->startTime,$request->endTime])->where('route_id',$request->route_id)->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id);
        }
        else if ($request->has('startDate') && $request->has('endDate') && $request->has('startTime') && $request->has('endTime') && $request->route_id == null && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->whereBetween('time',[$request->startTime,$request->endTime])->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id);
        }
        else if ($request->has('startDate') && $request->has('endDate') && $request->startTime == null && $request->endTime == null && $request->has('route_id') && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->where('route_id',$request->route_id)->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id);
        }
        else if ($request->has('startDate') && $request->has('endDate') && $request->has('startTime') && $request->has('endTime') && $request->has('route_id') && $request->has('collection_point_from_id') && $request->has('collection_point_to_id'))
        {
            $bookingRequests = BookingRequest::whereBetween('date',[$request->startDate,$request->endDate])->whereBetween('time',[$request->startTime,$request->endTime])->where('route_id',$request->route_id)->where('collection_point_from_id',$request->collection_point_from_id)->where('collection_point_to_id',$request->collection_point_to_id);
        }
        // else{
        //     $bookingRequests = BookingRequest::paginate();
        // }
        if ($bookingRequests != null) {
            $bookingRequests =$bookingRequests->paginate(50);
        }else{
            $bookingRequests = BookingRequest::paginate(50);
        }

        $stations = Station::select('id','name')->get();
        $routes = Route::select('id','name')->get();
        return view('pages.Reports.BookingRequestReport', compact('bookingRequests','stations','routes','request'));
    }

    public function bookingrequest_report_excel(Request $request)
    {
        $bookingRequests = BookingRequest::get();
        if ($request->startDate != null && $request->endDate != null) {
            $bookingRequests =$bookingRequests->whereBetween('date',[$request->startDate,$request->endDate]);
        }
        if ($request->startTime != null && $request->endTime != null) {
            $bookingRequests =$bookingRequests->whereBetween('time',[$request->startTime,$request->endTime]);
        }
        if ($request->route_id != null) {
            $bookingRequests =$bookingRequests->where('route_id',$request->route_id);
        }
        if ($request->collection_point_to_id != null) {
            $bookingRequests =$bookingRequests->where('collection_point_to_id',$request->collection_point_to_id);
        }
        if ($request->collection_point_from_id != null) {
            $bookingRequests =$bookingRequests->where('collection_point_from_id',$request->collection_point_from_id);
        }
        
        return Excel::download(new BookingRequestExcel($bookingRequests), 'BookingRequestExcel.xlsx');
    }
    /*** Employees Names Per Bus  ***/
    public function getRunTripByBus_id(Request $request)
    {
        // search for Trip Data By Bus_id
        if ($request->has('searchTripDataByBus_id'))
        {
            $runTrips = DB::table('employee_run_trip_buses')
                ->join('employee_run_trips','employee_run_trip_buses.employeeRunTrip_id','employee_run_trips.id')
                ->join('routes','employee_run_trips.route_id','routes.id')
                ->where('employee_run_trip_buses.bus_id',$request->searchTripDataByBus_id)
                ->select('employee_run_trips.id','employee_run_trips.date','employee_run_trips.time','routes.name as route_name')->get();

            $searchedBus = Bus::find($request->searchTripDataByBus_id);
            $buses = Bus::select('id','code')->get();
            return view('pages.Reports.employeesNamesPerBus',compact('buses','runTrips','searchedBus'));
        }


        // search for employees of bus by trip
        if ($request->has('searchedBus') && $request->has('runTrip'))
        {
            $employeesOfTrip = DB::table('employee_run_trip_buses')
                ->join('employee_run_trips','employee_run_trips.id','employee_run_trip_buses.employeeRunTrip_id')
                ->join('buses','employee_run_trip_buses.bus_id','buses.id')
                ->join('booking_requests','buses.id','booking_requests.bus_id')
                ->join('my_employees','my_employees.id','booking_requests.employee_id')
                ->where('buses.id',$request->searchedBus)
                ->where('employee_run_trip_buses.employeeRunTrip_id',$request->runTrip)
                ->where('booking_requests.date',$request->date)
                ->where('booking_requests.time',$request->time)
                ->select('my_employees.name','my_employees.oracle_id','my_employees.phone',
                  'my_employees.address','my_employees.gender')->distinct()->get();

            $buses = Bus::select('id','code')->get();
            return view('pages.Reports.employeesNamesPerBus',compact('employeesOfTrip','buses'));
        }


        $buses = Bus::select('id','code')->get();
        return view('pages.Reports.employeesNamesPerBus',compact('buses'));
    }



    /*** Empty Seats Per Route  ***/
    public function emptySeatsPerRoute()
    {
     return   $routes = DB::table('buses')->join('bus_types','buses.busType_id','bus_types.id')
          ->join('employee_run_trip_buses','employee_run_trip_buses.bus_id','buses.id')
          ->join('employee_run_trips','employee_run_trip_buses.employeeRunTrip_id','employee_run_trips.id')
          ->join('routes','employee_run_trips.route_id','routes.id')
          ->select('buses.id','buses.code','bus_types.slug','employee_run_trips.total as booked_seats',
              'routes.name as route_name','employee_run_trips.date','employee_run_trips.time')->paginate(50);


        return view('pages.Reports.emptySeatsPerRoute',compact('routes'));
    }



//    public function employeesNamesPerBus(Request $request)
//    {
//         $buses = Bus::select('id','code')->get();
//
////         $employees = MyEmployee::paginate(50);
//         return view('pages.Reports.employeesNamesPerBus',compact('buses'));
//    }

} //end of class
