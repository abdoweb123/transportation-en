<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>absence</title>
</head>
<body>
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center" >
            <thead>
            <tr>
                <th>#</th>
                <th style="background-color:#000000; color:white">{{ trans('main_trans.year') }}  </th>
                <th style="background-color:#000000; color:white"> {{ trans('main_trans.month') }}</th>
                <th style="background-color:#000000; color:white">{{ trans('main_trans.client_name') }} </th>
                <th style="background-color:#000000; color:white">{{ trans('main_trans.bus_type') }}</th>
                <th style="background-color:#000000; color:white">{{ trans('main_trans.servic_type') }} </th>
                    <th style="background-color:#00b0f0; color:white">{{ trans('main_trans.service_value') }}</th>
                <th style="background-color:#00b0f0; color:white">{{ trans('main_trans.number_of_maintenance') }} </th>
                    <th style="background-color:#00b0f0; color:white">{{ trans('main_trans.number_of_spare_parts_used') }} </th>
                    <th style="background-color:#00b0f0; color:white">{{ trans('main_trans.total_maintenance_value') }} </th>
                <th style="background-color:#002060; color:white">{{ trans('main_trans.count_of_penelties') }} </th>
                <th style="background-color:#002060; color:white">{{ trans('main_trans.total_of_penelties') }} </th>
                <th style="background-color:#974706; color:white">{{ trans('main_trans.Accident_Count') }}</th>
                <th style="background-color:#974706; color:white">{{ trans('main_trans.insurance_Pay') }}</th>
                <th style="background-color:#974706; color:white">{{ trans('main_trans.Company_pay') }}</th>
                <th style="background-color:#974706; color:white">{{ trans('main_trans.driver_pay') }}</th>
                <th style="background-color:#974706; color:white">{{ trans('main_trans.fixing_Amount') }}</th>
                <th style="background-color: #808080; color:white">{{ trans('main_trans.debt_Amount') }}</th>
                <th style="background-color: #808080; color:white">{{ trans('main_trans.total_debt') }}</th>
                <th style="background-color:#808080; color:white">{{ trans('main_trans.driver_numbers') }}</th>
                <th style="background-color:#808080; color:white">{{ trans('main_trans.total_driver_amount') }} </th>
                <th style="background-color: #ffff00; color:white">{{ trans('main_trans.total_gas') }}</th>
                <th style="background-color:#f79646; color:white">{{ trans('main_trans.extera_fees') }}</th>
                <th style="background-color:#4f6228; color:white">{{ trans('main_trans.total_expenses') }}</th>
                
            </tr>
            </thead>
            <tbody>
                @foreach ($results as $index=>$result)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse(@$result->busType->contract_route->contract->created_at)->format('Y')}}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse(@$result->busType->contract_route->contract->created_at)->format('M')}}
                        </td>
                        <td>{{ @$result->busType->contract_route->contract->company->name }}</td>
                        <td>{{ @$result->busType->name }}</td>
                        <td>{{ trans('main_trans.payment_type')[@$result->busType->contract_route->payment_type] }}</td>
                        <td>{{ @$result->busType->contract_route->service_value }}</td>
                        <td>{{ @$result->reminders->count() }}</td>
                        <td>{{ @$result->reminders->count('reminderHistories') }}</td>
                        <td>
                            {{-- {{ (@$result->reminders->count('reminderHistories') != null ? @$result->reminders->withSum('reminderHistories','total_paid') : 0 )}} --}}
                            {{ (@$result->reminders->sum('reminder_histories_sum_total_paid'))}}
                        </td>
                        <td>{{ @$result->penelties->count() }}</td>
                        <td>{{ @$result->penelties->sum('amount') }}</td>
                        <td>{{ @$result->accidents->count() }}</td>
                        <td>{{ @$result->accidents->sum('insurance_pay') }}</td>
                        <td>{{ @$result->accidents->sum('company_pay') }}</td>
                        <td>{{ @$result->accidents->sum('driver_pay') }}</td>
                        <td>{{ @$result->accidents->sum('fixing_amount') }}</td>
                        <td>{{ @$result->payments->count("car_payment_dates") }}</td>
                        <td>{{ @$result->payments->sum('total_amount')}}</td>
                        <td>{{ @$result->employee_run_trip_buses->count()}}</td>
                        <td>{{ @$total_amount_driver }}</td>
                        <td>{{ @$result->gas->sum('amount')}}</td>
                        <td>{{ @$result->extera_fees->sum('amount')}}</td>
                        <td>{{ (@$result->payments->sum('total_amount') != null ? @$result->payments->sum('total_amount') : 0)+ @$result->penelties->sum('amount')  + @$result->extera_fees->sum('amount') + @$result->gas->sum('amount') + @$result->reminders->sum('reminder_histories_sum_total_paid') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>