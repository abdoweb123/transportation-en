<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestBus extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'code'=>'required',
            'busType_id'=>'required',
            'gas_type_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
          'code.required'=>'كود الحافلة مطلوب',
          'busType_id.required'=>'اسم الأسطول مطلوب',
          'gas_type_id.required'=>' نوع الجاز مطلوب',
        ];
    }
}
