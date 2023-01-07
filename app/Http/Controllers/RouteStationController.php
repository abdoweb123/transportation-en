<?php

namespace App\Http\Controllers;

use App\Http\Requests\RouteStationRequest;
use App\Models\BookingRequest;
use App\Models\Bus;
use App\Models\EmployeeRunTrip;
use App\Models\EmployeeRunTripBus;
use App\Models\ExcelEmployee;
use App\Models\MyEmployee;
use App\Models\Route;
use App\Models\RouteStation;
use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class RouteStationController extends Controller
{

    /*** operation function  ***/
    public function operation()
    {
                                                                                 // انطلاق   خط    وصول
       $excelEmployeesData = ExcelEmployee::select('id','name', 'lob', 'oracle', 'site', 'route', 'cp',
                                                   'gender', 'date', 'shift', 'start', 'end')->get();


       foreach ($excelEmployeesData as $excelEmployeesDatum)
       {

            DB::beginTransaction();
            try {

                // create or update route
                $getRoute = Route::where('name',$excelEmployeesDatum->route)->first();

                if (!$getRoute)
                {
                    $routeStation = new Route();
                    $routeStation->name = $excelEmployeesDatum->route;
                    $routeStation->admin_id = auth('admin')->id();
                    $routeStation->active = 1;
                    $routeStation->save();
                }
                else{
                    $routeStation = Route::where('name',$excelEmployeesDatum->route)->first();
                }



                // create or update route_stations by site
                $getRoute_station_site = RouteStation::where('route_id',$routeStation->id)->where('station_name',$excelEmployeesDatum->site)->first();

                if (!$getRoute_station_site)
                {
                    $routeStation_station_site = new RouteStation();
                    $routeStation_station_site->route_id = $routeStation->id;
                    $routeStation_station_site->station_name = $excelEmployeesDatum->site;
                    $routeStation_station_site->admin_id = auth('admin')->id();
                    $routeStation_station_site->active = 1;
                    $routeStation_station_site->save();
                }
                else{
                    $routeStation_station_site = RouteStation::where('route_id',$routeStation->id)->where('station_name',$excelEmployeesDatum->site)->first();
                }





                // create or update route_stations by cp
                $getRoute_station_cp = RouteStation::where('route_id',$routeStation->id)->where('station_name',$excelEmployeesDatum->cp)->first();

                if (!$getRoute_station_cp)
                {
                    $routeStation_station_cp = new RouteStation();
                    $routeStation_station_cp->route_id = $routeStation->id;
                    $routeStation_station_cp->station_name = $excelEmployeesDatum->cp;
                    $routeStation_station_cp->admin_id = auth('admin')->id();
                    $routeStation_station_cp->active = 1;
                    $routeStation_station_cp->save();
                }
                else{
                    $routeStation_station_cp = RouteStation::where('route_id',$routeStation->id)->where('station_name',$excelEmployeesDatum->cp)->first();
                }



                // create or update stations by site
                $station_site = Station::where('name->ar','=',$routeStation_station_site->station_name)->orWhere('name->en','=',$routeStation_station_site->station_name)->first();

                if (!$station_site)
                {
                    $station_site = new Station();
                    $station_site->name = ['en' => $routeStation_station_site->station_name, 'ar' => $routeStation_station_site->station_name];
                    $station_site->admin_id = auth('admin')->id();
                    $station_site->save();

                    $routeStation_station_site->station_id = $station_site->id;
                    $routeStation_station_site->update();
                }
                else{
                    $routeStation_station_site->station_id = $station_site->id;
                    $routeStation_station_site->update();
                }




                // create or update stations by cp
                $station_cp = Station::where('name->ar','=',$routeStation_station_cp->station_name)->orWhere('name->en','=',$routeStation_station_cp->station_name)->first();

                if (!$station_cp)
                {
                    $station_cp = new Station();
                    $station_cp->name = ['en' => $routeStation_station_cp->station_name, 'ar' => $routeStation_station_cp->station_name];
                    $station_cp->admin_id = auth('admin')->id();
                    $station_cp->save();
                }


                $routeStation_station_cp->station_id = $station_cp->id;
                $routeStation_station_cp->update();



                // Determine male or female
                if (Str::lower($excelEmployeesDatum->gender) == 'male')
                    $excelEmployeesDatum->gender = 1;
                else
                    $excelEmployeesDatum->gender = 2;



                // create or update employee and request
                $getEmployee = MyEmployee::where('oracle_id',$excelEmployeesDatum->oracle)->first();

                if (!$getEmployee)
                {
                    $getEmployee = new MyEmployee();
                    $getEmployee->name = $excelEmployeesDatum->name;
                    $getEmployee->oracle_id = $excelEmployeesDatum->oracle;
                    $getEmployee->collectionPoint_id = $station_cp->id;
                    $getEmployee->gender = $excelEmployeesDatum->gender;
                    $getEmployee->admin_id = auth('admin')->id();
                    $getEmployee->active = 1;
                    $getEmployee->save();
                }

                // create booking request AM
                $bookingRequest = new BookingRequest();
                $bookingRequest->collection_point_from_id = $station_cp->id;
                $bookingRequest->collection_point_to_id = $station_site->id;
                $bookingRequest->route_id = $routeStation->id;
                $bookingRequest->date = date('Y-m-d',strtotime($excelEmployeesDatum->date));
                $bookingRequest->time = $excelEmployeesDatum->start;
                $bookingRequest->employee_id = $getEmployee->id;
                $bookingRequest->shift = $excelEmployeesDatum->shift;
                $bookingRequest->address = $getEmployee->address;
                $bookingRequest->admin_id = auth('admin')->id();
                $bookingRequest->active = 1;
                $bookingRequest->save();


                // create booking request PM
                $bookingRequest = new BookingRequest();
                $bookingRequest->collection_point_from_id = $station_site->id;
                $bookingRequest->collection_point_to_id = $station_cp->id;
                $bookingRequest->route_id = $routeStation->id;
                $bookingRequest->date = date('Y-m-d',strtotime($excelEmployeesDatum->date));
                $bookingRequest->time = $excelEmployeesDatum->end;
                $bookingRequest->employee_id = $getEmployee->id;
                $bookingRequest->shift = $excelEmployeesDatum->shift;
                $bookingRequest->address = $getEmployee->address;
                $bookingRequest->admin_id = auth('admin')->id();
                $bookingRequest->active = 1;
                $bookingRequest->save();


                ExcelEmployee::query()->find($excelEmployeesDatum->id)->forceDelete();

                DB::commit();
            }
            catch (\Exception $exception){
                DB::rollBack();
            }

       } // end of foreach

        return redirect()->route('add_bus.to.booking_request');

    }



    /*** operation2 function  ***/
    public function operation2()
    {

        $booking_requests = BookingRequest::select('date','time','route_id' ,DB::raw('count(*) as total'))->groupBy('date','time','route_id')->get('date','time','route_id');


        foreach ($booking_requests as $booking_request) // 110 group
        {
            $employee_run_trip = new EmployeeRunTrip();
            $employee_run_trip->date = $booking_request->date;
            $employee_run_trip->time = $booking_request->time;
            $employee_run_trip->route_id = $booking_request->route_id;
            $employee_run_trip->total = $booking_request->total;
            $employee_run_trip->admin_id = auth('admin')->id();
            $employee_run_trip->active = 1;
            $employee_run_trip->save();
        }


        $buses =   DB::table('buses')->join('bus_types','buses.busType_id','=','bus_types.id')->select('buses.id','bus_types.slug')->get();

        foreach ($buses as $bus)
        {
            $arr_bus[] = [$bus->slug,$bus->id];
        }

        sort($arr_bus);

        $booking_requests_collections = EmployeeRunTrip::select('id','date','time','route_id','total')->get();

        foreach ($booking_requests_collections as $booking_requests_collection) //110
        {
            for ($x=0; $x<count($arr_bus); $x++)
            {
                if ($booking_requests_collection->total <= $arr_bus[$x][0])
                {

                    if (isset($arr_bus[$x][1]))
                    {
                        $runTripBusEmployee = new EmployeeRunTripBus();
                        $runTripBusEmployee->employeeRunTrip_id = $booking_requests_collection->id;
                        $runTripBusEmployee->bus_id = $arr_bus[$x][1];
                        $runTripBusEmployee->admin_id = auth('admin')->id();
                        $runTripBusEmployee->active = 1;
                        $runTripBusEmployee->save();



                    }
                    else{
                        $runTripBusEmployee = new EmployeeRunTripBus();
                        $runTripBusEmployee->employeeRunTrip_id = $booking_requests_collection->id;
                        $runTripBusEmployee->bus_id = null;
                        $runTripBusEmployee->admin_id = auth('admin')->id();
                        $runTripBusEmployee->active = 1;
                        $runTripBusEmployee->save();


                    }

                    break;

                }
            }
        }








        $employeeRunTripBuses = DB::table('employee_run_trips')->join('employee_run_trip_buses','employee_run_trip_buses.employeeRunTrip_id','=','employee_run_trips.id')->select('employee_run_trips.date','employee_run_trips.time','employee_run_trip_buses.bus_id' ,DB::raw('count(*) as total'))->where('total','>',1)->groupBy('employee_run_trips.date','employee_run_trips.time','employee_run_trip_buses.bus_id')->get();

        foreach ($employeeRunTripBuses as $runTripBusEmployee)
        {
            $oldBusSlug = Bus::find($runTripBusEmployee->bus_id)->busType->slug;

            for ($x = 0; $x < count($arr_bus); $x++)
            {
                if ($arr_bus[$x][0] >= $oldBusSlug)
                {
                    $newArr_bus[] = [$arr_bus[$x][0],$arr_bus[$x][1]];
                }
            }


            $newRunTripBusEmployees = EmployeeRunTrip::where('date', $runTripBusEmployee->date)->where('time', $runTripBusEmployee->time)->get();


            for ($i=0; $i<count($newRunTripBusEmployees); $i++)
            {

                $employeeRunTripBus = EmployeeRunTripBus::where('employeeRunTrip_id',$newRunTripBusEmployees[$i]->id)->first();

                if ($i >= count($newArr_bus)){

                    $employeeRunTripBus->update([
                            'bus_id'=>null,
                        ]);
                }
                else {
                    $employeeRunTripBus->update([
                        'bus_id'=>$newArr_bus[$i][1],
                    ]);
                }
            }
        }





        $employeeRunTrips = DB::table('employee_run_trips')->join('employee_run_trip_buses','employee_run_trip_buses.employeeRunTrip_id','=','employee_run_trips.id')->select('employee_run_trips.date','employee_run_trips.time','employee_run_trips.route_id','employee_run_trips.id','employee_run_trip_buses.bus_id')->get();

        foreach ($employeeRunTrips as $employeeRunTrip)
        {
            $bookingRequests = BookingRequest::where('route_id',$employeeRunTrip->route_id)->where('date',$employeeRunTrip->date)->where('time',$employeeRunTrip->time)->get();

            foreach ($bookingRequests as $bookingRequest)
            {
                $bookingRequest->employeeRunTrip_id  = $employeeRunTrip->id;
                $bookingRequest->bus_id  = $employeeRunTrip->bus_id;
                $bookingRequest->update();

            }

        }


        return redirect()->route('bookingRequests.index')->with('alert-success','Data is saved successfully');

    }



    /*** get all offices ***/
    public function index()
    {
        $routeStations = RouteStation::all();
        $routes = Route::select('id','name')->get();
        $stations = Station::select('id','name')->get();
        return view('pages.RouteStation.index', compact('routeStations','routes','stations'));
    }



    /*** create an office ***/
    public function store(RouteStationRequest $request)
    {
        try {
            $routeStation = new RouteStation();
            $routeStation->route_id = $request->route_id;
            $routeStation->station_id = $request->station_id;
            $routeStation->admin_id = auth('admin')->id();
            $routeStation->active = 1;
            $routeStation->save();

            $routeStation->station_name = $routeStation->station->name;
            $routeStation->update();
            return redirect()->back()->with('alert-success','Data is saved successfully');
        }
        catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }



    /*** update the office ***/
    public function update(RouteStationRequest $request)
    {
        try {
            $routeStation = RouteStation::findOrFail($request->id);
            $routeStation->route_id = $request->route_id;
            $routeStation->station_id = $request->station_id;
            $routeStation->admin_id = auth('admin')->id();
            $routeStation->active = $request->active;
            $routeStation->update();
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
        $routeStation = RouteStation::findOrFail($request->id)->delete();
        return redirect()->back()->with('alert-success','Data is deleted successfully');
    }

} //end of class
