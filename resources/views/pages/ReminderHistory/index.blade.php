@extends('layouts.master')
@section('css')
@section('title')
    Reminder History List
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
   Reminder History List
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

                    <p > <h4 style="text-align:center">Preventive Maintence Reminder</h4> </p>


                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Reminder Id</th>
                                <th>Vendor Name</th>
                                <th>Total Paid</th>
                                <th>Cost Per Day</th>
                                <th>Done</th>
                                <th>Entered By</th>
                                <th>Status</th>
                                <th>Processes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($reminderHistory as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>@isset($item->reminder->id) <a href="{{route('getReminder',$item->reminder->id)}}" style="color:red">{{ $item->reminder->id }}</a> @else _____ @endisset</td>
                                    <td>@isset($item->vendor->name)  {{ $item->vendor->name }} @else _____ @endisset</td>
                                    <td>{{ $item->total_paid }}</td>
                                    <td>{{ $item->cost_per_day  }}</td>
                                    <td>{{$item->done == 1 ? 'Done' : '_____'}}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>{{$item->active == 1 ? 'active' : 'un active'}}</td>
                                    <td>
                                        <a type="button" class="process" style="cursor:pointer" data-toggle="modal"
                                           data-target="#delete{{ $item->id }}" title="{{ trans('main_trans.delete') }}">
                                           <i style="color:red; font-size:18px" class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                <!--  page of delete_modal_office -->
                                @include('pages.ReminderHistory.delete')

                            @endforeach
                        </table>

                       <div> {{$reminderHistory->links('pagination::bootstrap-4')}}</div>

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



