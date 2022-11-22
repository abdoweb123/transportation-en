<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripData extends Model
{
    use HasFactory , SoftDeletes;


    protected $fillable = ['name', 'busType_id', 'degree_id', 'admin_id', 'type', 'notes'];

    protected $casts = ['degree_id'];


    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }


    public function busType()
    {
        return $this->belongsTo(BusType::class,'busType_id');
    }


    public function degree()
    {
        return $this->belongsTo(Degree::class,'degree_id');
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


} //end class
