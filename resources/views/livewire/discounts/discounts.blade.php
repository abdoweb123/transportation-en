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
                        <p > <h4 style="text-align:center">List Of {{  $tittle  }}</h4> </p>
                        <button type="button" class="btn btn-primary btn-sm mb-10"  wire:click='switch'>
                            {{ $showForm == true ? 'show ' : 'add' }}
                            </button>
                            <button type="button" class="btn btn-success btn-sm mb-10" data-toggle="modal" data-target="#importExcel">
                                <i class="far fa-file-excel"></i> Excel
                             </button>
@if ($showForm == true)
    <livewire:discounts.edit>
@else
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>discounts type </th>
                                    <th>title </th>
                                    <th>amount</th>
                                    <th>presentage </th>
                                    <th>status</th>
                                    <th>actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($results))
                                    @foreach ($results as $index=>$result)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ @$result->discount_type->name }}</td>
                                            <td>{{ @$result->title }}</td>
                                            <td>{{ @$result->amount }}</td>
                                            <td>{{ @$result->presentage }}</td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="checkbox" wire:change='switch_status({{ $result->id }})' {{ ($result->is_active == 'Y' ? 'checked' : '') }}>
                                                    <span class="slider round"></span>
                                                  </label>
                                            </td>
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
    @include('livewire.discounts.form')

    <div wire:ignore.self class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="file" name="excel" wire:model.defer='excel'>
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
