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
    <style>
        
.nttable .parent .second {
    border: 1px solid #000;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}

.nttable .parent .second .bord {
    border-left: 1px solid #000;
}

.nttable .parent .second .box {
    text-align: center;
    padding: 5px 30px;
    width: 50%;
}

.nttable .parent .second .box p {
    margin-bottom: 0;
    font-size: 19px;
}
    </style>
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
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-10">
                                        @foreach ($templates as $index=>$template)
                                            <div class="row w-100 mb-2">
                                                <div class="col-md-3">
                                                    <span class="form-control mr-sm-2 p-2">collection {{ $index+1 }}</span> 
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-control mr-sm-2 p-2" name="bus_id" wire:model='bus_id.{{ $index }}' required>
                                                        <option class="custom-select" >--- Choose Bus ---</option>
                                                        @foreach($buses as $bus)
                                                            <option value="{{$bus->id}}">{{ $bus->code }}  ({{@$bus->busType->slug  }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-control mr-sm-2 p-2" name="driver_id" wire:model='driver_id.{{ $index }}' required>
                                                        <option class="custom-select" >--- Choose Driver ---</option>
                                                        @foreach($drivers as $driver)
                                                            <option value="{{$driver->id}}">{{ $driver->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="submite"  class="btn btn-danger" wire:click.prevent='remove({{ $index }})'><i class="far fa-trash-alt"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submite"  class="btn btn-primary btn-sm"  wire:click.prevent='add'><i class="fas fa-plus-circle text-white"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                {{-- <table class="table table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>company</th>
                                            <th>route</th>
                                            <th>date</th>
                                            <th>time</th>
                                            <th>total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td>{{ @$employee_runtrip->company->name }}</td>
                                        <td>{{ @$employee_runtrip->route->name }}</td>
                                        <td>{{ @$employee_runtrip->date }}</td>
                                        <td>{{ @$employee_runtrip->time }}</td>
                                        <td>{{ @$employee_runtrip->total }}</td>
                                    <tbody>
                                </table> --}}
                                <div class="nttable">
                                    <div class="container">
                                        {{-- <div class="row" style="text-align: start"> --}}
                                            <div class="parent">
                                                <div class="second">
                                                    <div class="box bord">
                                                        <p>
                                                            company
                                                        </p>
                                                    </div>
                                                    <div class="box">
                                                        <p>
                                                            {{ @$employee_runtrip->company->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="second">
                                                    <div class="box bord">
                                                        <p>
                                                            route
                                                        </p>
                                                    </div>
                                                    <div class="box">
                                                        <p>
                                                            {{ @$employee_runtrip->route->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="second">
                                                    <div class="box bord">
                                                        <p>
                                                            date
                                                        </p>
                                                    </div>
                                                    <div class="box">
                                                        <p>
                                                            {{ @$employee_runtrip->date }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="second">
                                                    <div class="box bord">
                                                        <p>
                                                            time
                                                        </p>
                                                    </div>
                                                    <div class="box">
                                                        <p>
                                                            {{ @$employee_runtrip->time }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <button type="button" class="btn btn-primary mb-10"  wire:click='switch'>
                            {{ $showForm == true ? 'show ' : 'add ' . $tittle }}
                        </button> --}}
@if ($showForm == true)
    <livewire:employee-run-trips.edit >
@else
                        <div class="table-responsive">
                            <table  class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>Oracle Id</th>
                                    <th>from</th>
                                    <th>to</th>
                                    <th>collections</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (($booking_requests ))
                                    @foreach ($booking_requests as $itemindex=>$item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ (@$item->myEmployee->name)  }}</td>
                                        <td>{{ (@$item->myEmployee->oracle_id)  }}</td>
                                        <td>{{ @$item->collection_point_from_id  }}</td>
                                        <td>{{ @$item->collection_point_to_id  }}</td>
                                        <td>
                                            @foreach ($templates as $index=>$template)
                                                {{-- <label for="">
                                                    <input type="radio" id="age{{ $index . $itemindex }}" value="{{ $index }}" wire:model='collection_selected.{{ $itemindex }}.{{ $index }}'>Collection  {{ @$index+1 }}
                                                </label> --}}
                                                
                                                {{-- <input type="radio" id="{{ $template }}{{ $itemindex }}{{ $index }}" name="{{ $itemindex }}" value="{{ $index }}" wire:model.defer='collection_selected.{{ $itemindex }}.{{ $index }}'> --}}
                                                <input type="checkbox" id="{{ $template }}{{ $itemindex }}{{ $index }}" name="{{ $itemindex }}" value="{{ $index }}" wire:model='collection_selected.{{ $itemindex }}.{{ $index }}' wire:click='count_arr({{ $index }},{{ $itemindex }})'>
                                                <label for="age1">Collection  {{ @$index+1 }}</label><br>
                                               
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                        <div style="text-align: end">
                            <button class="btn btn-primary" wire:click.prevent='collection_selecte'>save</button>
                        </div>

                    </div>
                </div>
    </div>
 
@endif
    </div>
</div>
