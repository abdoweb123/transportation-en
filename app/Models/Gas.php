<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gas extends Model
{
    use HasFactory;
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function bus_type()
    {
        return $this->belongsTo(BusType::class);
    }
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}
