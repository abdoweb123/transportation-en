<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    public function borrow_type()
    {
        return $this->hasOne(StaticTable::class,'id','borrow_type_id');
    }
    public function driver()
    {
        return $this->hasOne(Driver::class,'id','driver_id');
    }
}
