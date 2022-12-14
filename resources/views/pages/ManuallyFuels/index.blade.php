@extends('layouts.master')
@section('css')
@section('title')
    قائمة استهلاك الوقود اليدوي
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
    قائمة استهلاك الوقود اليدوي
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
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        إضافة وقود يدوي
                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>كود الحافة</th>
                                <th>المسافة المقطوعة</th>
                                <th>التعليق</th>
                                <th>مدخل البيانات</th>
                                <th>الحالة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($manuallyFuels as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>@isset($item->bus->code)  {{ $item->bus->code }} @else لا يوجد @endisset</td>
                                    <td>{{ $item->distance }} م </td>
                                    <td>{{$item->comments != null ? $item->comments : 'لا يوجد'}}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else لا يوجد @endisset</td>
                                    <td>{{$item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                    <td>
                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#edit{{ $item->id }}" title="تعديل">
                                            <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></button>

                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">
                                            <i style="color:red; font-size:18px;" class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_office -->
                                @include('pages.ManuallyFuels.edit')

                                <!--  page of delete_modal_office -->
                                @include('pages.ManuallyFuels.delete')

                            @endforeach
                        </table>

                        <div> {{$manuallyFuels->links('pagination::bootstrap-4')}}</div>

                    </div>
                </div>
            </div>
        </div>


       <!--  page of add_modal_office -->
       @include('pages.ManuallyFuels.create')
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



