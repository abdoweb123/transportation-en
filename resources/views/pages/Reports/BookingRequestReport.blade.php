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

                      
                    <div class="line mb-3" style="border-bottom: 1px solid #e9ecef; padding-bottom:30px">
                    </div>
                    <form action="{{route('bookingrequest-report')}}" method="get" enctype="multipart/form-data">
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
 
                    <div class="row">
                        <div class="col-md-4">
                            <form action="{{url('bookingrequest-report-excel')}}" method="get" enctype="multipart/form-data">
                                <input type="hidden" name="startDate" value="{{$request->startDate}}" class="form-control">
                                <input type="hidden" name="endDate" value="{{$request->endDate}}" class="form-control">
                                <input type="hidden" name="startTime" value="{{$request->startTime}}" class="form-control">
                                <input type="hidden" name="endTime" value="{{$request->endTime}}" class="form-control">
                                <input type="hidden" name="route_id" value="{{$request->route_id}}" class="form-control">
                                <input type="hidden" name="collection_point_from_id" value="{{$request->collection_point_from_id}}" class="form-control">
                                <input type="hidden" name="collection_point_to_id" value="{{$request->collection_point_to_id}}" class="form-control">
                                <button class="btn btn-success"><i class="fa fa-download"></i> excel</button>
                            </form>
                        </div>
                    </div>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
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
                            @foreach ($bookingRequests as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->myEmployee->name }}</td>
                                    <td>@isset($item->collection_point_from->name)  {{ $item->collection_point_from->name }} @else _______ @endisset</td>
                                    <td>@isset($item->collection_point_to->name)  {{ $item->collection_point_to->name }} @else _______ @endisset</td>
                                    <td>@isset($item->route->name)  {{ $item->route->name }} @else _______ @endisset</td>
                                    <td>{{$item->date}}</td>
                                    <td>{{$item->time}}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                </tr>
                            @endforeach
                        </table>

                       <div> {{$bookingRequests->links('pagination::bootstrap-4')}}</div>

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



