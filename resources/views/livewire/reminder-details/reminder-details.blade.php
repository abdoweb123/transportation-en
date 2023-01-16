<div>
    @section('css')
    @section('title')
       {{ $tittle }}
    @stop
    @endsection
    @section('page-header')
        <!-- breadcrumb -->
    @section('PageTitle')
        {{ $tittle }}
    @stop
    <!-- breadcrumb -->
    @endsection
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        @foreach(['danger','warning','success','info'] as $msg)
                            @if(Session::has('alert-'.$msg))
                                <div class="alert alert-{{$msg}}">
                                    {{Session::get('alert-'.$msg)}}
                                </div>
                            @endif
                        @endforeach

                        <br><br>
                        <button type="button" class="btn btn-primary mb-10"  wire:click='switch'>
                            {{ $showForm == true ? 'show ' : 'add ' . $tittle }}
                            </button>
@if ($showForm == true)
    <livewire:reminder-details.edit :id="$reminder_id">
@else
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr>
            <th>#</th>
            <th>Reminder Id</th>
            <th>Vendor Name</th>
            <th>Total Paid</th>
            <th>Cost Per Day</th>
            <th>Done</th>
            <th>Entered By</th>
            <th>Status</th>
            <th>Processes</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($results as $item)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>@isset($item->reminder->id) <a href="{{route('getReminder',$item->reminder->id)}}" style="color:red">{{ $item->reminder->id }}</a> @else _____ @endisset</td>
                <td>@isset($item->vendor->name)  {{ $item->vendor->name }} @else _____ @endisset</td>
                <td>{{ $item->total_paid }}</td>
                <td>{{ $item->cost_per_day  }}</td>
                <td>{{$item->done == 1 ? 'Done' : '_____'}}</td>
                <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                <td>{{$item->active == 1 ? 'active' : 'un active'}}</td>
                <td>
                    <a type="button" class="process" style="cursor:pointer" data-toggle="modal"
                       data-target="#delete{{ $item->id }}" title="{{ trans('main_trans.delete') }}">
                       <i style="color:red; font-size:18px" class="fa fa-trash"></i></a>
                </td>
            </tr>

            <!--  page of delete_modal_office -->
            @include('pages.ReminderHistory.delete')

        @endforeach
    </table>

{{--                        <div> {{$offices->links('pagination::bootstrap-4')}}</div>--}}

</div>
                    </div>
                </div>
    </div>
    <!--  page of add_modal_city -->
    @include('livewire.driver-salaries.form')
@endif
    </div>
    @section('js')
        @toastr_js
        @toastr_render
        <script>
            $(document).ready(function(){
                $(".alert").delay(5000).slideUp(300);
            });
        </script>
         <script>
            $(document).ready(function(){
            window.livewire.on('remove_modal', () => {
            $('#delete').modal('hide');
            });
            window.livewire.on('showDelete', () => {
                console.log('good');
            $('#delete').modal('show');
            });
        });
        </script>
    @endsection
</div>
