@extends('layouts.master')
@section('css')
@section('title')
    Empty Seats Per Bus
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
    i{padding: 0 0 3px;}
    .dataTables_paginate,
    .dataTables_info
    {display:none}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   Empty Seats Per Bus
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
                            <div class="alert alert-{{$msg}}">
                                {{Session::get('alert-'.$msg)}}
                            </div>
                        @endif
                    @endforeach


                    <br><br>

                    <form action="{{route('emptySeatsPerBus')}}" method="get" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Start Date :</label>
                                <input type="date" name="startDate" value="{{@$request->startDate}}" class="form-control">
                            </div>
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">End Date:</label>
                                <input type="date" name="endDate" value="{{@$request->endDate}}" class="form-control">
                            </div>
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Route :</label>
                                <select class="form-control mr-sm-2 p-2" name="route_id">
                                    <option class="custom-select mr-sm-2 p-2" value=" ">--- Choose ---</option>
                                    @foreach($routes as $route)
                                        <option value="{{$route->id}}" {{$route->id == @$request->route_id ? 'selected' : ''}}>{{ $route->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                           
                            <div class="col-3">
                                <label for="name_ar" class="mr-sm-2"> </label>
                                <input type="submit" value="Report" class="btn btn-success form-control" style="background-color: #84ba3f; color: white; font-size: 16px;">
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-4">
                            <form action="{{url('excel/empty/seats/per/bus')}}" method="get" enctype="multipart/form-data">
                                    <input type="hidden" name="startDate" value="{{@$request->startDate}}" class="form-control">
                                    <input type="hidden" name="endDate" value="{{@$request->endDate}}" class="form-control">
                                    <input type="hidden" name="route_id" value="{{@$request->route_id}}" class="form-control">
                                    {{-- <select class="form-control mr-sm-2 p-2" name="route_id">
                                        <option class="custom-select mr-sm-2 p-2" value=" ">--- Choose ---</option>
                                        @foreach($routes as $route)
                                            <option value="{{$route->id}}" {{$route->id == @$request->route_id ? 'selected' : ''}}>{{ $route->name }}</option>
                                        @endforeach
                                    </select> --}}
                                <button class="btn btn-success"><i class="fa fa-download"></i> excel</button>
                            </form>
                            {{-- <a href="{{ url('excel/empty/seats/per/bus') }}" class="btn btn-success"><i class="fa fa-download"></i> Excel</a> --}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
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
                                <th>details</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($buses as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->route_name }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->time }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->booked_seats }}</td>
                                    <td>{{ $item->slug - $item->booked_seats }}</td>
                                    <td>
                                        <form action="{{url('busdetailsbookingrequest')}}" method="get" enctype="multipart/form-data">
                                            <input type="hidden" name="bus_id" value="{{@$item->id}}" class="form-control">
                                            <input type="hidden" name="employee_run_trip_id" value="{{@$item->employee_run_trip_id}}" class="form-control">
                                            <button class="btn btn-primary btn-sm"> details</button>
                                        </form>
                                       
                                    </td>
                                </tr>

                            @endforeach
                        </table>

                        <div> {{$buses->links('pagination::bootstrap-4')}}</div>
                    </div>
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



