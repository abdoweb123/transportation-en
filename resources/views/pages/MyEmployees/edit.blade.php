@extends('layouts.master')
@section('css')
@section('title')
    Edit Employee Information
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   Edit Employee Information
@stop
<!-- breadcrumb -->
@endsection
@section('content')

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


    <!-- row mb-3 -->
    <div class="row mb-3">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form action="{{ route('myEmployees.update',$myEmployee->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">Employee Code</label>
                                <input type="text" name="oracle_id" value="{{old('oracle_id', $myEmployee->oracle_id)}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">Office</label>
                                <select name="office_id" class="form-control">
                                    <option value=" " selected>-- Choose --</option>
                                    @foreach($data['offices'] as $office)
                                        <option value="{{$office->id}}" {{old('office_id') == $office->id ? 'selected' : ''}} {{$office->id == $myEmployee->office_id ? 'selected' : ''}}>{{$office->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">Collection Point</label>
                                <select name="collectionPoint_id" class="form-control">
                                    <option value=" " selected>-- Choose --</option>
                                    @foreach($data['stations'] as $station)
                                        <option value="{{$station->id}}" {{old('collectionPoint_id') == $station->id ? 'selected' : ''}} {{$station->id == $myEmployee->collectionPoint_id ? 'selected' : ''}}>{{$station->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">Job</label>
                                <select name="employeeJob_id" class="form-control">
                                    <option value=" " selected>-- Choose --</option>
                                    @foreach($data['employeeJobs'] as $employeeJob)
                                        <option value="{{$employeeJob->id}}" {{old('employeeJob_id') == $employeeJob->id ? 'selected' : ''}} {{$employeeJob->id == $myEmployee->employeeJob_id ? 'selected' : ''}}>{{$employeeJob->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">Department</label>
                                <select name="department_id" class="form-control">
                                    <option value=" " selected>-- Choose --</option>
                                    @foreach($data['departments'] as $department)
                                        <option value="{{$department->id}}" {{old('department_id') == $department->id ? 'selected' : ''}} {{$department->id == $myEmployee->department_id ? 'selected' : ''}}>{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value=" " selected>-- Choose --</option>
                                    <option value="1" {{old('gender') == 1 ? 'selected' : ''}} {{$myEmployee->gender ==  1 ? 'selected' : ''}}>Male</option>
                                    <option value="2" {{old('gender') == 2 ? 'selected' : ''}} {{$myEmployee->gender ==  2 ? 'selected' : ''}}>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">Phone</label>
                                <input type="text" name="phone" value="{{old('phone', $myEmployee->phone)}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">Email</label>
                                <input type="email" name="email" value="{{old('email', $myEmployee->email)}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">Password</label>
                                <input type="password" name="password" value="{{old('password', $myEmployee->password)}}" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="image" class="mr-sm-2">Status</label>
                                <select name="active" class="form-control">
                                    @if($myEmployee->active == 1)
                                        <option value="1" selected>active</option>
                                        <option value="2">un active</option>
                                    @else
                                        <option value="1">active</option>
                                        <option value="2" selected>un active</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">Address</label>
                                <textarea name="address" class="form-control">{{old('address', $myEmployee->address)}}</textarea>
                            </div>
                        </div>

                        <br><br>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
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
            $(".alert").delay(5000).slideUp(300);
        });
    </script>
@endsection
