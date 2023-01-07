@extends('layouts.master')
@section('css')
@section('title')
  Add Booking
@stop

<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
    td{padding: 13px 5px 8px !important;}
    .dataTables_paginate,
    .dataTables_info
    {display:none}

</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Add Booking
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



                    <form action="{{route('searchEmployeeRunTrip')}}" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Route :</label>
                                <select class="form-control mr-sm-2 p-2" name="route_id" required>
                                    <option class="custom-select mr-sm-2 p-2" value=" ">--- Choose ---</option>
                                    @foreach($routes as $route)
                                        <option value="{{$route->id}}" @isset($request){{$route->id == $request->route_id ? 'selected' : ''}}@endisset>{{ $route->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Bus :</label>
                                <select class="form-control mr-sm-2 p-2" name="bus_id" required>
                                    <option class="custom-select mr-sm-2 p-2" value=" ">--- Choose ---</option>
                                    @foreach($buses as $bus)
                                        <option value="{{$bus->id}}" @isset($request){{$bus->id == $request->bus_id ? 'selected' : ''}}@endisset>{{ $bus->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Date :</label>
                                <input type="date" name="date" @isset($request)value="{{$request->date}}" @endisset class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Time :</label>
                                <input type="time" name="time" @isset($request)value="{{$request->time}}" @endisset class="form-control" style="padding:11px" required>
                            </div>
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Collection Point From :</label>
                                <select class="form-control mr-sm-2 p-2 stationRoute" name="collection_point_from_id" required>

                                </select>
                            </div>
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Collection Point To :</label>
                                <select class="form-control mr-sm-2 p-2 stationRoute" name="collection_point_to_id" required>

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" style="margin-bottom: 15px;">
                                <label for="name_ar" class="mr-sm-2 d-block">Type :</label>
                                <div class="row form-control" style="display:flex; margin-left:0">
                                    <div class="col">
                                        <input type="radio" name="type" value="1"> Door To Door
                                    </div>
                                    <div class="col">
                                        <input type="radio" name="type" value="2"> Not Door To Door
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="name_ar" class="mr-sm-2"> </label>
                                <input type="submit" value="Search" class="btn btn-success form-control" style="background-color:#84ba3f; color:white; font-size:16px; padding:10px; margin-bottom:-35px;">
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive mt-3">
                        <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Route</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Bus Code</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            @isset($request)
                                <tbody>
                                @foreach ($newBookings as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>@isset($item->route_name)  {{ $item->route_name }} @else _____ @endisset</td>
                                        <td>{{ $item->date  }}</td>
                                        <td>{{ $item->time  }}</td>
                                        <td>{{ $item->bus_code }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                               Book
                                            </button>
                                        </td>
                                    </tr>
                                    <!--  page of add_modal_office -->
                                    @include('pages.bookingRequests.createBookingRequest')

                                @endforeach
                                @endisset
                                </tbody>
                        </table>
                        @isset($request)
                            <div>{{$newBookings->links('pagination::bootstrap-4')}}</div>
                        @endisset
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
            $(".messages").delay(5000).slideUp(300);
        });


        $(document).ready(function () {
            $('select[name="route_id"]').on('change', function () {
                var route_id = $(this).val();
                if (route_id) {
                    $.ajax({
                        url: "{{ URL::to('getRouteStations') }}/" + route_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('.stationRoute').empty();
                            $.each(data, function (key, value) {
                                $('select[name="collection_point_from_id"]').append('<option value="' + key + '">' + value + '</option>');
                                $('select[name="collection_point_to_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection



