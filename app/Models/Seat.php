<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','status','bus_id','type'];


    public function bus()
    {
        return $this->belongsTo(Bus::class,'bus_id');
    }

} //end of class

