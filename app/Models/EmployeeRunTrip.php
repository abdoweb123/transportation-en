<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeRunTrip extends Model
{
    use HasFactory , SoftDeletes;


    protected $fillable = ['date', 'time', 'route_id', 'driver_id', 'admin_id', 'total', 'active'];



    /*** start relations ***/

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }


    public function route()
    {
        return $this->belongsTo(Route::class,'route_id')->with('routeStations:id,route_id,station_id,station_name');
    }


    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id');
    }


    public function bus()
    {
        return $this->belongsToMany(Bus::class,'employee_run_trip_buses','employeeRunTrip_id', 'bus_id')->withSum('busType','slug');
    }

    public function bus_one()
    {
        return $this->belongsTo(Bus::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function penelties()
    {
        return $this->hasMany(Penelty::class,'employee_run_trip_id','id');
    }
    public function employee_run_trip_buses()
    {
        return $this->hasMany(EmployeeRunTripBus::class,'employeeRunTrip_id','id')->with('bus');
    }

    public function employees()
    {
        return $this->belongsToMany(MyEmployee::class,'booking_requests','employeeRunTrip_id', 'employee_id');
    }

    /*** end relations ***/

} //end of class
