@extends('layouts.master')
@section('css')
@section('title')
   Booking Requests Data
@stop

<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
    .process
    {
        cursor:pointer;
        background-color:white;
        border-radius:3px;
        border: 1px solid #dddd;
        padding: 5px 3px 0 4px;
        margin-left: 2px;
    }
    td{padding: 13px 5px 8px !important;}
    .dataTables_paginate,
    .dataTables_info,
    .dataTables_length,
    #datatable_filter
    {
        display:none
    }
    .table-responsive
    {
        margin-bottom: 50px;
    }

</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Booking Requests Data
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    @foreach(['danger','warning','success','info'] as $msg)
                        @if(Session::has('alert-'.$msg))
                            <div class="alert alert-{{$msg}} messages">
                                {{Session::get('alert-'.$msg)}}
                            </div>
                        @endif
                    @endforeach

                    {{--  button of add_modal_office  --}}
                    <div class="row">
                        <div class="col">
                            <a href="{{route('employeeRunTrip')}}" class="button x-small">
                                Next
                            </a>
                        </div>
                    </div>



                    <br><br>

                    <div class="table-responsive">
                        <h3 class="text-center">New Stations</h3>
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Entered By</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['stations'] as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{$item->name}}</td>
                                    <td>@isset($item->city->name)  {{ $item->city->name }} @else _______ @endisset</td>
                                    <td>@isset($item->lat)  {{ $item->lat }} @else _______ @endisset</td>
                                    <td>@isset($item->lon)  {{ $item->lon }} @else _______ @endisset</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>
                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#editStation{{ $item->id }}" title="حذف">
                                            <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></button>

                                    </td>
                                </tr>

                            @include('pages.Stations.edit')

                            @endforeach
                        </table>
                    </div>
                    <div class="table-responsive">
                        <h3 class="text-center mb-4">New Routes</h3>
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Entered By</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['routes'] as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{$item->name}}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>
                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#editRoute{{ $item->id }}" title="حذف">
                                            <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></button>
                                    </td>
                                </tr>

                            @include('pages.Routes.edit')

                            @endforeach
                        </table>
                    </div>
                    <div class="table-responsive">
                        <h3 class="text-center mb-4">New Route Stations</h3>
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Route</th>
                                <th>Entered By</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['routeStations'] as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{$item->station_name}}</td>
                                    <td>@isset($item->route->name)  {{ $item->route->name }} @else _______ @endisset</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>
                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#editRouteStation{{ $item->id }}" title="حذف">
                                            <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></button>
                                    </td>
                                </tr>

                            @include('pages.RouteStation.edit')

                            @endforeach
                        </table>
                    </div>
                    <div class="table-responsive">
                        <h3 class="text-center mb-4">New Employees</h3>
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Oracle_id</th>
                                <th>Name</th>
                                <th>Collection Point</th>
                                <th>Gender</th>
                                <th>Entered By</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['employees'] as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{$item->oracle_id}}</td>
                                    <td>@isset($item->name)  {{ $item->name }} @else _______ @endisset</td>
                                    <td>@isset($item->collectionPoint->name)  {{ $item->collectionPoint->name }} @else _______ @endisset</td>
                                    <td>{{ $item->gender == 1 ? 'Male' : 'Female'}}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>
                                        <a href="{{route('myEmployees.edit',$item->id)}}" class="process">
                                            <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>


       <!--  page of add_modal_office -->
{{--       @include('pages.bookingRequests.create')--}}
    </div>



@endsection
@section('js')
    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function(){
            $(".messages").delay(5000).slideUp(300);
        });
    </script>
@endsection



