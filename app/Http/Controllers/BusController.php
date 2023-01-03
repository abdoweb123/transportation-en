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
use App\Models\StaticTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusController extends Controller
{

    /*** index function ***/
    public function index()
    {
        $buses = Bus::latest()->paginate(10);
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
    public function emptySeatsPerBus()
    {
         $buses = DB::table('buses')->join('bus_types','buses.busType_id','bus_types.id')
              ->join('employee_run_trip_buses','employee_run_trip_buses.bus_id','buses.id')
              ->join('employee_run_trips','employee_run_trip_buses.employeeRunTrip_id','employee_run_trips.id')
              ->join('routes','employee_run_trips.route_id','routes.id')
              ->select('buses.id','buses.code','bus_types.slug','employee_run_trips.total as booked_seats',
                  'routes.name as route_name','employee_run_trips.date','employee_run_trips.time')->paginate(50);

         return view('pages.Reports.emptySeatsPerCar',compact('buses'));
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
