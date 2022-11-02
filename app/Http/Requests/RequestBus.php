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
            'name'=>'required',
        ];
    }

    public function messages()
    {
        return [
          'code.required'=>'كود الحافلة مطلوب',
          'name.required'=>'اسم الحافلة مطلوب',
        ];
    }
}
