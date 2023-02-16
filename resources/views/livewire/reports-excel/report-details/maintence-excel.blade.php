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
                    <th>Reminder Id</th>
                    <th> gudget type</th>
                    <th>number of gudget </th>
                    <th>gudget brand</th>
                    <th>cost of gudget </th> 
                    <th>fixing cost </th> 
                </tr>
                </thead>
                <tbody>
                    @if(isset($results->reminder_histories))
                        @foreach ($results->reminder_histories as $index=>$result)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $result->reminder_id }}</td>
                            <td>{{ @$result->type->name }}</td>
                            <td>{{ @$result->number_of_gudgets }}</td>
                            <td>{{ @$result->brand->name }}</td>
                            <td>{{ @$result->cost_of_gudget }}</td>
                            <td>{{ @$result->fixing_cost }}</td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
        </table>
    </div>
</body>
</html>