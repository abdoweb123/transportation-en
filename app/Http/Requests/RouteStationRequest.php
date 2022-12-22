<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteStationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'route_id'=>'required',
            'station_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
          'route_id.required'=>'Route is required',
          'station_id.required'=>'Station is required',
        ];
    }


}
