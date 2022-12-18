<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use App\Models\ExcelEmployee;
use App\Models\MyEmployee;
use App\Models\Route;
use App\Models\RouteStation;
use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RouteStationController extends Controller
{

    public function operation()
    {                                               // انطلاق   خط    وصول
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
                    $route = new Route();
                    $route->name = $excelEmployeesDatum->route;
                    $route->admin_id = auth('admin')->id();
                    $route->active = 1;
                    $route->save();
                }
                else{
                    $route = Route::where('name',$excelEmployeesDatum->route)->first();
                }



                // create or update route_stations by site
                $getRoute_station_site = RouteStation::where('route_id',$route->id)->where('station_name',$excelEmployeesDatum->site)->first();

                if (!$getRoute_station_site)
                {
                    $route_station_site = new RouteStation();
                    $route_station_site->route_id = $route->id;
                    $route_station_site->station_name = $excelEmployeesDatum->site;
                    $route_station_site->admin_id = auth('admin')->id();
                    $route_station_site->active = 1;
                    $route_station_site->save();
                }
                else{
                    $route_station_site = RouteStation::where('route_id',$route->id)->where('station_name',$excelEmployeesDatum->site)->first();
                }





                // create or update route_stations by cp
                $getRoute_station_cp = RouteStation::where('route_id',$route->id)->where('station_name',$excelEmployeesDatum->cp)->first();

                if (!$getRoute_station_cp)
                {
                    $route_station_cp = new RouteStation();
                    $route_station_cp->route_id = $route->id;
                    $route_station_cp->station_name = $excelEmployeesDatum->cp;
                    $route_station_cp->admin_id = auth('admin')->id();
                    $route_station_cp->active = 1;
                    $route_station_cp->save();
                }
                else{
                    $route_station_cp = RouteStation::where('route_id',$route->id)->where('station_name',$excelEmployeesDatum->cp)->first();
                }



                // create or update stations by site
                $station_site = Station::where('name->ar','=',$route_station_site->station_name)->orWhere('name->en','=',$route_station_site->station_name)->first();

                if (!$station_site)
                {
                    $station_site = new Station();
                    $station_site->name = ['en' => $route_station_site->station_name, 'ar' => $route_station_site->station_name];
                    $station_site->admin_id = auth('admin')->id();
                    $station_site->save();

                    $route_station_site->station_id = $station_site->id;
                    $route_station_site->update();
                }
                else{
                    $route_station_site->station_id = $station_site->id;
                    $route_station_site->update();
                }




                // create or update stations by cp
                $station_cp = Station::where('name->ar','=',$route_station_cp->station_name)->orWhere('name->en','=',$route_station_cp->station_name)->first();

                if (!$station_cp)
                {
                    $station_cp = new Station();
                    $station_cp->name = ['en' => $route_station_cp->station_name, 'ar' => $route_station_cp->station_name];
                    $station_cp->admin_id = auth('admin')->id();
                    $station_cp->save();
                }


                $route_station_cp->station_id = $station_cp->id;
                $route_station_cp->update();



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
                $bookingRequest->route_id = $route->id;
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
                $bookingRequest->route_id = $route->id;
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

       return redirect()->back()->with('alert-success','تم تحديث البيانات بنجاح');

    }






} //end of class
