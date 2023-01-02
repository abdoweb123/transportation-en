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
                                        <div class="form-group row ">
                                              <div class="col-md-12 mb-10">
                                                <label for="bus_id" class="mr-sm-2">contracts</label>
                                                <select name="bus_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='bus_id'>
                                                    <option value="0"> </option>
                                                    @if (isset($buses))
                                                        @foreach ($buses as $bus)
                                                            <option value="{{ $bus->id }}">{{ $bus->code }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('bus_id')<span style="color: red"> {{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label for="total_amount" class="mr-sm-2"> total amount</label>
                                                <input id="total_amount" type="number"  class="form-control" wire:model.lazy='total_amount'>
                                                @error('total_amount')<span style="color: red"> {{ $message }}</span>@enderror
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

                        {{-- <button type="button" class="btn btn-primary mb-10"  wire:click='switch'>
                            {{ $showForm == true ? 'show ' : 'add ' . $tittle }}
                            </button> --}}
                            {{--  <a href="{{ url('contract-client-edit/0') }}" class="btn btn-primary mb-10">{{ 'add ' . $tittle }}</a>  --}}
                            {{--  <a href="{{ url('company-contract-route') }}" class="btn btn-primary mb-10">company contract toute</a>  --}}

                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>bus </th>
                                    <th>total amount </th>
                                    <th>created at </th>
                                    <th>actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($results))
                                    @foreach ($results as $index=>$result)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ @$result->bus->name }}</td>
                                            <td>{{ @$result->total_amount }}</td>
                                            <td>{{ @$result->created_at }}</td>
                                            <td style="width: 15%">
                                                {{-- <button class="btn btn-primary"  title="تعديل"  wire:click='edit_form({{ $result->id }})'>
                                                    <i  class="fa fa-edit"></i>
                                                </button> --}}
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
