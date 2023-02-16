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
    <livewire:static-tables.edit :type="$type">
@else
@php
     $amount_dics='d-none';
    if ($type == 'gas_type') {
        $amount_dics='';
    }
@endphp
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name </th>
                                    <th class="{{ $amount_dics }}">price </th>
                                    <td>status</td>
                                    <th>action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($results))
                                    @foreach ($results as $index=>$result)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ @$result->name }}</td>
                                            <td class="{{ $amount_dics }}">{{ @$result->amount }}</td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="checkbox" wire:change='active_ms({{ $result->id }})' {{ ($result->is_active == 'Y' ? 'checked' : '') }}>
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
    @include('livewire.static-tables.form')
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
