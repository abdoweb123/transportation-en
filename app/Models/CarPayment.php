<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarPayment extends Model
{
    use HasFactory;
    public function bus()
    {
        return $this->hasOne(Bus::class,'id','bus_id');
    }
    public function car_payment_dates()
    {
        return $this->hasMany(CarPaymentDate::class,'car_payment_id');
    }
}
