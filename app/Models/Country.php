<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasFactory , SoftDeletes , HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'active'];


    /*** start relations ***/

    public function cities()
    {
        return $this->hasMany(City::class,'country_id');
    }

    /*** end relations ***/


} //end of class
