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
                <th>year  </th>
                <th> month</th>
                <th>client name  </th>
                <th> contract start date  </th>
                <th> contract end date </th>
                <th> number of contracted lines </th>
                <th>  line name </th>
                <th>  bus type </th>
                <th>  services type </th>
                <th>  services value </th>
                <th>  Number of runs </th>
                <th>  total of revenues </th>
                <th>  count of penelties </th>
                <th>  total of penelties </th>
                <th>  Net revenue   </th>
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