<div>
    @section('css')
    @section('title')
       {{ $tittle }}
    @stop
    @endsection
    @section('page-header')
    <link rel="stylesheet" href="{{ url('css/career/career.css') }}">
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

                        {{-- <button type="button" class="btn btn-primary mb-10"  wire:click='switch'>
                            {{ $showForm == true ? 'show ' : 'add ' . $tittle }}
                            </button> --}}
                            {{-- <a href="{{ url('suplier-contract-route-edit/0') }}" class="btn btn-primary mb-10">{{ 'add ' . $tittle }}</a> --}}
 
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="accordion" style='position: relative; background-color: #fff;'>
                                        <dl wire:ignore>
                                            <dt>
                                                <a href="#accordion1" aria-expanded="false" aria-controls="accordion1"
                                                    class="accordion-title accordionTitle js-accordionTrigger">Add New</a>
                                            </dt>
                                            <dd class="accordion-content accordionItem is-collapsed" id="accordion1" aria-hidden="true">
                                                <div class="card-body">
                                                    <form wire:submit.prevent='store_update'>
                                                        <div class="card-body col-md-8 offset-2">
                                                            <div class="form-group row">
                                                                {{-- <div class="col-md-6">
                                                                    <label for="contracts_id" class="">contracts</label>
                                                                    <select name="contracts_id" id="" class="form-control mr-sm-2 p-2" wire:model.lazy='contracts_id'>
                                                                        <option value="0"> </option>
                                                                        @if (isset($contracts))
                                                                            @foreach ($contracts as $contract)
                                                                                <option value="{{ $contract->id }}">{{ $contract->name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('contracts_id')<span style="color: red"> {{ $message }}</span>@enderror
                                                                </div> --}}
                                                                <div class="col-md-6">
                                                                    <label for="suplier_id" class="mr-sm-2">supliers</label>
                                                                    <select name="suplier_id" id="" class="form-control mr-sm-2 p-2" wire:model.lazy='suplier_id'>
                                                                        <option value="0"> </option>
                                                                        @if (isset($supliers))
                                                                            @foreach ($supliers as $suplier)
                                                                                <option value="{{ $suplier->id }}">{{ $suplier->name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('suplier_id')<span style="color: red"> {{ $message }}</span>@enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="route_id" class="mr-sm-2">routes</label>
                                                                    <select name="route_id" id="" class="form-control mr-sm-2 p-2" wire:model.lazy='route_id'>
                                                                        <option value="0"> </option>
                                                                        @if (isset($routes))
                                                                            @foreach ($routes as $route)
                                                                                <option value="{{ $route->id }}">{{ $route->name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('route_id')<span style="color: red"> {{ $message }}</span>@enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="bus_type_id" class="mr-sm-2">bus_types</label>
                                                                    <select name="bus_type_id" id="" class="form-control mr-sm-2 p-2" wire:model.lazy='bus_type_id'>
                                                                        <option value="0"> </option>
                                                                        @if (isset($bus_types))
                                                                            @foreach ($bus_types as $bus_type)
                                                                                <option value="{{ $bus_type->id }}">{{ $bus_type->name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('bus_type_id')<span style="color: red"> {{ $message }}</span>@enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="service_type_id" class="mr-sm-2">service_type</label>
                                                                    <select name="service_type_id" id="" class="form-control mr-sm-2 p-2" wire:model.lazy='service_type_id'>
                                                                        <option value="0"> </option>
                                                                        @if (isset($service_types))
                                                                            @foreach ($service_types as $service_type)
                                                                                <option value="{{ $service_type->id }}">{{ $service_type->name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('service_type_id')<span style="color: red"> {{ $message }}</span>@enderror
                                                                </div>
                                                               
                                                                <div class="col-md-6">
                                                                    <label for="service_value" class="mr-sm-2">service value</label>
                                                                    <input id="service_value" type="number"  class="form-control" wire:model.lazy='service_value'>
                                                                    @error('service_value')<span style="color: red"> {{ $message }}</span>@enderror
                                                                </div>
                                                                {{-- <div class="col-md-6">
                                                                    <label for="discount_id" class="mr-sm-2">discount</label>
                                                                    <select name="discount_id" id="" class="form-control mr-sm-2 p-2" wire:model.lazy='discount_id'>
                                                                        <option value="0"> </option>
                                                                        @if (isset($discounts))
                                                                            @foreach ($discounts as $discount)
                                                                                <option value="{{ $discount->id }}">{{ $discount->title }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('discount_id')<span style="color: red"> {{ $message }}</span>@enderror
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                        <br><br>
                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">close</button>
                                                            {{-- <button type="submit" class="btn btn-success">إرسال</button> --}}
                                                            <button type="submit" class="btn btn-success">{{ $ids != null ? 'edit' : 'save' }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <button type="button" class="button x-small" data-toggle="modal" data-target="#importExcel">
                                        <i class="far fa-file-excel"></i> Excel
                                     </button>
                                </div>
                                <div class="col-xl-12 mb-30">
                                    <div class="card card-statistics h-100">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                                   style="text-align: center" >
                                                <thead> 
                                                <tr>
                                                    <th>#</th>
                                                    <th>suplier contract </th>
                                                    <th>suplier </th>
                                                    <th>routes </th>
                                                    <th> bus type </th>
                                                    <th> services type </th>
                                                    <th> services value </th>
                                                    <th>actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if (count($results))
                                                    @foreach ($results as $index=>$result)
                                                        <tr>
                                                            <td>{{ $index+1 }}</td>
                                                            <td>{{ @$result->suplier_contract->name }}</td>
                                                            <td>{{ @$result->suplier->name }}</td>
                                                            <td>{{ @$result->route->name }}</td>
                                                            <td>{{ @$result->bus_type->name }}</td>
                                                            <td>{{ @$result->service_type->name }}</td>
                                                            <td>{{ @$result->service_value }}</td>
                                                            <td style="width: 15%">
                                                                <a href="{{ url('/suplier-contract-route-edit/'.$result->id) }}" class="btn btn-primary"  title="تعديل"><i  class="fa fa-edit"></i></a>
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
                    </div>
                </div>

    <div wire:ignore.self class="modal fade" id="importExcel" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form wire:submit.prevent='import_file' enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                @foreach(['danger','warning','success','info'] as $msg)
                                @if(Session::has('alert-'.$msg))
                                    <div class="alert alert-{{$msg}}">
                                        {{Session::get('alert-'.$msg)}}
                                    </div>
                                @endif
                            @endforeach
                            </div>
                            <div class="col-md-12">
                                @if (isset($result_export))
                                    @foreach($result_export as $msg)
                                        <div class="alert alert-danger">
                                            the row that have {{ $msg[0] .',' .$msg[1] .','.$msg[2]}} not added becuse date not complete
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-12">
                                @if (count($errors) > 0)
                                    @foreach($errors->all() as $error)
                                        <div class="alert alert-{{$msg}}">
                                            {{ $error }} <br>
                                        </div>
                                    @endforeach      
                                @endif
                            </div>
                            <div class="col">
                                <label for="file" class="mr-sm-2">{{ trans('cities_trans.file') }}:</label>
                                {{-- <input type="text" name="test" value="test" id=""> --}}
                                <input type="file" name="excel" wire:model.defer='excel' required>
                            </div>
                            <div class="col">
                                <label for="company_id">company</label>
                                <select class="form-control mr-sm-2 p-2" name="company_id" wire:model.defer='company_id' required>
                                    <option selected >choose</option>
                                    @if(count($companies))
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('company_id')<span style="color: red"> {{ $message }}</span>@enderror
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

    </div>
    @section('js')
        @toastr_js
        @toastr_render 
        <script src="{{ url('js/career.js') }}"></script>

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
