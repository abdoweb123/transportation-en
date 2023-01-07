<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReminderRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'bus_id'=>'required',
            'issue_id'=>'required',
            'reminder_days'=>'required|numeric',
            'threeshold_days'=>'required|numeric',
            'start_date'=>'required',
            'distance'=>'required|numeric',
            'threeshold_distance'=>'required|numeric',
            'task'=>'required',
        ];
    }

    public function messages()
    {
        return [
          'bus_id.required'=>'Bus is Required',
          'issue_id.required'=>'Category Issue is Required',
          'reminder_days.required'=>'reminder_days is Required',
          'threeshold_days.required'=>'threeshold_days is Required',
          'start_date.required'=>'start_date is Required',
          'distance.required'=>'distance is Required',
          'threeshold_distance.required'=>'threeshold_distance is Required',
          'task.required'=>'task is Required',
        ];
    }
}
