<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>penalties-excel</title>
</head>
<body>
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center" >
            <thead>
            <tr>
                <th>#</th>
                <th>Description </th>
                <th>Penelty Type </th>
                <th> Driver </th>
                <th> date </th>
                <th>Amount</th>
                <th>Driver Pay</th>
                <th>Company Pay</th>
            </tr>
            </thead>
            <tbody>
                @if(isset($results->penelties))
                    @foreach ($results->penelties as $index=>$result)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ @$result->description }}</td>
                            <td>{{ @$result->penelty_type->name }}</td>
                            <td>{{ @$result->driver->name }}</td>
                            <td>{{ @$result->date }}</td>
                            <td>{{ @$result->amount }}</td>
                            <td>{{ @$result->driver_pay }}</td>
                            <td>{{ @$result->company_pay }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>