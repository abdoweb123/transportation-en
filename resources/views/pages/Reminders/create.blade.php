@extends('layouts.master')
@section('css')
@section('title')
    Add Reminder
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Add Reminder
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

    <h6><span style="border-radius: 5px; padding:5px"><a href="{{route('reminders.index')}}" style="color:blue">Reminders</a> / Add Reminder</span></h6>

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
                    <form action="{{ route('reminders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">Bus Code</label>
                                <select name="bus_id" class="form-control" required>
                                    <option value=" " selected>-- Choose --</option>
                                    @foreach($data['buses'] as $bus)
                                        <option value="{{$bus->id}}" {{old('bus_id') == $bus->id ? 'selected' : ''}}>{{$bus->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">Category Issue</label>
                                <select name="issue_id" class="form-control" required>
                                    <option value=" " selected>-- Choose --</option>
                                    @foreach($data['issues'] as $issue)
                                        <option value="{{$issue->id}}" {{old('issue_id') == $issue->id ? 'selected' : ''}}>{{$issue->category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">Reminder Days</label>
                                <input type="number" name="reminder_days" value="{{old('reminder_days')}}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">Threeshold Days</label>
                                <input type="number" name="threeshold_days" value="{{old('threeshold_days')}}" class="form-control" required>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">Start Date</label>
                                <input type="date" name="start_date" value="{{old('start_date')}}" class="form-control" required>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">Distance</label>
                                <input type="text" name="distance" value="{{old('distance')}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label class="mr-sm-2">Threeshold Distance</label>
                                <input type="text" name="threeshold_distance" value="{{old('threeshold_distance')}}" class="form-control" required>
                            </div>
                            <div class="col-8">
                                <label class="mr-sm-2">Task</label>
                                <input type="text" name="task" value="{{old('task')}}" class="form-control" required>
                            </div>
                        </div>

                        <br><br>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
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
