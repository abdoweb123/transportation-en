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
                <th>year  </th>
                <th> month</th>
                <th>client name  </th>
                <th> bus type </th>
                <th> service type </th>
                <th> service value </th>
                <th>number of maintenance </th>
                {{-- <th>total maintenance value </th> --}}
                <th>  count of penelties </th>
                <th>  total of penelties </th>
                <th> Accident Count </th>
                <th> insurance Pay </th>
                <th> Company pay </th>
                <th> fixing Amount </th>
                <th> debt Amount </th>
                <th> total debt </th>
                <th> driver numbers </th>
                <th> total driver amount </th>
                <th> total gas </th>
                <th> extera fees </th>
                <th> total expenses </th>
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