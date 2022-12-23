<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRunTripRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'route_id'=>'required',
            'time'=>'required',
            'date'=>'required',
        ];
    }

    public function messages()
    {
        return [
          'route_id.required'=>'Route is Required',
          'time.required'=>'Time is Required',
          'date.required'=>'Date is Required',
        ];
    }


}
