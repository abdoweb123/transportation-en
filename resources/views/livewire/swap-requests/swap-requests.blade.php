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
                        <p > <h4 style="text-align:center">Swap Request </h4> </p>

                        <br><br>
                        <label for=""><h4> new </h4></label>

                        {{-- <button type="button" class="btn btn-primary mb-10"  wire:click='switch'>
                            {{ $showForm == true ? 'show ' : 'add ' . $tittle }}
                            </button> --}}
                            {{-- <a href="{{ url('suplier-contract-route-edit/0') }}" class="btn btn-primary mb-10">{{ 'add ' . $tittle }}</a> --}}
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                style="text-align: center" >
                            <thead> 
                            <tr>
                                <th>#</th>
                                <th>Employee Name </th>
                                <th>From </th>
                                <th>To </th>
                                <th> Date </th>
                                <th> Time </th>
                                <th>actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($results))
                                @foreach ($results as $index=>$result)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ @$result->employee->name }}</td>
                                        <td>{{ @$result->from }}</td>
                                        <td>{{ @$result->to }}</td>
                                        <td>{{ @$result->date }}</td>
                                        <td>{{ @$result->time }}</td>
                                        <td style="width: 15%">
                                            <a href="javascript:void(0);" wire:click="defin_booking_request({{ @$result->id }})" class="btn btn-primary"  title="تعديل">Done</a>
                                            <button class="btn btn-danger" wire:click='make_delete({{ $result->id }})' title="حذف">
                                                Reject
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
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                        <label for=""><h4> rejected</h4></label>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                style="text-align: center" >
                            <thead> 
                            <tr>
                                <th>#</th>
                                <th>Employee Name </th>
                                <th>From </th>
                                <th>To </th>
                                <th> Date </th>
                                <th> Time </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($resultsRejected))
                                @foreach ($resultsRejected as $index=>$result)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ @$result->employee->name }}</td>
                                        <td>{{ @$result->from }}</td>
                                        <td>{{ @$result->to }}</td>
                                        <td>{{ @$result->date }}</td>
                                        <td>{{ @$result->time }}</td>
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
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <label for=""> <h4> is done</h4></label>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                style="text-align: center" >
                            <thead> 
                            <tr>
                                <th>#</th>
                                <th>Employee Name </th>
                                <th>From </th>
                                <th>To </th>
                                <th> Date </th>
                                <th> Time </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($resultsDone))
                                @foreach ($resultsDone as $index=>$result)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ @$result->employee->name }}</td>
                                        <td>{{ @$result->from }}</td>
                                        <td>{{ @$result->to }}</td>
                                        <td>{{ @$result->date }}</td>
                                        <td>{{ @$result->time }}</td>
                                       
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

        <div wire:ignore.self class="modal fade" id="edit" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                          Edit Booking
                       </h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <!-- add_form -->
                       <form  wire:submit.prevent='store_edit'>
                           <div class="row">
                               <div class="col">
                                   <label for="Name" class="mr-sm-2">Collection Point From :</label>
                                   <select class="form-control mr-sm-2 p-2" name="collection_point_from_id" wire:model.lazy='collection_point_from_id' required>
                                       <option class="custom-select" disabled>--- Choose ---</option>
                                      @isset($stations)
                                      @foreach($stations as $station)
                                           <option value="{{$station->id}}" >{{ $station->name }}</option>
                                       @endforeach
                                       @endisset
                                   </select>
                                   @error('collection_point_from_id')<span style="color: red">{{ $message }}</span>@enderror
                                </div>
                               <div class="col">
                                   <label for="Name_en" class="mr-sm-2">Collection Point To:</label>
                                   <select class="form-control mr-sm-2 p-2" name="collection_point_to_id" wire:model.lazy='collection_point_to_id' required>
                                       <option class="custom-select" disabled>--- Choose ---</option>
                                      @isset($stations)
                                      @foreach($stations as $station)
                                           <option value="{{$station->id}}" >{{ $station->name }}</option>
                                       @endforeach
                                       @endisset
                                   </select>
                                   @error('collection_point_to_id')<span style="color: red">{{ $message }}</span>@enderror
                               </div>
                           </div>
                           <div class="row">
                               <div class="col">
                                   <label for="city_id" class="mr-sm-2">Route :</label>
                                   <select class="form-control mr-sm-2 p-2" name="route_id" wire:model.lazy='route_id' required>
                                       <option class="custom-select" disabled>--- Choose ---</option>
                                      @isset($routes)
                                       @foreach($routes as $route)
                                           <option value="{{$route->id}}" >{{ $route->name }}</option>
                                       @endforeach
                                       @endisset
                                   </select>
                                   @error('route_id')<span style="color: red">{{ $message }}</span>@enderror
                               </div>
                               <div class="col">
                                   <label for="date" class="mr-sm-2">Date :</label>
                                   <input class="form-control" type="date" name="date"  wire:model.lazy='date' required>
                                   @error('date')<span style="color: red">{{ $message }}</span>@enderror
                               </div>
                           </div>
                           <div class="row">
                               <div class="col">
                                   <label for="time" class="mr-sm-2">Time :</label>
                                   <input class="form-control" type="time" wire:model.lazy='time' name="time" required>
                                   @error('time')<span style="color: red">{{ $message }}</span>@enderror
                               </div>
                           </div>
       
                           <br><br>
       
                           <div class="modal-footer">
                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                               <button type="submit" class="btn btn-success">Edit</button>
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
                window.livewire.on('show_modal', () => {
                    $('#edit').modal('show');
                });
                window.livewire.on('hide_modal', () => {
                    $('#edit').modal('hide');
                });
            });
        </script>
    @endsection
</div>
