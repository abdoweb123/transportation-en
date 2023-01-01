<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractSublier extends Model
{
    use HasFactory;
    public function sublier()
    {
        return $this->hasOne(StaticTable::class,'id','sublier_id'); 
    }
}
