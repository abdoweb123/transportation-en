<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraFee extends Model
{
    use HasFactory;
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
    public function type()
    {
        return $this->belongsTo(StaticTable::class,'type_id');
    }
} 
