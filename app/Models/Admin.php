<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin  extends Authenticatable
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['name', 'email', 'password', 'type', 'admin_id'];


    public function getTypeAttribute($val)
    {
        switch ($val)
        {
            case 1: echo 'Supervisor'; break;
            case 2: echo 'Admin'; break;
            case 3: echo 'Employee'; break;
        }
    }



    /*** start relations ***/

    public function parent()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }


    public function children()
    {
        return $this->hasMany(Admin::class,'admin_id');
    }


    public function cities()
    {
        return $this->hasMany(City::class,'admin_id');
    }


    public function buses()
    {
        return $this->hasMany(Bus::class,'admin_id');
    }


    public function seats()
    {
        return $this->hasMany(Seat::class,'admin_id');
    }


    public function drivers()
    {
        return $this->hasMany(Driver::class,'admin_id');
    }


    public function stations()
    {
        return $this->hasMany(Station::class,'admin_id');
    }


    public function busTypes()
    {
        return $this->hasMany(BusType::class,'admin_id');
    }


    public function users()
    {
        return $this->hasMany(User::class,'admin_id');
    }


    public function offices()
    {
        return $this->hasMany(Office::class,'admin_id');
    }


    public function degrees()
    {
        return $this->hasMany(Degree::class,'admin_id');
    }


    public function tripData()
    {
        return $this->hasMany(TripData::class,'admin_id');
    }


    public function tripStations()
    {
        return $this->hasMany(TripStation::class,'admin_id');
    }


    public function lines()
    {
        return $this->hasMany(Line::class,'admin_id');
    }


    public function adminRunTrips()
    {
        return $this->hasMany(RunTrip::class,'admin_id');
    }


    public function hostRunTrips()
    {
        return $this->hasMany(RunTrip::class,'host_id');
    }


    public function tripDegrees()
    {
        return $this->hasMany(TripDegree::class,'admin_id');
    }


    public function tripSeats()
    {
        return $this->hasMany(TripSeat::class,'admin_id');
    }


    public function coupons()
    {
        return $this->hasMany(Coupon::class,'admin_id');
    }


    public function couponTrips()
    {
        return $this->hasMany(CouponTrip::class,'admin_id');
    }


    public function packages()
    {
        return $this->hasMany(Package::class,'admin_id');
    }


    public function bookedPackages()
    {
        return $this->hasMany(BookedPackage::class,'admin_id');
    }


    public function customerTypes()
    {
        return $this->hasMany(CustomerType::class,'admin_id');
    }


    public function millages()
    {
        return $this->hasMany(Millage::class,'admin_id');
    }


    public function vendors()
    {
        return $this->hasMany(Vendor::class,'admin_id');
    }


    public function categories()
    {
        return $this->hasMany(Category::class,'admin_id');
    }


    public function efficiencyFuels()
    {
        return $this->hasMany(EfficiencyFuel::class,'admin_id');
    }


    public function manuallyFuels()
    {
        return $this->hasMany(ManuallyFuel::class,'admin_id');
    }


    public function employeeJobs()
    {
        return $this->hasMany(EmployeeJob::class,'admin_id');
    }


    public function departments()
    {
        return $this->hasMany(Department::class,'admin_id');
    }


    public function myEmployees()
    {
        return $this->hasMany(MyEmployee::class,'admin_id');
    }


    public function routes()
    {
        return $this->hasMany(Route::class,'admin_id');
    }


    public function routeStations()
    {
        return $this->hasMany(RouteStation::class,'admin_id');
    }


    public function bookingRequest()
    {
        return $this->hasMany(BookingRequest::class,'admin_id');
    }


    public function employeeRunTrips()
    {
        return $this->hasMany(EmployeeRunTrip::class,'admin_id');
    }


    public function reminders()
    {
        return $this->hasMany(Reminder::class,'admin_id');
    }


    public function reminderHistories()
    {
        return $this->hasMany(ReminderHistory::class,'admin_id');
    }


    /*** end relations ***/

} //end of class
