@extends('layouts.master')
@section('css')
@section('title')
  Assign Employee
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
    Assign Employee
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

                    <div class="line mb-3" style="border-bottom: 1px solid #e9ecef; padding-bottom:30px">
                    </div>
                    <form action="{{route('getAssignEmployee')}}" method="get" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Oracle_id :</label>
                                <input type="text" name="oracle_id" @isset($request)value="{{$request->oracle_id}}" @endisset class="form-control">
                            </div>
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">Date :</label>
                                <input type="date" name="date" @isset($request)value="{{$request->date}}" @endisset class="form-control">
                            </div>
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2 mb-4"> </label>
                                <input type="submit" value="Search" class="btn btn-success form-control" style="background-color: #84ba3f; color: white; font-size: 16px;">
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
                                <th>Employee Name</th>
                                <th>Oracle_id</th>
                                <th>Route</th>
                                <th>Bus Code</th>
                                <th>Bus Type</th>
                                <th>Time</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            @isset($request)
                            <tbody>
                            @foreach ($employeeBookings as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>@isset($item->myEmployee->name)  {{ $item->myEmployee->name }} @else _______ @endisset</td>
                                    <td>@isset($item->myEmployee->oracle_id)  {{ $item->myEmployee->oracle_id }} @else _______ @endisset</td>
                                    <td>@isset($item->route->name)  {{ $item->route->name }} @else _______ @endisset</td>
                                    <td>@isset($item->bus->code)  {{ $item->bus->code }} @else _______ @endisset</td>
                                    <td>@isset($item->bus->busType->name)  {{ $item->bus->busType->name }} @else _______ @endisset</td>
                                    <td>{{$item->time}}</td>
                                    <td>
                                        <a href="{{route('swapBus',[$item->id,$employee->id])}}" class="btn btn-success text-white">
                                            <i style="color:white; font-size:18px;" class="fa fa-send"></i>&nbsp; Swap
                                        </a>
                                    </td>
                                </tr>

                            @endforeach
                            @endisset
                            </tbody>
                        </table>
                        @isset($request)
                            <div>{{$employeeBookings->links('pagination::bootstrap-4')}}</div>
                        @endisset
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
    </script>
@endsection



