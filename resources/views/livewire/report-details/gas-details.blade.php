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

                        <h4>{{ $tittle }}</h4>
                        <br><br>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <form wire:submit.prevent="report" >
                                    <div class="form-group row">
                                        <input class="form-control col-md-3 col-sm-6" type="date" placeholder="date-start" wire:model.lazy='start_date' />
                                        <input class="form-control col-md-3 col-sm-6" type="date" placeholder="date-end" wire:model.lazy='end_date'/>
                                        <button class="btn btn-info font-weight-bolder font-size-sm col-md-2 ">report</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button class="btn btn-success" wire:click='download_report_one'><i class="fa fa-download"></i> excel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>bus </th>
                                    <th>bus type </th>
                                    <th>kilometer </th>
                                    <th>driver </th>
                                    {{-- <th>route </th> --}}
                                    <th>Gas Amount </th>
                                    <th>paid amount </th>
                                    <th>distance</th>
                                    <th>leter/km </th>
                                    <th>paid/km </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(isset($results->gas))
                                        @foreach ($results->gas as $index=>$result)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ @$result->bus->code }}</td>
                                                <td>{{ @$result->bus_type->name }}</td>
                                                <td>{{ @$result->kilometer }}</td>
                                                <td>{{ @$result->driver->name }}</td>
                                                {{-- <td>{{ @$result->route->name }}</td> --}}
                                                <td>{{ @$result->gas_amount }}</td>
                                                <td>{{ @$result->paid_amount }}</td>
                                                <td>{{ @$result->distance }}</td>
                                                <td>{{ @$result->leter_k }}</td>
                                                <td>{{ @$result->amount_k }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
