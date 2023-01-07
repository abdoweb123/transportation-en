@extends('layouts.master')
@section('css')
@section('title')
  Swap Bus
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
    Swap Bus
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



                    <div class="row">
                        <div class="col-md-6 bus_design my-5 mx-auto text-center overflow-auto">
                            <h3 style="font-family: 'Cairo', sans-serif;">Old Booking Request</h3>
                            <span style="border-bottom: 1px solid #ddd;padding: 5px;display: block;margin: auto;width: 68%; margin-bottom: 5px;"></span>
                            <div class="row" style="width:70%; margin: auto;text-align:start; font-size:15px; font-weight: 700;">
                                <div class="col-6"><span>Bus Code : {{$bus->code}}</span></div>
                                <div class="col-6 text-left"><span style="margin-left:40px">Bus Type : {{$busType->name}}</span></div>
                            </div>
                            <div class="row" style="width:70%; margin: auto;text-align:start; font-size:15px; font-weight: 700;">
                                <div class="col-6"><span>Booking Bus : {{$employeeRunTrip->total}}</span></div>
                                <div class="col-6 text-left"><span style="margin-left:40px">Empty Seats : {{$busType->slug - $employeeRunTrip->total}}</span></div>
                            </div>

                            <div class="bus_box row mx-auto my-3" style="background-color:#ddd; width:{{$busType->width*100 + $busType->width*20}}px; height:{{$busType->length*90 + $busType->length*20}}px;">
                            <?php  $i=0; ?>
                                @foreach($busType->seats as $item)
                                    <div id="select-{{$item->name}}"
                                         style="
                                         @if($i<$employeeRunTrip->total && $item->type !== 3 && $item->type !== 2)
                                             background-color:red !important; color:white;
                                         <?php  $i++; ?>
                                         @endif

                                         @if($item->type == 3) visibility:hidden; color:white;
                                         @elseif($item->type == 2) visibility:hidden; color:white;
                                         @else background-color:beige;  @endif width:100px; height:90px; padding:37px 0; margin:10px; text-align:center; position:relative">
                                        <a>
                                            {{$item->name}}
                                        </a>
                                    </div>
                                @endforeach
{{--                                        <input type="hidden" value="{{$tripData->id}}" name="tripData_id">--}}
                            </div>
                        </div>
                        <div class="col-md-6" style="border-left:3px solid #ddd">
                            <div class="my-5 mx-auto overflow-auto">
                                <h3 class="text-center" style="font-family: 'Cairo', sans-serif;">New Booking Request</h3>
                                <span class="text-center" style="border-bottom: 1px solid #ddd;padding: 5px;display: block;margin: auto; margin-bottom: 5px;"></span>

                                <form action="{{route('swapBus',[$booking->id,$employee_id])}}" method="get" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="name_ar" class="mr-sm-2">Route :</label>
                                            <select class="form-control mr-sm-2 p-2" name="route_id">
                                                <option class="custom-select mr-sm-2 p-2" value=" ">--- Choose ---</option>
                                                @foreach($routes as $route)
                                                    <option value="{{$route->id}}" @isset($request){{$route->id == $request->route_id ? 'selected' : ''}}@endisset>{{ $route->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="name_ar" class="mr-sm-2">Bus :</label>
                                            <select class="form-control mr-sm-2 p-2" name="bus_id">
                                                <option class="custom-select mr-sm-2 p-2" value=" ">--- Choose ---</option>
                                                @foreach($buses as $bus)
                                                    <option value="{{$bus->id}}" @isset($request){{$bus->id == $request->bus_id ? 'selected' : ''}}@endisset>{{ $bus->code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="name_ar" class="mr-sm-2">Date :</label>
                                            <input type="date" name="date" @isset($request)value="{{$request->date}}" @endisset class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="name_ar" class="mr-sm-2">Time :</label>
                                            <input type="time" name="time" @isset($request)value="{{$request->time}}" @endisset class="form-control" style="padding:11px">
                                        </div>
                                        <div class="col">
                                            <label for="name_ar" class="mr-sm-2">Collection Point From :</label>
                                            <select class="form-control mr-sm-2 p-2 stationRoute" name="collection_point_from_id">

                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="name_ar" class="mr-sm-2">Collection Point To :</label>
                                            <select class="form-control mr-sm-2 p-2 stationRoute" name="collection_point_to_id">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8" style="margin-bottom: 15px;">
                                            <label for="name_ar" class="mr-sm-2 d-block">Type :</label>
                                            <div class="row form-control" style="display:flex">
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


                                <div class="table-responsive">
                                    <table class="table table-hover table-sm table-bordered p-0" data-page-length="50"
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
                                                    <td>{{ $item->bus_code  }}</td>
                                                    <td>
                                                        <form action="{{route('swapBusFinal')}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="oldBooking_id" value="{{$booking->id}}">
                                                            <input type="hidden" name="newEmployeeRunTrip_id" value="{{$item->id}}">
                                                            <input type="hidden" name="oldEmployeeRunTrip_id" value="{{$employeeRunTrip->id}}">
                                                            <input type="hidden" name="employee_id" value="{{$employee_id}}">
                                                            <input type="hidden" name="route_id" value="{{$request->route_id}}">
                                                            <input type="hidden" name="bus_id" value="{{$request->bus_id}}">
                                                            <input type="hidden" name="date" value="{{$request->date}}">
                                                            <input type="hidden" name="time" value="{{$request->time}}">
                                                            <input type="hidden" name="collection_point_from_id" value="{{$request->collection_point_from_id}}">
                                                            <input type="hidden" name="collection_point_to_id" value="{{$request->collection_point_to_id}}">
                                                            <input type="hidden" name="type" value="{{$request->type}}">

                                                            <button type="submit" class="btn btn-primary text-white">
                                                                Choose
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

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
            </div>
        </div>


       <!--  page of add_modal_office -->
{{--       @include('pages.bookingRequests.createBookingRequest')--}}
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



