@extends('layouts.master')
@section('css')
@section('title')
    Routes List
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
   Routes List
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
                    <p > <h4 style="text-align:center">Route Station List</h4> </p>

                    {{--  button of add_modal_office  --}}
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        Add
                    </button>
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#importExcel">
                        <i class="far fa-file-excel"></i> Excel
                     </button>
                     <br><br>
 
                         <form action="routeStations" method="GET">
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
                                <th>Station</th>
                                <th>Route</th>
                                <th>Status</th>
                                <th>Entered By</th>
                                <th>Change Status</th>
                                <th>Processes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($routeStations as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>@isset($item->station->name)  {{ $item->station->name }} @else ____ @endisset</td>
                                    <td>@isset($item->route->name)  {{ $item->route->name }} @else ____ @endisset</td>
                                    <td>{{$item->active == 1 ? 'active' : 'un active'}}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else ____ @endisset</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="checkbox" value="{{ $item->id }}" {{ ($item->active == 1 ? 'checked' : '') }}>
                                            <span class="slider round"></span>
                                          </label>
                                    </td>
                                    <td>
                                        <a type="button" class="process" style="cursor:pointer" data-toggle="modal"
                                           data-target="#editRouteStation{{ $item->id }}" title="{{ trans('main_trans.edit') }}">
                                           <i style="color:#a3a373; font-size:18px" class="fa fa-edit"></i></a>

                                        <a type="button" class="process" style="cursor:pointer" data-toggle="modal"
                                           data-target="#delete{{ $item->id }}" title="{{ trans('main_trans.delete') }}">
                                           <i style="color:red; font-size:18px" class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_office -->
                                @include('pages.RouteStation.edit')

                                <!--  page of delete_modal_office -->
                                @include('pages.RouteStation.delete')


                                <!--  page of show_modal_office -->
{{--                                @include('pages.Offices.show')--}}

                            @endforeach
                        </table>

                       <div> {{$routeStations->links('pagination::bootstrap-4')}}</div>

                    </div>
                </div>
            </div>
        </div>


       <!--  page of add_modal_office -->
       @include('pages.RouteStation.create')

       
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
           <form action="{{ url('importroute_station') }}" method="post" enctype="multipart/form-data">
               {{ method_field('post') }}
               @csrf
               <div class="row">
                   <div class="col">
                       <label for="file" class="mr-sm-2">{{ trans('cities_trans.file') }}:</label>
                       {{-- <input type="text" name="test" value="test" id=""> --}}
                       <input type="file" name="excel">
                   </div>
                   <div class="col">
                        <label for="file" class="mr-sm-2">company:</label>
                        <select name="company_id" class="form-control">
                            <option value=" ">-- Choose --</option>
                            @foreach($comapnies as $company)
                                <option value="{{$company->id}}" {{$request_company_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                            @endforeach
                        </select>
                   </div>
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
                url:'routeStations-status',
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



