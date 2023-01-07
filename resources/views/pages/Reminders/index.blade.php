@extends('layouts.master')
@section('css')
@section('title')
    Reminders List
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
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   Reminders List
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


                    <a href="{{route('reminders.create')}}" class="button x-small">
                        Add Reminder
                    </a>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Bus Code</th>
                                <th>Category Issue</th>
                                <th>Reminder Days</th>
                                <th>Threeshold Days</th>
                                <th>Start Date</th>
                                <th>Distance</th>
                                <th>Threeshold Distance</th>
                                <th>Task</th>
                                <th>Status</th>
                                <th>Entered By</th>
                                <th>Processes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['reminders'] as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>@isset($item->bus->code)  {{ $item->bus->code }} @else _____ @endisset</td>
                                    <td>@isset($item->issue->category->name)  {{ $item->issue->category->name }} @else _____ @endisset</td>
                                    <td>{{ $item->reminder_days}}</td>
                                    <td>{{ $item->threeshold_days}}</td>
                                    <td>{{ $item->start_date}}</td>
                                    <td>{{ $item->distance}}</td>
                                    <td>{{ $item->threeshold_distance}}</td>
                                    <td>{{ $item->task}}</td>
                                    <td>{{ $item->active == 1 ? 'active' : 'un active'}}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>
                                        <a href="{{route('reminders.edit',$item->id)}}" class="process">
                                           <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></a>

                                        <button type="button" class="process" data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">
                                           <i style="color:red; font-size:18px;" class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!--  page of delete_modal_city -->
                                @include('pages.Reminders.delete')

                            @endforeach
                        </table>

{{--                        <div> {{$data['myEmployees']->links('pagination::bootstrap-4')}}</div>--}}
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




