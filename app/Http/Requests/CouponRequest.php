<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
        'code'=>'required',
        'amount'=>'required',
        'percent'=>'required',
        'startDate'=>'required',
        'endDate'=>'required',
        'max_users'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'code.required'=>'الكود مطلوب',
            'amount.required'=>'الخصم مطلوب',
            'percent.required'=>'النسبة مطلوب',
            'startDate.required'=>'تاريخ البداية مطلوب',
            'endDate.required'=>'تاريخ النهاية مطلوب',
            'max_users.required'=>'العدد الكلي للمستخدمين مطلوب',
        ];
    }
}
