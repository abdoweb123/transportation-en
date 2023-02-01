<?php

namespace App\Models\Api;

use App\Models\Admin;
use App\Models\Office;
use App\Models\Station;
use App\Models\EmployeeJob;
use App\Models\Department;
use App\Models\BookingRequest;
use Laravel\Passport\HasApiTokens;
// use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;

class MyEmployee extends Authenticatable
{
    // use HasApiTokens,Notifiable;
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;
    /**  
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['oracle_id', 'office_id', 'collectionPoint_id', 'employeeJob_id', 'department_id',
    'admin_id', 'address', 'gender', 'phone', 'email', 'password', 'active'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }


    public function office()
    {
        return $this->belongsTo(Office::class,'office_id');
    }


    public function collectionPoint()
    {
        return $this->belongsTo(Station::class,'collectionPoint_id');
    }


    public function EmployeeJob()
    {
        return $this->belongsTo(EmployeeJob::class,'employeeJob_id');
    }


    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }


    public function bookingRequest()
    {
        return $this->hasMany(BookingRequest::class,'employee_id');
    }

}
