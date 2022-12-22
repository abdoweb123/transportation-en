@extends('layouts.master')
@section('css')
@section('title')
    Stations list
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
    Stations list
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

                    {{--  button of add_modal_station  --}}
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('stations_trans.add_station') }}
                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('stations_trans.station_name_ar') }}</th>
                                <th>{{ trans('stations_trans.station_name_en') }}</th>
                                <th>{{ trans('stations_trans.city_name') }}</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Entered By</th>
                                <th>{{ trans('main_trans.processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($stations as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->getTranslation('name', 'ar')  }}</td>
                                    <td>{{ $item->getTranslation('name', 'en')  }}</td>
                                    <td>@isset($item->lat)  {{ $item->lat }} @else _____ @endisset</td>
                                    <td>@isset($item->lon)  {{ $item->lon }} @else _____ @endisset</td>
                                    <td>@isset($item->city->name)  {{ $item->city->name }} @else _____ @endisset</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>
                                        <button type="button" class="process" style="cursor:pointer" data-toggle="modal"
                                                data-target="#editStation{{ $item->id }}" title="{{ trans('main_trans.edit') }}">
                                            <i style="color:#a3a373; font-size:18px" class="fa fa-edit"></i></button>

                                        <button type="button" class="process" style="cursor:pointer" data-toggle="modal"
                                                data-target="#delete{{ $item->id }}" title="{{ trans('main_trans.delete') }}">
                                            <i style="color:red; font-size:18px" class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_station -->
                                @include('pages.Stations.edit')

                                <!--  page of delete_modal_station -->
                                @include('pages.Stations.delete')


                            @endforeach
                        </table>

{{--                        <div> {{$stations->links('pagination::bootstrap-4')}}</div>--}}

                    </div>
                </div>
            </div>
        </div>


       <!--  page of add_modal_station -->
       @include('pages.Stations.create')
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



