<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwapRequest extends Model
{
    use HasFactory;
    public function employee()
    {
        return $this->belongsTo(MyEmployee::class,'employee_id');
    }
    public function booking_request()
    {
        return $this->belongsTo(BookingRequest::class,'booking_request_id');
    }
}
