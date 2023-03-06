 <div>
 
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-danger">
                                <i class="fa fa-bar-chart-o highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">companies</p>
                            <h4>{{ @$companies }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> 81% lower
                        growth
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-warning">
                                <i class="fa fa-shopping-cart highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">drivers</p>
                            <h4>{{ @$drivers }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-bookmark-o mr-1" aria-hidden="true"></i> Total drivers
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                <i class="fa fa-dollar highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">buses</p>
                            <h4>{{ @$buses }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-calendar mr-1" aria-hidden="true"></i> Sales Per Week
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-12 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-primary">
                                <i class="fa fa-twitter highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">vendors</p>
                            <h4>{{ @$vendors }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-repeat mr-1" aria-hidden="true"></i> Just Updated
                    </p>
                </div>
            </div>
        </div>
        <div class="card card-statistics h-100 w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">
                            <h5>booking request</h5>
                        </label>
                        <table class="table table-striped table-hover table-sm table-bordered p-0" data-page-length="50"
                                style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Collection Point From</th>
                                <th>Collection Point To</th>
                                <th>Route</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Entered By</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($booging_request as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>@isset($item->collection_point_from->name)  {{ $item->collection_point_from->name }} @else _______ @endisset</td>
                                    <td>@isset($item->collection_point_to->name)  {{ $item->collection_point_to->name }} @else _______ @endisset</td>
                                    <td>@isset($item->route->name)  {{ $item->route->name }} @else _______ @endisset</td>
                                    <td>{{$item->date}}</td>
                                    <td>{{$item->time}}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-md-6">
                        <label for="">
                            <h5>reminder history</h5>
                        </label>
                        <table class="table table-striped table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                     <thead>
                     <tr>
                         <th>#</th>
                         <th>Reminder Id</th>
                         <th>Vendor Name</th>
                         <th>Total Paid</th>
                         <th>Cost Per Day</th>
                         <th>Done</th>
                         <th>Entered By</th>
                         <th>Status</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach ($reminderhistories as $item)
                         <tr>
                             <td>{{ $loop->index+1 }}</td>
                             <td>@isset($item->reminder->id) <a href="{{route('getReminder',$item->reminder->id)}}" style="color:red">{{ $item->reminder->id }}</a> @else _____ @endisset</td>
                             <td>@isset($item->vendor->name)  {{ $item->vendor->name }} @else _____ @endisset</td>
                             <td>{{ $item->total_paid }}</td>
                             <td>{{ $item->cost_per_day  }}</td>
                             <td>{{$item->done == 1 ? 'Done' : '_____'}}</td>
                             <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                             <td>{{$item->active == 1 ? 'active' : 'un active'}}</td>
                         </tr>
                     @endforeach
                 </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">
                            <h5>Gases</h5>
                        </label>
                        <table class="table table-striped table-hover table-sm table-bordered p-0" data-page-length="50"
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
                     </tr>
                     </thead>
                     <tbody>
                     @if (count($gases))
                         @foreach ($gases as $index=>$result)
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
                             </tr>
                         @endforeach
                     @endif
                 </table>
                    </div>
                    <div class="col-md-6">
                        <label for="">
                            <h5>reminder history</h5>
                        </label>
                        <table class="table table-striped table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center" >
                     <thead>
                     <tr>
                         <th>#</th>
                         <th>driver </th>
                         <th>payment type </th>
                         <th>bus type </th>
                         <th>route </th>
                     </tr>
                     </thead>
                     <tbody>
                     @if (count($driver_salaries))
                         @foreach ($driver_salaries as $index=>$result)
                             <tr>
                                 <td>{{ $index+1 }}</td>
                                 <td>{{ @$result->driver->name }}</td>
                                 <td>{{trans('main_trans.payment_type')[@$result->payment_type] }}</td>
                                 <td>{{ @$result->bus_type->name }}</td>
                                 <td>{{ @$result->route->name }}</td>
                                 
                             </tr>
                         @endforeach
                     @endif
                 </table>
                    </div>
                </div>
            </div>
        </div>
        

<div class="modal fade" id="one_product_recovery" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">reminder</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
            </button>
        </div>
        <div class="modal-body">
            @if($reminders_exist != null)
                @foreach ($reminders_exist as $item)
                    <h6>Car:{{ $item->bus->code }} has a reminder </h6>
                    <p> {{ $item->issue->category->name }}</p><br>
                    <p> {{ $item->task }}</p><br>
                    <a href="{{ url('reminder-history?action=edit&id='.$item->id) }}" class="btn btn-primary">done</a>
                    <hr>
                @endforeach
                {{-- <table  class="table  table-hover table-sm table-bordered p-0" data-page-length="50"style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Bus Code</th>
                                <th>Category Issue</th>
                                <th>Reminder Days</th>
                                <th>Threeshold Days</th>
                                <th>Start Date</th>
                                <th>Distance</th>
                                <th>Threeshold Distance</th>
                                <th>Task</th>
                                <th>Status</th>
                                <th>Entered By</th>
                                <th>Processes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($reminders_exist as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>@isset($item->bus->code)  {{ $item->bus->code }} @else _____ @endisset</td>
                                    <td>@isset($item->issue->category->name)  {{ $item->issue->category->name }} @else _____ @endisset</td>
                                    <td>{{ $item->reminder_days}}</td>
                                    <td>{{ $item->threeshold_days}}</td>
                                    <td>{{ $item->start_date}}</td>
                                    <td>{{ $item->distance}}</td>
                                    <td>{{ $item->threeshold_distance}}</td>
                                    <td>{{ $item->task}}</td>
                                    <td>{{ $item->active == 1 ? 'active' : 'un active'}}</td>
                                    <td>@isset($item->admin->name)  {{ $item->admin->name }} @else _____ @endisset</td>
                                    <td>
                                        <a href="{{ url('reminder-history?action=edit&id='.$item->id) }}" class="btn btn-primary">done</a>
                                    </td>
                                </tr>
                            @endforeach
                </table> --}}
            @endif
               
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
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
      @if( $reminders_exist != null)
      <script>
        $(function() {
          $('#one_product_recovery').modal('show');
        });
      </script>
      @endif
       <script>
          $(document).ready(function(){
                window.livewire.on('remove_modal', () => {
                    $('#edit_bill_product').modal('hide');
                });
            });
      </script>
  @endsection

</div>