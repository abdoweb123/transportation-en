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
    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
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
                    @if (Session::has('dataa'))
                        @foreach( Session::get('dataa') as  $value)
                            <div class="alert alert-danger">
                                the row that name ar is( {{ $value[0] }} ) and name en is ({{ $value[1] }}) not added because data not complete
                            </div>
                        @endforeach
                    @endif


                    @foreach(['danger','warning','success','info'] as $msg)
                        @if(Session::has('alert-'.$msg))
                            <div class="alert alert-{{$msg}} messages">
                                {{Session::get('alert-'.$msg)}}
                            </div>
                        @endif
                    @endforeach

                    <p > <h4 style="text-align:center">List Of Stations</h4> </p>

                    {{--  button of add_modal_city  --}}
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('main_trans.add') }}
                    </button>
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#importExcel">
                        <i class="far fa-file-excel"></i> Import Excel
                     </button>
                     <a href="{{ url('export-excel') }}"  class="button x-small" >Export excel</a>
                     <br><br>
 
                         {{-- <form action="stations" method="GET">
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
                         </form> --}}

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
                                <th> Status </th>
                                <th>{{ trans('main_trans.processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($stations as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->getTranslation('name', 'ar')  }}</td>
                                    <td>{{ $item->getTranslation('name', 'name_en')  }}</td>
                                    <td>@isset($item->city->name)  {{ $item->city->name }} @else _____ @endisset</td>
                                    <td>@isset($item->lat)  {{ $item->lat }} @else _____ @endisset</td>
                                    <td>@isset($item->lon)  {{ $item->lon }} @else _____ @endisset</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="checkbox" value="{{ $item->id }}" {{ ($item->is_active == 'Y' ? 'checked' : '') }}>
                                            <span class="slider round"></span>
                                          </label>
                                    </td>
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

                       <div> {{$stations->links('pagination::bootstrap-4')}}</div>

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
    <script>
        $('.checkbox').on('click',function(){
            var item_id  = $(this).val();
            $.ajax({
                url:'stations-status',
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



