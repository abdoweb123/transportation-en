<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReminderHistory extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['reminder_id', 'vendor_id', 'total_paid', 'cost_per_day', 'done', 'admin_id', 'active'];



    /*** start relations ***/

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }


    public function reminder()
    {
        return $this->belongsTo(Reminder::class,'reminder_id');
    }


    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
    
    public function brand()
    {
        return $this->belongsTo(StaticTable::class,'gudget_brand_id')->whereType('gudget_brand');
    }

    public function type()
    {
        return $this->belongsTo(StaticTable::class,'gudget_type_id')->whereType('gudget_type');
    }

    /*** end relations ***/

} //end of class

