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
    <livewire:gases.edit>
@else
<div class="row mb-10">
    <div class="col-md-4">
        <select wire:model='driver_id' class="form-control mr-sm-2 p-2" style="width: 100%" >
            <option value="">choose driver </option>
            @isset($drivers)
                @foreach ($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                @endforeach
            @endisset
        </select>
    </div>
    <div class="col-md-4">
        <select wire:model='bus_id' class="form-control mr-sm-2 p-2" style="width: 100%" >
            <option value="">choose bus </option>
            @isset($buses)
                @foreach ($buses as $bus)
                    <option value="{{ $bus->id }}">{{ $bus->code }}</option>
                @endforeach
            @endisset
        </select>
    </div>
    <div class="col-md-4">
        <select wire:model='bus_type' class="form-control mr-sm-2 p-2" style="width: 100%">
            <option value="">choose type</option>
            @isset($bus_types)
                @foreach ($bus_types as $bus_type)
                    <option value="{{ $bus_type->id }}">{{ $bus_type->name }}</option>
                @endforeach
            @endisset
        </select>
    </div>
</div>
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>bus </th>
                                    <th>bus type </th>
                                    <th>kilometer </th>
                                    <th>driver </th>
                                    <th>route </th>
                                    <th>Gas Amount </th>
                                    <th>paid amount </th>
                                    <th>distance</th>
                                    <th>leter/km </th>
                                    <th>paid/km </th>
                                    <th>actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($results))
                                    @foreach ($results as $index=>$result)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ @$result->bus->code }}</td>
                                            <td>{{ @$result->bus_type->name }}</td>
                                            <td>{{ @$result->kilometer }}</td>
                                            <td>{{ @$result->driver->name }}</td>
                                            <td>{{ @$result->route->name }}</td>
                                            <td>{{ @$result->gas_amount }}</td>
                                            <td>{{ @$result->paid_amount }}</td>
                                            <td>{{ @$result->distance }}</td>
                                            <td>{{ @$result->leter_k }}</td>
                                            <td>{{ @$result->amount_k }}</td>
                                            <td style="width: 15%">
                                                <button class="btn btn-primary"  title="تعديل"  wire:click='edit_form({{ $result->id }})'>
                                                    <i  class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger" wire:click='make_delete({{ $result->id }})' title="حذف">
                                                    <i class="fa fa-trash"></i>
                                                </button >
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                            <div>
                                {{$results->links('pagination::bootstrap-4')}}
                            </div>
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
