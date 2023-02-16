<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestStation extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name_ar'=>'required|unique:stations,name->ar,'.$this->id,
            'name_en'=>'required|unique:stations,name->en'.$this->id,
            'lat'=>'required',
            'lon'=>'required',
            'city_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
          'name_ar.required'=>trans('stations_trans.station_name_ar_validation'),
          'name_ar.unique'=>'name ar already existed!',
          'name_en.required'=>trans('stations_trans.station_name_en_validation'),
          'name_en.unique'=>'name en already existed!',
          'city_id.required'=>trans('stations_trans.city_id_validation'),
          'lat.required'=>'lat field required !',
          'lon.required'=>'long field required !',
        ];
    }
}
