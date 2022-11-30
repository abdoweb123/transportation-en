<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Station extends Model
{
    use HasFactory , SoftDeletes;
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'city_id', 'admin_id'];



    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }


    public function tripStations()
    {
        return $this->hasMany(TripStation::class,'station_id');
    }


    public function FromPackages()
    {
        return $this->hasMany(Package::class,'stationFrom_id');
    }


    public function ToPackages()
    {
        return $this->hasMany(Package::class,'stationTo_id');
    }



} //end of class
