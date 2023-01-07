<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reminder extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['bus_id', 'issue_id', 'reminder_days', 'threeshold_days', 'start_date',
                            'distance', 'threeshold_distance', 'task', 'admin_id', 'active'];



    /*** start relations ***/

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }


    public function issue()
    {
        return $this->belongsTo(Issue::class,'issue_id');
    }


    public function bus()
    {
        return $this->belongsTo(Bus::class,'bus_id');
    }


    public function reminderHistories()
    {
        return $this->hasMany(ReminderHistory::class,'reminder_id');
    }

    /*** end relations ***/

} //end of class
