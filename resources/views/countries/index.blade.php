@extends('layouts.master')
@section('css')
@section('title')
    قائمة الدول
@stop

<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
    .process
    {
        cursor:pointer;
        background-color: #d4e3f026;
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
    قائمة الدول
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="box">
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
                    <div class="box-header with-border">

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                            إضافة محافظه
                          </button>
                          {{-- <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#exampleModal" > إضافة محافظه </a> --}}
                    </div>
                    <br><br>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المحافظه باللغة العربية</th>
                                    <th>اسم المحافظه باللغة الإنجليزية</th>
                                    <th>الحالة</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($countries as $item)
                                    <tr>

                                        <td>{{ @$loop->index+1 }}</td>
                                        <td>{{ @$item->getTranslation('name', 'ar') }}</td>
                                        <td>{{ @$item->getTranslation('name', 'en') }}</td>
                                        <td>{{ @$item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{ $item->id }}">
                                                <i class="fa fa-edit"></i>
                                              </button>
                                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $item->id }}">
                                                <i class="fa fa-trash"></i>
                                              </button>
                                        </td>
                                    </tr>

                                    <!--  page of edit_modal_city -->
                                    @include('countries.edit')

                                    <!--  page of delete_modal_city -->
                                    @include('countries.delete')


                                @endforeach
                            </table>

                            <div> {{$countries->links('pagination::bootstrap-4')}}</div>
                        </div>
                    </div>
          
        </div>
       <!--  page of add_modal_city -->
       @include('countries.create')
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




