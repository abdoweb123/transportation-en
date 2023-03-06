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
        style="text-align: center">
     <thead>
     <tr>
         <th>#</th>
         <th>{{ trans('stations_trans.station_name_ar') }}</th>
         <th>{{ trans('stations_trans.station_name_en') }}</th>
         <th>{{ trans('stations_trans.city_name') }}</th>
         <th>Latitude</th>
         <th>Longitude</th>
         <th>Entered By</th>
         <th> Status </th>
         <th>{{ trans('main_trans.processes') }}</th>
     </tr>
     </thead>
     <tbody>
     @foreach ($results as $item)
         <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->getTranslation('name', 'ar')  }}</td>
            <td>{{ $item->getTranslation('name', 'name_en')  }}</td>
            <td>@isset($item->city->name)  {{ $item->city->name }} @else _____ @endisset</td>
            <td>@isset($item->lat)  {{ $item->lat }} @else _____ @endisset</td>
            <td>@isset($item->lon)  {{ $item->lon }} @else _____ @endisset</td>
            <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
         </tr>


     @endforeach
 </table>
    </div>
</body>
</html>