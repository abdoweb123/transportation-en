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



