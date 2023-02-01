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
                <th style="background-color:black; color:white">{{ trans('main_trans.year') }}  </th>
                <th style="background-color:black; color:white"> {{ trans('main_trans.month') }}</th>
                <th style="background-color:black; color:white">{{ trans('main_trans.client_name') }} </th>
                <th style="background-color:black; color:white">{{ trans('main_trans.bus_type') }}</th>
                <th style="background-color:black; color:white">{{ trans('main_trans.servic_type') }} </th>
                <th style="background-color:rgb(170, 183, 253); color:white">{{ trans('main_trans.service_value') }}</th>
                <th style="background-color:rgb(170, 183, 253); color:white">{{ trans('main_trans.number_of_maintenance') }} </th>
                <th style="background-color:rgb(170, 183, 253); color:white">{{ trans('main_trans.total_maintenance_value') }} </th>
                <th style="background-color:rgb(98, 108, 165); color:white">{{ trans('main_trans.count_of_penelties') }} </th>
                <th style="background-color:rgb(21, 179, 47); color:white">{{ trans('main_trans.total_of_penelties') }} </th>
                <th style="background-color:rgb(21, 179, 47); color:white">{{ trans('main_trans.Accident_Count') }}</th>
                <th style="background-color:rgb(21, 179, 47); color:white">{{ trans('main_trans.insurance_Pay') }}</th>
                <th style="background-color:rgb(21, 179, 47); color:white">{{ trans('main_trans.Company_pay') }}</th>
                <th style="background-color:rgb(21, 179, 47); color:white">{{ trans('main_trans.fixing_Amount') }}</th>
                <th style="background-color:rgb(58, 67, 119); color:white">{{ trans('main_trans.debt_Amount') }}</th>
                <th style="background-color:rgb(58, 67, 119); color:white">{{ trans('main_trans.total_debt') }}</th>
                <th style="background-color:rgb(119, 58, 99); color:white">{{ trans('main_trans.driver_numbers') }}</th>
                <th style="background-color:rgb(119, 58, 99); color:white">{{ trans('main_trans.total_driver_amount') }} </th>
                <th style="background-color:rgb(248, 158, 218); color:white">{{ trans('main_trans.total_gas') }}</th>
                <th style="background-color:rgb(140, 226, 128); color:white">{{ trans('main_trans.extera_fees') }}</th>
                <th style="background-color:rgb(107, 11, 75); color:white">{{ trans('main_trans.total_expenses') }}</th>
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
                        <td>{{ @$result->busType->contract_route->service_type->name }}</td>
                        <td>{{ @$result->busType->contract_route->service_value }}</td>
                        <td>{{ @$result->reminders->count() }}</td>
                        {{-- <td>{{ @$result->reminders->sum('reminderHistories','total_paid') }}</td> --}}
                        <td>{{ @$result->penelties->count() }}</td>
                        <td>{{ @$result->penelties->sum('amount') }}</td>
                        <td>{{ @$result->accidents->count() }}</td>
                        <td>{{ @$result->accidents->sum('insurance_pay') }}</td>
                        <td>{{ @$result->accidents->sum('company_pay') }}</td>
                        <td>{{ @$result->accidents->sum('fixing_amount') }}</td>
                        <td>{{ @$result->payments->count("car_payment_dates") }}</td>
                        <td>{{ @$result->payments->sum('total_amount')}}</td>
                        <td>{{ @$result->employee_run_trip_buses->count()}}</td>
                        <td>{{ @$total_amount_driver }}</td>
                        <td>{{ @$result->gas->sum('amount')}}</td>
                        <td>{{ @$result->extera_fees->sum('amount')}}</td>
                        <td>{{ @$result->payments->sum('total_amount') + @$result->penelties->sum('amount')  + @$result->extera_fees->sum('amount') + @$result->gas->sum('amount') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>