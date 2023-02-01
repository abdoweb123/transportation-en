<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractClient extends Model
{
    use HasFactory;
    public function company()
    {
        return $this->hasOne(Company::class,'id','company_id'); 
    }
    public function cotract_routes()
    {
        return $this->hasMany(CotractRoute::class,'contracts_id','id');
    }
    public function discounts()
    {
        return $this->hasMany(contractDiscount::class,'contract_client_id','id');
    }
}
