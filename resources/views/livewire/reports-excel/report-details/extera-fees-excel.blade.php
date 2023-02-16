<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>extera-fees-excel</title>
</head>
<body>
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center" >
            <thead>
            <tr>
                <th>#</th>
                <th>description </th>
                <th>type</th>
                <th>amount </th>
                <th>driver </th>
                <th>bus </th>
            </tr>
            </thead>
            <tbody>
                @if(isset($results->extera_fees))
                    @foreach ($results->extera_fees as $index=>$result)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ @$result->description }}</td>
                            <td>{{ @$result->type->name }}</td>
                            <td>{{ @$result->amount }}</td>
                            <td>{{ @$result->driver->name }}</td>
                            <td>{{ @$result->bus->code }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>