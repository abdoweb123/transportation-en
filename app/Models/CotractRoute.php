<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotractRoute extends Model
{
    use HasFactory;
    public function contract()
    {
        return $this->hasOne(ContractClient::class,'id','contracts_id')->with('discounts')->withCount('cotract_routes');
    }
    public function company()
    {
        return $this->hasOne(Company::class,'id','company_id');
    }
    public function route()
    {
        return $this->hasOne(Route::class,'id','route_id')->with('employeeRunTrips:id,date,time,route_id,company_id');
    }
    public function bus_type()
    {
        return $this->hasOne(BusType::class,'id','bus_type_id');
    }
    public function service_type()
    {
        return $this->hasOne(StaticTable::class,'id','service_type_id');
    }
    public function discounts()
    {
        return $this->hasMany(contractDiscount::class,'contract_client_id','id');
    }
}
