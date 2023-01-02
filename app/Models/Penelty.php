<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penelty extends Model
{
    use HasFactory;
    public function penelty_type()
    {
        return $this->belongsTo(StaticTable::class,'penelty_type_id');
    }
    
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    
}
