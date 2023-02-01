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
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center" >
            <thead>
            <tr>
                <th>#</th>
                <th style="background-color:black; color:white">{{ trans('main_trans.year') }}  </th>
                <th style="background-color:black; color:white"> {{ trans('main_trans.month') }}</th>
                <th style="background-color:black; color:white">{{ trans('main_trans.client_name') }} </th>
                <th style="background-color:black; color:white">{{ trans('main_trans.contract_start_date') }}  </th>
                <th style="background-color:black; color:white">{{ trans('main_trans.contract_end_date') }} </th>

                <th style="background-color:black; color:white">{{ trans('main_trans.number_of_contracted_lines') }} </th>
                <th style="background-color:blue; color:black">{{ trans('main_trans.bus_type') }}</th>
                <th style="background-color:blue; color:black">{{ trans('main_trans.bus_type') }}</th>
                <th style="background-color:yellow; color:black">{{ trans('main_trans.services_type') }}</th>
                <th style="background-color:yellow; color:black">{{ trans('main_trans.services_value') }}</th>
                <th style="background-color:yellow; color:black">{{ trans('main_trans.number_of_runs') }} </th>
                <th style="background-color:yellow; color:black">{{ trans('main_trans.total_of_revenues') }} </th>
                <th style="background-color:red; color:black">{{ trans('main_trans.count_of_penelties') }} </th>
                <th style="background-color:red; color:black">{{ trans('main_trans.total_of_penelties') }} </th>
                <th style="background-color:green; color:black">{{ trans('main_trans.net_revenue') }}</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($results as $index=>$result)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse(@$result->contract->start_date)->format('Y')}}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse(@$result->contract->start_date)->format('M')}}
                        </td>
                        <td>{{ @$result->company->name }}</td>
                        <td>{{ @$result->contract->start_date }}</td>
                        <td>{{ @$result->contract->end_date }}</td>
                        <td>{{ @$result->contract->cotract_routes_count }}</td>
                        <td>{{ @$result->route->name }}</td>
                        <td>{{ @$result->bus_type->name }}</td>
                        <td>{{ @$result->service_type->name }}</td>
                        <td>{{ @$result->service_value }}</td>
                        <td>{{ @$result->route->employeeRunTrips->count() }}</td>
                        <td>{{ @$result->route->employeeRunTrips->count() * @$result->service_value }}</td>
                        <td>{{ @$result->route->employeeRunTrips->count('penelties_count') }}</td>
                        <td>{{ @$result->route->employeeRunTrips->sum('penelties_sum_amount') }}</td>
                        <td>{{ (@$result->route->employeeRunTrips->count() * @$result->service_value) - @$result->route->employeeRunTrips->sum('penelties_sum_amount') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>