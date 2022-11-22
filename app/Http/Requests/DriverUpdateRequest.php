<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required',
            'mobile' => 'required|numeric|digits:11',
            'password' => 'required|min:8',
            'image.*' => 'mimes:jpg,jpeg,svg,png',
            'office_id' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'email.email' => 'البريد الإلكتروني يجب أن يكون صالحا',
            'mobile.required' => 'رقم الهاتف مطلوب',
            'mobile.numeric' => 'رقم الهاتف يجب أن يكون رقما',
            'mobile.digits' => 'رقم الهاتف يجب أن يتكون من 10 أحرف',
            'password.required' => 'كلمة السر مطلوبة',
            'password.min' => 'كلمة السر يجب أن تتكون من 8 أحرف علي الأقل',
            'image.required' => 'حقل الصورة مطلوب',
            'image.mimes' => 'يجب أن تكون الصورة من نوع jpg,jpeg,svg,png',
            'imag.image' => 'يجب أن يكون الملف المرفوع صورة',
            'office_id.required' => 'اسم المكتب مطلوب',
        ];
    }

}
