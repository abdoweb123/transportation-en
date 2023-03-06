@extends('layouts.master')
@section('css')
@section('title')
    السائقون
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   قائمة السائقين
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
                    @if (Session::has('dataa'))
                        @foreach( Session::get('dataa') as  $value)
                            <div class="alert alert-danger">
                                the row that name is( {{ $value[0] }} ) and oracl id is ({{ $value[1] }}) not added because data not complete
                            </div>
                        @endforeach
                    @endif
                    <p > <h4 style="text-align:center">List Of Drivers</h4> </p>
                    {{--  button of add_modal_employee  --}}
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        add 
                    </button>
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#importExcel">
                        <i class="far fa-file-excel"></i> Excel
                     </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الصورة</th>
                                <th>المسمي الوظيفي</th>
                                <th>البريد الإلكتروني</th>
                                <th>الهاتف</th>
                                <th>المكتب التابع له</th>
                                <th>الصلاحيات</th>
                                <th>مدخل البيانات</th>
                                <th> العقودات</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($drivers as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><img class="img-fluid" src="{{asset('assets/images/drivers/'. $item->image )}}" alt="" style="width:70px; height:70px"></td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>@isset($item->office->name)  {{ $item->office->name }} @else لا يوجد @endisset</td>
                                    <td>@if($item->role != 0)  {{ $item->role }} @else لا يوجد @endif</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else لا يوجد @endisset</td>
                                    <td>
                                        <a href="{{ url('driver-salary/'.$item->id) }}" class="btn btn-primary">contracts</a>
                                    </td>
                                    <td>
                                        <div class="dropdown show">
                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                العمليات
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a type="button" class="dropdown-item" style="cursor:pointer" data-toggle="modal"
                                                   data-target="#edit{{ $item->id }}" title="{{ trans('main_trans.edit') }}">
                                                   <i style="color:#a3a373" class="fa fa-edit"></i>&nbsp; تعديل</a>

                                                <a type="button" class="dropdown-item" style="cursor:pointer" data-toggle="modal"
                                                   data-target="#delete{{ $item->id }}" title="{{ trans('main_trans.delete') }}">
                                                   <i style="color:red" class="fa fa-trash"></i>&nbsp; حذف</a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_employee -->
                                @include('pages.Drivers.edit')

                                <!--  page of delete_modal_employee -->
                                @include('pages.Drivers.delete')

                            @endforeach
                        </table>

                        <div> {{$drivers->links('pagination::bootstrap-4')}}</div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                   add file
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <!-- add_form -->
               <form action="{{ url('importDrivers') }}" method="post" enctype="multipart/form-data">
                   {{ method_field('post') }}
                   @csrf
                   <div class="row">
                       <div class="col">
                           <label for="file" class="mr-sm-2">{{ trans('cities_trans.file') }}:</label>
                           {{-- <input type="text" name="test" value="test" id=""> --}}
                           <input type="file" name="excel">
                       </div>
                       {{-- <div class="col">
                            <label for="file" class="mr-sm-2">company:</label>
                            <select name="company_id" class="form-control">
                                <option value=" ">-- Choose --</option>
                                @foreach($comapnies as $company)
                                    <option value="{{$company->id}}" {{$request_company_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                                @endforeach
                            </select>
                       </div> --}}
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                       <button type="submit" class="btn btn-success">{{ trans('main_trans.submit') }}</button>
                   </div>
               </form>

           </div>
       </div>
   </div>
</div>

        </div>


       <!--  page of add_modal_employee -->
       @include('pages.Drivers.create')
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



