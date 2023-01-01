@extends('layouts.master')
@section('css')
@section('title')
    Names Of Employees Per Bus
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
    i{padding: 0 0 3px;}

    .process
    {
        cursor:pointer;
        background-color:white;
        border-radius:3px;
        border: 1px solid #dddd;
        padding: 3px 2px 0px 4px;
        margin-left: 5px;
    }

    .dataTables_paginate,
    .dataTables_info
    {display:none}

    /*.dataTables_paginate,*/
    /*.dataTables_info,*/
    /*.dataTables_length,*/
    /*#datatable_filter*/
    /*{*/
    /*    display:none*/
    /*}*/
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   Names Of Employees Per Bus
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            @isset($runTrips)
                <h4> Bus Code :  {{$searchedBus->code}}</h4>
            @endisset
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
                            <div class="alert alert-{{$msg}}">
                                {{Session::get('alert-'.$msg)}}
                            </div>
                        @endif
                    @endforeach

                    <div class="row @isset($runTrips) @else  mb-3 @endisset" style=" @isset($runTrips) @else border-bottom: 1px solid #e9ecef; @endisset">
                        @isset($runTrips)
{{--                        <div class="col-6 text-left mb-3">--}}
{{--                            <form action="{{route('employeesNamesPerBus')}}" method="get" enctype="multipart/form-data">--}}
{{--                                @csrf--}}
{{--                                <select name="searchTripDataByBus_id" class="form-control" style="width:30%; display:inline-block; padding:11px" required>--}}
{{--                                    <option value=" ">-- Choose RunTrip --</option>--}}
{{--                                    @foreach($buses as $bus)--}}
{{--                                        <option value="{{$bus->id}}">{{$bus->code}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <button class="button x-small">--}}
{{--                                    <i class="ti-search"></i> Search for Employees--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                        @else
                        <div class="col-6 text-left mb-3">
                            <form action="{{route('getRunTripByBus_id')}}" method="get" enctype="multipart/form-data">
                                @csrf
                                <select name="searchTripDataByBus_id" class="form-control" style="width:30%; display:inline-block; padding:11px" required>
                                    <option value=" ">-- Choose Bus --</option>
                                    @foreach($buses as $bus)
                                        <option value="{{$bus->id}}" @isset($searchedBus){{$searchedBus->id == $bus->id ? 'selected' : ''}} @endisset>{{$bus->code}}</option>
                                    @endforeach
                                </select>
                                <button class="button x-small">
                                    <i class="ti-search"></i>  Search for Run Trip
                                </button>
                            </form>
                        </div>
                        @endisset
                    </div>
                    @isset($runTrips)
                    <div class="table-responsive">
                        <h3 class="text-center" style="margin-top:15px; margin-bottom:0;">Run Trips</h3>
                        <table id="datatable" class="table table-hover table-sm table-bordered p-0 mb-4" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Route</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($runTrips as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->route_name }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->time }}</td>
                                    <td>
                                        <form action="{{route('getRunTripByBus_id')}}">
                                            @csrf
                                            <input type="hidden" name="searchedBus" value="{{$searchedBus->id}}">
                                            <input type="hidden" name="runTrip" value="{{$item->id}}">
                                            <input type="hidden" name="date" value="{{$item->date}}">
                                            <input type="hidden" name="time" value="{{$item->time}}">
                                            <input type="submit" value="عرض الموظفين" style="cursor:pointer; background:none; border:none; color:palevioletred;">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    @endisset
                    @isset($employeesOfTrip)
                    <div class="table-responsive">
                        <h3 class="text-center mb-3">Employees of Run Trip</h3>
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Oracle Id</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Gender</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($employeesOfTrip as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->oracle_id }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->gender == 1 ? 'Male' : 'Female'}}</td>
                                </tr>

                            @endforeach
                        </table>
                    </div>
                    @endisset
                        {{--                        <div> {{$employees->links('pagination::bootstrap-4')}}</div>--}}

                </div>
            </div>
        </div>
    </div>



@endsection
@section('js')
    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function(){
            $(".alert").delay(5000).slideUp(300);
        });
    </script>
@endsection



