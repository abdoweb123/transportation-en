<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>empty-seats-per-car-excel</title>
</head>
<body>
    <div class="table-responsive">
        <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center" >
            <thead>
            <tr>
                <th>#</th>
                <th>Bus Code</th>
                <th>Route</th>
                <th>Date</th>
                <th>Time</th>
                <th>Bus Slug</th>
                <th>Booked Seats</th>
                <th>Empty Seats</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($results as $index=>$item)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->route_name }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->time }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->booked_seats }}</td>
                        <td>{{ $item->slug - $item->booked_seats }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>