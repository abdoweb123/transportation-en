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

                    <p > <h4 style="text-align:center">List Of Trips </h4> </p>

                        <button type="button" class="btn btn-primary mb-10"  wire:click='switch'>
                            {{ $showForm == true ? 'show ' : 'add ' }}
                            </button>
@if ($showForm == true)
    <livewire:employee-run-trips.edit >
@else
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Route</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Bus</th>
                                    <th>Total</th>
                                    <th>Driver</th>
                                    <th>Entered By</th>
                                    <th>Processes</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (($employeeRunTrips ))
                                    @foreach ($employeeRunTrips as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ (@$item->employeeRunTrip->route->name)  }}</td>
                                        <td>{{ @$item->employeeRunTrip->date  }}</td>
                                        <td>{{ @$item->employeeRunTrip->time  }}</td>
                                        <td>{{ @$item->bus->code  }}</td>
                                        <td>{{ @$item->employeeRunTrip->total }}</td>
                                        <td>{{ @$item->employeeRunTrip->driver->name }}</td>
                                        <td>{{ (@$item->admin->name)  }}</td>
                                        <td>
                                            <a href="{{ url('seat-booking/'.@$item->employeeRunTrip_id.'/'.@$item->id) }}" class="btn btn-info">seat edit </a>
                                            <button class="btn btn-primary"  title="تعديل"  wire:click='edit_form({{ $item->id }})'>
                                                <i  class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" wire:click='make_delete({{ $item->id }})' title="حذف">
                                                <i class="fa fa-trash"></i>
                                            </button >
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </table>
                            <div>
                                {{$employeeRunTrips ->links('pagination::bootstrap-4')}}
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <!--  page of add_modal_city -->
    <div wire:ignore.self class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                id="delete">
                حذف غرفه
            </h5>
            <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent='delete_at'>
                <p> هل أنت متأكد من عملية الحذف ؟</p>
                <p> سيتم نقل عامل التوصيل إلى سلة المهملات</p>
                {{-- <input id="id" type="hidden" name="id" class="form-control""> --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-danger" >حذف</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
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
