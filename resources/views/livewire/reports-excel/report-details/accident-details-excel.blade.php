<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>accident-excel</title>
</head>
<body>
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center" >
            <thead>
            <tr>
                <th>#</th>
                <th>description </th>
                <th>driver </th>
                <th>date </th>
                <th>fixing_amount </th>
                <th>driver_pay </th>
                <th>company_pay </th>
                <th>insurance_pay </th>
            </tr>
            </thead>
            <tbody>
                @if(isset($results->accidents))
                    @foreach ($results->accidents as $index=>$result)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ @$result->description }}</td>
                            <td>{{ @$result->driver->name }}</td>
                            <td>{{ @$result->date }}</td>
                            <td>{{ @$result->fixing_amount }}</td>
                            <td>{{ @$result->driver_pay }}</td>
                            <td>{{ @$result->company_pay }}</td>
                            <td>{{ @$result->insurance_pay }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>