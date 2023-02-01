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

    .nttable {
    padding: 30px 0;
}

.nttable .parent .second {
    border: 1px solid #000;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}

.nttable .parent .second .bord {
    border-left: 1px solid #000;
}

.nttable .parent .second .box {
    text-align: center;
    padding: 5px 30px;
    width: 50%;
}

.nttable .parent .second .box p {
    margin-bottom: 0;
    font-size: 19px;
}
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
                    <div class="nttable">
                        <div class="container">
                            <div class="row" style="text-align: start">
                                <div class="col-md-4 col-sm-6 ">
                                    <div class="parent">
                                        <div class="second">
                                            <div class="box bord">
                                                <p>
                                                    company
                                                </p>
                                            </div>
                                            <div class="box">
                                                <p>
                                                    {{ @$employee_run_trip->company->name }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="second">
                                            <div class="box bord">
                                                <p>
                                                    route
                                                </p>
                                            </div>
                                            <div class="box">
                                                <p>
                                                    {{ @$employee_run_trip->route->name }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="second">
                                            <div class="box bord">
                                                <p>
                                                    date
                                                </p>
                                            </div>
                                            <div class="box">
                                                <p>
                                                    {{ @$employee_run_trip->date }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="second">
                                            <div class="box bord">
                                                <p>
                                                    time
                                                </p>
                                            </div>
                                            <div class="box">
                                                <p>
                                                    {{ @$employee_run_trip->time }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <form action="{{url('BusdetailsbookingrequestExcel')}}" method="get" enctype="multipart/form-data">
                                        <input type="hidden" name="bus_id" value="{{@$bus_id}}" class="form-control">
                                        <input type="hidden" name="employeeRunTrip_id" value="{{@$employee_run_trip_id}}" class="form-control">
                                        <button class="btn btn-success"><i class="fa fa-download"></i> excel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-md-4">
                            <form action="{{url('BusdetailsbookingrequestExcel')}}" method="get" enctype="multipart/form-data">
                                <input type="hidden" name="bus_id" value="{{@$bus_id}}" class="form-control">
                                <input type="hidden" name="employeeRunTrip_id" value="{{@$employee_run_trip_id}}" class="form-control">
                                <button class="btn btn-success"><i class="fa fa-download"></i> excel</button>
                            </form>
                        </div>
                    </div> --}}
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>collection point from</th>
                                <th>collection point to</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($results as $item)
                                <tr>
                                    <td>{{ @$loop->index+1 }}</td>
                                    <td>{{ @$item->myEmployee->name }}</td>
                                    <td>{{ @$item->collection_point_from->name }}</td>
                                    <td>{{ @$item->collection_point_to->name }}</td>
                                    <td>{{ @$item->date }}</td>
                                    <td>{{ @$item->time }}</td>
                                </tr>

                            @endforeach
                        </table>

                        <div> {{$results->links('pagination::bootstrap-4')}}</div>
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



