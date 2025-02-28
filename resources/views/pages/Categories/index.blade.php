@extends('layouts.master')
@section('css')
@section('title')
    Bus Categories List
@stop

<style>
    select{padding:10px !important;}
    button{padding: 5px 3px 0 4px; margin-left: 5px !important;}
</style>


@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Bus Categories List
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
                    <p > <h4 style="text-align:center">Bus Categories</h4> </p>

                    {{--  button of add_modal_city  --}}
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        Add 
                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Entered By</th>
                                <th>{{ trans('main_trans.processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->name  }}</td>
                                    <td>{{$item->active == 1 ? 'Active' : 'Un active'}}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>
                                        <button type="button" class="process" style="cursor:pointer; background-color:white; border-radius:3px; border: 1px solid #dddd;"
                                                data-toggle="modal" data-target="#edit{{ $item->id }}" title="تعديل">
                                            <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></button>

                                        <button type="button" class="process" style="cursor:pointer; background-color:white; border-radius:3px; border: 1px solid #dddd;"
                                                data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">
                                            <i style="color:red; font-size:18px;" class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_city -->
                                @include('pages.Categories.edit')

                                <!--  page of delete_modal_city -->
                                @include('pages.Categories.delete')

                            @endforeach
                            </tbody>
                        </table>

                        <div> {{$categories->links('pagination::bootstrap-4')}}</div>
                    </div>
                </div>
            </div>
        </div>


        <!--  page of add_modal_city -->
        @include('pages.Categories.create')
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



