<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['code', 'status', 'busType_id', 'admin_id', 'driver_id','gas_type_id'];



    /*** start relations ***/

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }


    public function busType()
    {
        return $this->belongsTo(BusType::class,'busType_id');
    }


    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id');
    }


    public function runTrips()
    {
        return $this->hasMany(RunTrip::class,'bus_id');
    }


    public function efficiencyFuels()
    {
        return $this->hasMany(EfficiencyFuel::class,'bus_id');
    }


    public function manuallyFuels()
    {
        return $this->hasMany(ManuallyFuel::class,'bus_id');
    }


    public function bookingRequest()
    {
        return $this->hasMany(BookingRequest::class,'bus_id');
    }


    public function employeeRunTrip()
    {
        return $this->belongsToMany(Bus::class,'employee_run_trip_buses', 'bus_id','employeeRunTrip_id');
    }


    public function reminders()
    {
        return $this->hasMany(Reminder::class,'bus_id');
    }

   /*** end relations ***/

} //end of class
