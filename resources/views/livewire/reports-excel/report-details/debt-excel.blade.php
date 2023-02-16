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
                    <th>date </th>
                    <th>amount </th>
                    <th>paid </th>
                </tr>
                </thead>
                <tbody>
                    @if(isset($results->payment_dates))
                        @foreach ($results->payment_dates as $index=>$result)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ @$result->date }}</td>
                                <td>{{ @$result->amount }}</td>
                                <td>{{ (@$result->paid == 'N' ?'no' : 'Y') }}</td>
                            </tr>
                        @endforeach
                    @endif
            </tbody>
        </table>
    </div>
</body>
</html>