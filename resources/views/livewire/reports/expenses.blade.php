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
                                    <th>year  </th>
                                    <th> month</th>
                                    <th>client name  </th>
                                    <th> bus type </th>
                                    <th> service type </th>
                                    <th> service value </th>
                                    <th>number of maintenance </th>
                                    <th>total maintenance value </th>
                                    <th>  count of penelties </th>
                                    <th>  total of penelties </th>
                                    <th> Accident Count </th>
                                    <th> insurance Pay </th>
                                    <th> Company pay </th>
                                    <th> fixing Amount </th>
                                    <th> debt Amount </th>
                                    <th> total debt </th>
                                    <th> driver numbers </th>
                                    <th> total driver amount </th>
                                    <th> total gas </th>
                                    <th> extera fees </th>
                                    <th> total expenses </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $index=>$result)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse(@$result->busType->contract_route->contract->created_at)->format('Y')}}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse(@$result->busType->contract_route->contract->created_at)->format('M')}}
                                            </td>
                                            <td>{{ @$result->busType->contract_route->contract->company->name }}</td>
                                            <td>{{ @$result->busType->name }}</td>
                                            <td>{{ @$result->busType->contract_route->service_type->name }}</td>
                                            <td>{{ @$result->busType->contract_route->service_value }}</td>
                                            <td>{{ @$result->reminders->count() }}</td>
                                            <td>
                                                {{-- {{ (@$result->reminders->count('reminderHistories') != null ? @$result->reminders->sum('reminderHistories','total_paid') : 0 )}} --}}
                                            </td>
                                            <td>{{ @$result->penelties->count() }}</td>
                                            <td>{{ @$result->penelties->sum('amount') }}</td>
                                            <td>{{ @$result->accidents->count() }}</td>
                                            <td>{{ @$result->accidents->sum('insurance_pay') }}</td>
                                            <td>{{ @$result->accidents->sum('company_pay') }}</td>
                                            <td>{{ @$result->accidents->sum('fixing_amount') }}</td>
                                            <td>{{ @$result->payments->count("car_payment_dates") }}</td>
                                            <td>{{ @$result->payments->sum('total_amount')}}</td>
                                            <td>{{ @$result->employee_run_trip_buses->count()}}</td>
                                            <td>{{ @$total_amount_driver }}</td>
                                            <td>{{ @$result->gas->sum('amount')}}</td>
                                            <td>{{ @$result->extera_fees->sum('amount')}}</td>
                                            <td>{{ (@$result->payments->sum('total_amount') != null ? @$result->payments->sum('total_amount') : 0)+ @$result->penelties->sum('amount')  + @$result->extera_fees->sum('amount') + @$result->gas->sum('amount') }}</td>
                                        </tr>
                                    @endforeach
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
