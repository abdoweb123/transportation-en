@extends('layouts.master')
@section('css')
@section('title')
   Employee Run Trip
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
    td{padding: 13px 5px 8px !important;}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   Employee Run Trip
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
{{--                        <div class="col">--}}
{{--                            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">--}}
{{--                                Add Booking--}}
{{--                            </button>--}}
{{--                        </div>--}}
                    </div>



                    <br><br>

                    <div class="table-responsive">
                        <h3 class="text-center" style="font-weight:600; color:#4ba933;">Employee Run Trip ( Result )</h3>
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Route</th>
                                <th>Bus</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Total</th>
                                <th>Entered By</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($employeeRunTrip as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>@isset($item->route->name)  {{ $item->route->name }} @else _______ @endisset</td>
                                    @foreach ($item->bus as $mimiItem)
                                       <td>@isset($mimiItem->code)  {{ $mimiItem->code}} @else _______ @endisset</td>
                                    @endforeach
                                    <td>{{$item->date}}</td>
                                    <td>{{$item->time}}</td>
                                    <td>{{ $item->total }}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>
                                        <a href="{{route('myEmployees.edit',$item->id)}}" class="process">
                                            <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></a>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_office -->
{{--                                @include('pages.bookingRequests.edit')--}}

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


       <!--  page of add_modal_office -->
{{--       @include('pages.bookingRequests.create')--}}
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



