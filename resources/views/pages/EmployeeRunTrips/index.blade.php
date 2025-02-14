@extends('layouts.master')
@section('css')
@section('title')
    Employee Run Trips List
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
    i{padding: 0 0 3px;}
</style>


@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   Employee Run Trips List
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


                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Route</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Bus</th>
                                <th>Total</th>
                                <th>Driver</th>
                                <th>Entered By</th>
                                <th>Processes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($employeeRunTrips as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>@isset($item->route->name)  {{ $item->route->name }} @else _____ @endisset</td>
                                    <td>{{ $item->date  }}</td>
                                    <td>{{ $item->time  }}</td>
                                    @foreach($item->bus as $bus)
                                    <td>@isset($bus->code)  {{$bus->code }} @else _____ @endisset</td>
                                @endforeach
{{--                                    <td>{{ $item->tatol }}</td>--}}
                                    <td>{{ $item->total }}</td>
                                    <td>@isset($item->driver->name)  {{ $item->driver->name }} @else _____ @endisset</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>
                                        <a type="button" class="process" style="cursor:pointer" data-toggle="modal"
                                           data-target="#editEmployeeRunTrip{{ $item->id }}" title="{{ trans('main_trans.edit') }}">
                                           <i style="color:#a3a373; font-size:18px" class="fa fa-edit"></i></a>

                                        <a type="button" class="process" style="cursor:pointer" data-toggle="modal"
                                           data-target="#delete{{ $item->id }}" title="{{ trans('main_trans.delete') }}">
                                           <i style="color:red; font-size:18px" class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_office -->
                                @include('pages.EmployeeRunTrips.edit')

                                <!--  page of delete_modal_office -->
                                @include('pages.EmployeeRunTrips.delete')


                                <!--  page of show_modal_office -->
{{--                                @include('pages.Offices.show')--}}

                            @endforeach
                        </table>

                       <div> {{$employeeRunTrips->links('pagination::bootstrap-4')}}</div>

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



