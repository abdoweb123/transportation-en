@extends('layouts.master')
@section('css')
@section('title')
   Jobs List
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
  Jobs List
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
                    <p > <h4 style="text-align:center">List of Jobs</h4> </p>

                    {{--  button of add_modal_office  --}}
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                       Add 
                    </button>
                    {{-- <button type="button" class="button x-small" >
                        <i class="far fa-file-excel"></i> Excel
                     </button> --}}
                     <br><br>
                     @if($type == 'company')
                         <form action="employeeJobs" method="GET">
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
                         @endif
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Entered By</th>
                                <th>Status</th>
                                <th>Process</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($employeeJobs as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->name  }}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else لا يوجد @endisset</td>
                                    <td>{{$item->active == 1 ? 'active' : 'un active'}}</td>
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
                                @include('pages.EmployeeJobs.edit')

                                <!--  page of delete_modal_office -->
                                @include('pages.EmployeeJobs.delete')


                            @endforeach
                        </table>

                        <div> {{$employeeJobs->links('pagination::bootstrap-4')}}</div>

                    </div>
                </div>
            </div>
        </div>


       <!--  page of add_modal_office -->
       @include('pages.EmployeeJobs.create')
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



