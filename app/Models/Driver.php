<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Driver extends Authenticatable 
{
    use HasFactory , SoftDeletes;
    use HasApiTokens;

    protected $fillable = ['name', 'admin_id', 'image', 'title', 'password', 'role', 'email', 'mobile',
                           'email_verified_at', 'fcm_token', 'bio', 'balance', 'real_balance', 'percentage',
                            'office_id', 'manager','national_id','insurance_kind_id','expiration_insurance_date','insurance_insurance_date'
                            ];


    /*** start relations ***/

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }


    public function office()
    {
        return $this->belongsTo(Office::class,'office_id');
    }


    public function buses()
    {
        return $this->hasMany(Bus::class,'driver_id');
    }


    public function runTrips()
    {
        return $this->hasMany(RunTrip::class,'driver_id');
    }


    public function employeeRunTrips()
    {
        return $this->hasMany(EmployeeRunTrip::class,'driver_id');
    }

    public function driver_salary()
    {
        return $this->hasOne(DriverSalary::class,'driver_id');
    }

    public function employeeRunTripsBuses()
    {
        return $this->hasMany(EmployeeRunTripBus::class,'driver_id');
    }

    public function station_tracker()
    {
        return $this->hasMany(StationTracker::class,'driver_id');
    }

    /*** end relations ***/

} //end of class
