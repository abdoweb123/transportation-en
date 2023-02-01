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
                <th>Employee Name</th>
                <th>collection point from</th>
                <th>collection point to</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($results as $index=>$item)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ @$item->myEmployee->name }}</td>
                        <td>{{ @$item->collection_point_from->name }}</td>
                        <td>{{ @$item->collection_point_to->name }}</td>
                        <td>{{ @$item->date }}</td>
                        <td>{{ @$item->time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>