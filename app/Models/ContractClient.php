<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractClient extends Model
{
    use HasFactory;
    public function company()
    {
        return $this->hasOne(StaticTable::class,'id','company_id'); 
    }
}
