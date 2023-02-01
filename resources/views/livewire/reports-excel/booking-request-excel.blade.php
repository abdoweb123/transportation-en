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
                <th>employee</th>
                <th>Collection Point From</th>
                <th>Collection Point To</th>
                <th>Route</th>
                <th>Date</th>
                <th>Time</th>
                <th>Entered By</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($results as $index=>$item)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $item->myEmployee->name }}</td>
                        <td>@isset($item->collection_point_from->name)  {{ $item->collection_point_from->name }} @else _______ @endisset</td>
                        <td>@isset($item->collection_point_to->name)  {{ $item->collection_point_to->name }} @else _______ @endisset</td>
                        <td>@isset($item->route->name)  {{ $item->route->name }} @else _______ @endisset</td>
                        <td>{{$item->date}}</td>
                        <td>{{$item->time}}</td>
                        <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>