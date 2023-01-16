<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    use HasFactory;
    public function driver()
    {
        return $this->hasOne(Driver::class,'id','driver_id');
    }
    public function bus()
    {
        return $this->hasOne(Bus::class,'id','bus_id');
    }
}
