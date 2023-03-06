@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('cities_trans.title_page') }}
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
    
    /*.dataTables_length{display: none}*/
    .messages , .alert-danger {width:30%}
    .switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

</style>


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
                    <p > <h4 style="text-align:center">List Of Cities</h4> </p>

                    {{--  button of add_modal_city  --}}
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('main_trans.add') }}
                    </button>
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#importExcel"> 
                       <i class="far fa-file-excel"></i> Excel
                    </button>
                    <br><br>

                        <form action="cities" method="GET">
                            <div class="row mb-4" >
                                <div class="col-md-4">
                                    <select name="company_id" class="form-control">
                                        <option value=" ">-- Choose --</option>
                                        @foreach($comapnies as $company)
                                            <option value="{{$company->id}}" {{$request_company_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-info font-weight-bolder font-size-sm"><i class="fas fa-filter"></i> filter</button>
                                </div>
                            </div>
                        </form>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('cities_trans.city_name_ar') }}</th>
                                <th>{{ trans('cities_trans.city_name_en') }}</th>
                                <th>Entered By</th>
                                <th> status</th>
                                <th>{{ trans('main_trans.processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($cities as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->getTranslation('name', 'ar')  }}</td>
                                    <td>{{ $item->getTranslation('name', 'en')  }}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="checkbox" value="{{ $item->id }}" {{ ($item->is_active == 'Y' ? 'checked' : '') }}>
                                            <span class="slider round"></span>
                                          </label>
                                    </td>
                                    <td>
                                        <button type="button" class="process" style="cursor:pointer" data-toggle="modal"
                                           data-target="#edit{{ $item->id }}" title="{{ trans('main_trans.edit') }}">
                                           <i style="color:#a3a373; font-size:18px" class="fa fa-edit"></i></button>

                                        <button type="button" class="process" style="cursor:pointer" data-toggle="modal"
                                           data-target="#delete{{ $item->id }}" title="{{ trans('cities_trans.delete') }}">
                                           <i style="color:red; font-size:18px" class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_city -->
                                @include('pages.Cities.edit')

                                <!--  page of delete_modal_city -->
                                @include('pages.Cities.delete')


                                <!--  page of show_modal_city -->
{{--                                @include('pages.Cities.show')--}}

                            @endforeach
                            </tbody>
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
     <script>
        $('.checkbox').on('click',function(){
            var item_id  = $(this).val();
            $.ajax({
                url:'citiy-status',
                type:'GET',
                data:{id:item_id}
            }).done(function(response) {
            //success
            }).fail(function(error){
            //failure
            console.log('faild');
            })
        });
    </script>
@endsection



