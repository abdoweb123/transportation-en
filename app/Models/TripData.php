<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripData extends Model
{
    use HasFactory , SoftDeletes;


    protected $fillable = ['name', 'busType_id', 'admin_id', 'type', 'notes'];


//    public function setDegreesAttribute($value)
//    {
//        $this->attributes['degrees'] = json_encode($value);
//    }
//
//
//    public function getDegreesAttribute($value)
//    {
//          return  $this->attributes['degrees'] = json_decode($value);
//    }


    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }


    public function busType()
    {
        return $this->belongsTo(BusType::class,'busType_id');
    }



    public function tripStations()
    {
        return $this->hasMany(TripStation::class,'tripData_id');
    }


    public function lines()
    {
        return $this->hasMany(Line::class,'tripData_id');
    }


    public function runTrips()
    {
        return $this->hasMany(RunTrip::class,'tripData_id');
    }


    public function tripDegrees()
    {
        return $this->hasMany(TripDegree::class,'tripData_id');
    }


    public function tripSeats()
    {
        return $this->hasMany(TripSeat::class,'tripData_id');
    }


    public function couponTrips()
    {
        return $this->hasMany(CouponTrip::class,'tripData_id');
    }

} //end class
