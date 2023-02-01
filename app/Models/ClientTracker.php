<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTracker extends Model
{
    use HasFactory;
    public function employee()
    {
        return $this->belongsTo(MyEmployee::class,'employee_id');
    }
}
