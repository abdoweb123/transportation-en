<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    public function discount_type()
    {
        return $this->hasOne(StaticTable::class,'id','discount_type_id');
    }
}
