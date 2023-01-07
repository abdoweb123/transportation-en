@extends('layouts.master')
@section('css')
@section('title')
   Booking Requests
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
        padding: 3px 2px 0px 4px;
        margin-left: 5px;
    }
    td{padding: 13px 5px 8px !important;}

</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Booking Requests
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
                            <a href="{{route('getAddBooking')}}" class="button x-small">
                                Add Booking
                            </a>
                            <a href="{{route('bookingRequestsData')}}" class="button x-small">
                                Next
                            </a>
                        </div>

                        <div class="col text-right">
                            <form action="{{route('import.excelEmployee')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="excel" class="form-control" style="width:50%; display:inline-block; padding:11px" required>
                                <button class="button x-small">
                                    <i class="ti-import"></i>  Import Excel Sheet
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="line mb-3" style="border-bottom: 1px solid #e9ecef; padding-bottom:30px">
                    </div>
                    <form action="{{route('bookingRequests.index')}}" method="get" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Start Date :</label>
                                <input type="date" name="startDate" value="{{$request->startDate}}" class="form-control">
                            </div>
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">End Date:</label>
                                <input type="date" name="endDate" value="{{$request->endDate}}" class="form-control">
                            </div>

                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Start Time :</label>
                                <input type="time" name="startTime" value="{{$request->startTime}}" class="form-control">
                            </div>
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">End Time :</label>
                                <input type="time" name="endTime" value="{{$request->endTime}}" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Route :</label>
                                <select class="form-control mr-sm-2 p-2" name="route_id">
                                    <option class="custom-select mr-sm-2 p-2" value=" ">--- Choose ---</option>
                                    @foreach($routes as $route)
                                        <option value="{{$route->id}}" {{$route->id == $request->route_id ? 'selected' : ''}}>{{ $route->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Collection Point From :</label>
                                <select class="form-control mr-sm-2 p-2" name="collection_point_from_id">
                                    <option class="custom-select mr-sm-2 p-2" value=" ">--- Choose ---</option>
                                    @foreach($stations as $station)
                                        <option value="{{$station->id}}" {{$station->id == $request->collection_point_from_id ? 'selected' : ''}}>{{ $station->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Collection Point To :</label>
                                <select class="form-control mr-sm-2 p-2" name="collection_point_to_id">
                                    <option class="custom-select mr-sm-2 p-2" value=" ">--- Choose ---</option>
                                    @foreach($stations as $station)
                                        <option value="{{$station->id}}" {{$station->id == $request->collection_point_to_id ? 'selected' : ''}}>{{ $station->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                                <div class="col-3">
                                    <label for="name_ar" class="mr-sm-2"> </label>
                                    <input type="submit" value="Report" class="btn btn-success form-control" style="background-color: #84ba3f; color: white; font-size: 16px;">
                                </div>
                            </div>
                    </form>


                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Collection Point From</th>
                                <th>Collection Point To</th>
                                <th>Route</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Entered By</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bookingRequests as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>@isset($item->collection_point_from->name)  {{ $item->collection_point_from->name }} @else _______ @endisset</td>
                                    <td>@isset($item->collection_point_to->name)  {{ $item->collection_point_to->name }} @else _______ @endisset</td>
                                    <td>@isset($item->route->name)  {{ $item->route->name }} @else _______ @endisset</td>
                                    <td>{{$item->date}}</td>
                                    <td>{{$item->time}}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>
                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#edit{{ $item->id }}" title="حذف">
                                            <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></button>

                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">
                                            <i style="color:red; font-size:18px;" class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_office -->
                                @include('pages.bookingRequests.editBookingRequest')

                                <!--  page of delete_modal_office -->
                                @include('pages.bookingRequests.delete')


                                <!--  page of show_modal_office -->
{{--                                @include('pages.bookingRequests.show')--}}

                            @endforeach
                        </table>

{{--                        <div> {{$bookingRequests->links('pagination::bootstrap-4')}}</div>--}}

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
    </script>
@endsection



