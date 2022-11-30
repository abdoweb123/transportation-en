@extends('layouts.master')
@section('css')
@section('title')
   قائمة الاشتراكات
@stop
<style>
    select{padding: 10px !important;}
</style>

@endsection

@section('page-header')

@section('PageTitle')
    قائمة الاشتراكات
@stop

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
                        إضافة اشتراك
                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>محطة الانطلاق</th>
                                <th>محطة الوصول</th>
                                <th>أقصى عدد للرحلات</th>
                                <th>مدة الاشتراك</th>
                                <th>المبلغ الكلي</th>
                                <th>المبلغ بعد التخفيض</th>
                                <th>الحالة</th>
                                <th>النوع</th>
                                <th>الوصف</th>
                                <th>مدخل البيانات</th>
                                <th>{{ trans('main_trans.processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($packages as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>@isset($item->stationFrom->name)  {{ $item->stationFrom->name }} @else لا يوجد @endisset</td>
                                    <td>@isset($item->stationTo->name)  {{ $item->stationTo->name }} @else لا يوجد @endisset</td>
                                    <td>{{ $item->max_trips }}</td>
                                    <td>{{ $item->max_duration }}</td>
                                    <td>{{ $item->total }}</td>
                                    <td>{{ $item->sub_total }}</td>
                                    <td>{{$item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                    <td>{{ $item->type == 1 ? 'ذهاب' : 'ذهاب وعودة'}}</td>
                                    <td>{{ $item->description == null ? 'لا يوجد' : $item->description }}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else لا يوجد @endisset</td>
                                    <td>
                                        <div class="dropdown show">
                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ trans('main_trans.processes') }}
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a type="button" class="dropdown-item" style="cursor:pointer" data-toggle="modal"
                                                   data-target="#edit{{ $item->id }}" title="{{ trans('main_trans.edit') }}">
                                                   <i style="color:#a3a373" class="fa fa-edit"></i>&nbsp; تعديل</a>

                                                <a type="button" class="dropdown-item" style="cursor:pointer" data-toggle="modal"
                                                   data-target="#delete{{ $item->id }}" title="{{ trans('Packages_trans.delete') }}">
                                                   <i style="color:red" class="fa fa-trash"></i>&nbsp; حذف</a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_city -->
                                @include('pages.Packages.edit')

                                <!--  page of delete_modal_city -->
                                @include('pages.Packages.delete')


                            @endforeach
                        </table>

                        <div> {{$packages->links('pagination::bootstrap-4')}}</div>
                    </div>
                </div>
            </div>
        </div>


       <!--  page of add_modal_city -->
       @include('pages.Packages.create')
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



