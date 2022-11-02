@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('cities_trans.title_page') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.citys') }}
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

                    {{--  button of add_modal_city  --}}
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('cities_trans.add_city') }}
                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('cities_trans.city_name_ar') }}</th>
                                <th>{{ trans('cities_trans.city_name_en') }}</th>
                                <th>{{ trans('main_trans.processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($cities as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->getTranslation('name', 'ar')  }}</td>
                                    <td>{{ $item->getTranslation('name', 'en')  }}</td>
                                    <td>
                                        <div class="dropdown show">
                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ trans('main_trans.processes') }}
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a type="button" class="dropdown-item" style="cursor:pointer" data-toggle="modal"
                                                   data-target="#edit{{ $item->id }}" title="{{ trans('main_trans.edit') }}">
                                                   <i style="color:#a3a373" class="fa fa-edit"></i>&nbsp; {{trans('cities_trans.edit')}}</a>

                                                <a type="button" class="dropdown-item" style="cursor:pointer" data-toggle="modal"
                                                   data-target="#delete{{ $item->id }}" title="{{ trans('cities_trans.delete') }}">
                                                   <i style="color:red" class="fa fa-trash"></i>&nbsp; {{trans('main_trans.delete')}}</a>

                                                <a type="button" class="dropdown-item" style="cursor:pointer" data-toggle="modal"
                                                   data-target="#show{{ $item->id }}" title="{{ trans('cities_trans.show') }}">
                                                    <i style="color:green" class="fa fa-eye"></i>&nbsp; {{trans('main_trans.show')}}</a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_city -->
                                @include('pages.Cities.edit')

                                <!--  page of delete_modal_city -->
                                @include('pages.Cities.delete')


                                <!--  page of show_modal_city -->
                                @include('pages.Cities.show')

                            @endforeach
                        </table>

                        <div> {{$cities->links('pagination::bootstrap-4')}}</div>
                    </div>
                </div>
            </div>
        </div>


       <!--  page of add_modal_city -->
       @include('pages.Cities.create')
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



