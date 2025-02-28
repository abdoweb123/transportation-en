<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = ['name', 'phone', 'email', 'description', 'active', 'admin_id','vendor_type_id','registration_number','national_id','taxes_number'];


    /*** start relations ***/

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }


    public function reminderHistories()
    {
        return $this->hasMany(ReminderHistory::class,'vendor_id');
    }

    /*** end relations ***/


} //end of class
