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
                <th>bus </th>
                <th>bus type </th>
                <th>kilometer </th>
                <th>driver </th>
                {{-- <th>route </th> --}}
                <th>Gas Amount </th>
                <th>paid amount </th>
                <th>distance</th>
                <th>leter/km </th>
                <th>paid/km </th>
            </tr>
            </thead>
            <tbody>
                @if(isset($results->gas))
                    @foreach ($results->gas as $index=>$result)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ @$result->bus->code }}</td>
                            <td>{{ @$result->bus_type->name }}</td>
                            <td>{{ @$result->kilometer }}</td>
                            <td>{{ @$result->driver->name }}</td>
                            {{-- <td>{{ @$result->route->name }}</td> --}}
                            <td>{{ @$result->gas_amount }}</td>
                            <td>{{ @$result->paid_amount }}</td>
                            <td>{{ @$result->distance }}</td>
                            <td>{{ @$result->leter_k }}</td>
                            <td>{{ @$result->amount_k }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>