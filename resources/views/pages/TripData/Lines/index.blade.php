@extends('layouts.master')
@section('css')
@section('title')
    خطوط الرحلات
@stop

<style>
    .input_table , .input_table:active ,
    .input_table:focus {
        border:none;
        outline: none;
        width: 75%;
        text-align: center;
    }

    select {
        border:none;
        outline: none;
    }
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
  قائمة خطوط الرحلات
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



                    <h4 class="text-center"><span style="background-color:#84ba3f; color:white; border-radius: 5px; padding:5px"> رحلة {{$data['tripData']->name}}</span></h4>

                    @foreach(['danger','warning','success','info'] as $msg)
                        @if(Session::has('alert-'.$msg))
                            <div class="alert alert-{{$msg}} messages">
                                {{Session::get('alert-'.$msg)}}
                            </div>
                        @endif
                    @endforeach

                    <br><br>

                    <div class="table-responsive">
                        <form action="{{route('lines.store')}}" method="post">
                            @csrf
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>محطة الانطلاق</th>
                                <th>محطة الوصول</th>
                                <th>سعر الذهاب</th>
                                <th>سعر الذهاب والعودة</th>
                                <th>سعر الذهاب للأجانب</th>
                                <th>سعر الذهاب والعودة للأجانب</th>
                                <th>حالة الرحلة</th>
                                <th>غرامة إلغاء الرحلة</th>
                                <th>غرامة تعديل الرحلة</th>
                                <th>مدخل البيانات</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($data['lines'] as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>@isset($item->stationFrom->station->name) {{ $item->stationFrom->station->name }} @else لا يوجد @endisset</td>
                                    <td>@isset($item->stationTo->station->name) {{ $item->stationTo->station->name }} @else لا يوجد @endisset</td>
                                    <td><input class="input_table" type="number" name="priceGo[]" value="{{$item->priceGo}}"></td>
                                    <td><input class="input_table" type="number" name="priceBack[]" value="{{$item->priceBack}}"></td>
                                    <td><input class="input_table" type="number" name="priceForeignerGo[]" value="{{$item->priceForeignerGo}}"></td>
                                    <td><input class="input_table" type="number" name="priceForeignerBack[]" value="{{$item->priceForeignerBack}}"></td>
                                    <td>
                                        <select name="active[]">
                                            <option value="{{$item->active}}">{{$item->active  == 1 ? 'نشط' : 'غير نشط'}}</option>
                                            @if($item->active == 1)
                                                <option value="2">غير نشط</option>
                                            @else
                                                <option value="1">نشط</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td><input class="input_table" type="number" name="cancelFee[]" value="{{$item->cancelFee}}"></td>
                                    <td><input class="input_table" type="number" name="editFee[]" value="{{$item->editFee}}"></td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else لا يوجد @endisset</td>
                                    <input type="hidden" name="id[]" value="{{$item->id}}">
                                    <td>
                                        <div class="dropdown show">
                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                العمليات
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
{{--                                                <a type="button" class="dropdown-item" style="cursor:pointer" data-toggle="modal"--}}
{{--                                                   data-target="#edit{{ $item->id }}" title="{{ trans('main_trans.edit') }}">--}}
{{--                                                   <i style="color:#a3a373" class="fa fa-edit"></i>&nbsp; تعديل</a>--}}

                                                <a type="button" class="dropdown-item" style="cursor:pointer" data-toggle="modal"
                                                   data-target="#delete{{ $item->id }}" title="{{ trans('main_trans.delete') }}">
                                                   <i style="color:red" class="fa fa-trash"></i>&nbsp; حذف</a>

                                            </div>
                                        </div>
                                    </td>

                                </tr>

                                <!--  page of edit_modal_station -->
{{--                                @include('pages.TripData.Lines.edit')--}}

                                <!--  page of delete_modal_station -->
                                @include('pages.TripData.Lines.delete')

                            @endforeach

                        </table>
                        <button type="submit" class="btn btn-success mt-1 mb-4 mx-2">حفظ</button>
                        </form>
                        <div> {{$data['lines']->links('pagination::bootstrap-4')}}</div>

                    </div>
                </div>
            </div>
        </div>



       <!--  page of add_modal_station -->
{{--       @include('pages.TripData.Lines.create')--}}
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



