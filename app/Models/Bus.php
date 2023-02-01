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
        return $this->hasOne(BusType::class,'id','busType_id')->with('contract_route');
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

    public function employee_run_trip_buses()
    {
        return $this->hasMany(EmployeeRunTripBus::class,'bus_id')->with('drivers','employeeRunTrip');
    }


    public function reminders()
    {
        return $this->hasMany(Reminder::class,'bus_id');
    }

    public function penelties()
    {
        return $this->hasMany(Penelty::class,'bus_id');
    }

    public function accidents()
    {
        return $this->hasMany(Accident::class,'bus_id');
    }

    public function payments()
    {
        return $this->hasMany(CarPayment::class,'bus_id')->with('car_payment_dates');
    }
    
    public function gas()
    {
        return $this->hasMany(Gas::class,'bus_id');
    }

    public function extera_fees()
    {
        return $this->hasMany(ExtraFee::class,'bus_id');
    }

    public function location_tracker()
    {
        return $this->hasMany(LocationTracker::class,'bus_id','id');
    }
   /*** end relations ***/

} //end of class
