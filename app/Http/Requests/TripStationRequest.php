<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripStationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'station_id'=>'required',
            'tripData_id'=>'required',
            'type'=>'required',
            'timeInMinutes'=>'required',
            'distance'=>'required',
            'rank'=>'required',
            'printTimes'=>'required',
        ];
    }

    public function messages()
    {
        return [
          'station_id.required'=>'اسم المحطة مطلوب',
          'tripData_id.required'=>'اسم الرحلة مطلوب',
          'type.required'=>'نوع المحطة مطلوب',
          'timeInMinutes.required'=>'الوقت المستغرق للوصول لهذه المحطة مطلوب',
          'distance.required'=>'المسافة المقطوعة للوصول لهذه المحطة مطلوب',
          'rank.required'=>'ترتيب الرحلة مطلوب',
          'printTimes.required'=>'عدد مرات طباعة اللوحة مطلوب',
        ];
    }
}
