<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeRunTripBus extends Model
{
    use HasFactory , SoftDeletes;


    protected $fillable = ['employeeRunTrip_id', 'bus_id', 'admin_id', 'active'];



    /*** start relations ***/

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function drivers()
    {
        return $this->belongsTo(Driver::class,'driver_id');
    }

    public function employeeRunTrip()
    {
        return $this->belongsTo(EmployeeRunTrip::class,'employeeRunTrip_id');
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class,'bus_id');
    }
    public function client_trackers()
    {
        return $this->hasMany(ClientTracker::class,'employee_run_trip_bus_id')->with('employee');
    }
    public function station_tracker()
    {
        return $this->hasMany(StationTracker::class,'employee_run_trip_bus_id');
    }
    
    /*** end relations ***/

} //end of class
