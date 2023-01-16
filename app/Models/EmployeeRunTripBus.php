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
        return $this->belongsTo(Driver::class);
    }

    /*** end relations ***/

} //end of class
