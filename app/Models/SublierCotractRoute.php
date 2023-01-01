<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SublierCotractRoute extends Model
{
    use HasFactory;
    public function contract()
    {
        return $this->hasOne(ContractClient::class,'id','contracts_id');
    }
    public function suplier()
    {
        return $this->hasOne(StaticTable::class,'id','suplier_id');
    }
    public function route()
    {
        return $this->hasOne(Route::class,'id','route_id');
    }
    public function bus_type()
    {
        return $this->hasOne(BusType::class,'id','bus_type_id');
    }
    public function service_type()
    {
        return $this->hasOne(StaticTable::class,'id','service_type_id');
    }
}
