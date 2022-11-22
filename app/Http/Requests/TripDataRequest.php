<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripDataRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'=>'required',
            'busType_id'=>'required',
            'degree_id'=>'required',
//            'type'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'اسم الرحلة مطلوب',
            'busType_id.required'=>'اسم الأسطول مطلوب',
            'degree_id.required'=>'درجة الرحلة مطلوبة',
//            'type.required'=>'نوع الرحلة مطلوبة',
        ];
    }


}
