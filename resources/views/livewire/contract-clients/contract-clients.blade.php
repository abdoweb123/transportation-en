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
                                            <div class="col-md-6 mb-5">
                                                <label for="name" class="mr-sm-2">name</label>
                                                <input id="name" type="text" name="name" class="form-control" wire:model.defer='name'>
                                                @error('name')<span style="color: red"> {{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-md-6 mb-5">
                                                <label for="company" class="mr-sm-2">company</label>
                                                <input id="company" type="text" class="form-control" wire:model='company_id'>
                                                @if(($serches))
                                                    @foreach($serches as $search)
                                                    <a href="javascript:void(0);" wire:click='defin_company({{ $search->id }})'>
                                                        <span class="form-text text-muted">{{ $search->name }}</span>
                                                    </a>
                                                    @endforeach
                                                @endif
                                                @error('company')<span style="color: red"> {{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-md-5 mb-5">
                                                <label for="start date" class="mr-sm-2">start date</label>
                                                <input id="start_date" type="date" class="form-control" wire:model.lazy='start_date'>
                                                @error('start_date')<span style="color: red"> {{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-md-5 mb-5">
                                                <label for="end_date" class="mr-sm-2">end_date</label>
                                                <input id="end_date" type="date" class="form-control" wire:model.lazy='end_date'>
                                                @error('end_date')<span style="color: red"> {{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label for="number_of_routes" class="mr-sm-2">routes num</label>
                                                <input id="number_of_routes" type="number"  class="form-control" wire:model.lazy='number_of_routes'>
                                                @error('number_of_routes')<span style="color: red"> {{ $message }}</span>@enderror
                                            </div>
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
                        <div class="row mb-4" >
                            <div class="col-md-4">
                                <select name="company_id" class="form-control mr-sm-2 p-2" wire:model='company_id_search'>
                                    <option value="0">-- Choose Company --</option>
                                    @foreach($comapnies as $company)
                                        <option value="{{$company->id}}" >{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="button x-small" data-toggle="modal" data-target="#importExcel"> 
                                <i class="far fa-file-excel"></i> Excel
                             </button>
                           
                        </div>
                        {{-- <button type="button" class="btn btn-primary mb-10"  wire:click='switch'>
                            {{ $showForm == true ? 'show ' : 'add ' . $tittle }}
                            </button> --}}
                            {{--  <a href="{{ url('contract-client-edit/0') }}" class="btn btn-primary mb-10">{{ 'add ' . $tittle }}</a>  --}}
                            {{-- <a href="{{ url('company-contract-route') }}" class="btn btn-primary mb-10">company contract toute</a> --}}

                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name </th>
                                    <th>company </th>
                                    <th>start date </th>
                                    <th>end date </th>
                                    <th> number of routes </th>
                                    <th> cmopany contract </th>
                                    <th>actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($results))
                                    @foreach ($results as $index=>$result)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ @$result->name }}</td>
                                            <td>{{ @$result->company->name }}</td>
                                            <td>{{ @$result->start_date }}</td>
                                            <td>{{ @$result->end_date }}</td>
                                            <td>{{ @$result->number_of_routes }}</td>
                                            <td>
                                                <a href="{{ url('/company-contract-route/'.$result->id) }}" class="btn btn-success"  title="تعديل">company contract client</i></a>
                                            </td>
                                            <td style="width: 15%">
                                                <a href="{{ url('/contract-client-edit/'.$result->id) }}" class="btn btn-primary"  title="تعديل"><i  class="fa fa-edit"></i></a>
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

                <div wire:ignore.self class="modal fade" id="importExcel" tabindex="-1" role="dialog"
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
                        <form wire:submit.prevent='import_file' enctype="multipart/form-data">
                            <div class="row">
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
                                    <label for="file" class="mr-sm-2">company:</label>
                                    <select name="company_id" class="form-control" wire:model.defer='company_export_id'>
                                        <option value=" ">-- Choose --</option>
                                        @foreach($comapnies as $company)
                                            <option value="{{$company->id}}" >{{$company->name}}</option>
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
            $('#delete').modal('show');
            });
        });
        </script>
    @endsection
</div>
