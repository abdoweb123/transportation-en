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
                                    <th style="background-color:#000000; color:white">{{ trans('main_trans.year') }}  </th>
                                    <th style="background-color:#000000; color:white"> {{ trans('main_trans.month') }}</th>
                                    <th style="background-color:#000000; color:white">{{ trans('main_trans.client_name') }} </th>
                                    <th style="background-color:#000000; color:white">{{ trans('main_trans.bus_type') }}</th>
                                    <th style="background-color:#000000; color:white">{{ trans('main_trans.servic_type') }} </th>
                                     <th style="background-color:#00b0f0; color:white">{{ trans('main_trans.service_value') }}</th>
                                    <th style="background-color:#00b0f0; color:white">{{ trans('main_trans.number_of_maintenance') }} </th>
                                     <th style="background-color:#00b0f0; color:white">{{ trans('main_trans.number_of_spare_parts_used') }} </th>
                                     <th style="background-color:#00b0f0; color:white">{{ trans('main_trans.total_maintenance_value') }} </th>
                                    <th style="background-color:#002060; color:white">{{ trans('main_trans.count_of_penelties') }} </th>
                                    <th style="background-color:#002060; color:white">{{ trans('main_trans.total_of_penelties') }} </th>
                                    <th style="background-color:#974706; color:white">{{ trans('main_trans.Accident_Count') }}</th>
                                    <th style="background-color:#974706; color:white">{{ trans('main_trans.insurance_Pay') }}</th>
                                    <th style="background-color:#974706; color:white">{{ trans('main_trans.Company_pay') }}</th>
                                    <th style="background-color:#974706; color:white">{{ trans('main_trans.driver_pay') }}</th>
                                    <th style="background-color:#974706; color:white">{{ trans('main_trans.fixing_Amount') }}</th>
                                    <th style="background-color: #808080; color:white">{{ trans('main_trans.debt_Amount') }}</th>
                                    <th style="background-color: #808080; color:white">{{ trans('main_trans.total_debt') }}</th>
                                    <th style="background-color:#808080; color:white">{{ trans('main_trans.driver_numbers') }}</th>
                                    <th style="background-color:#808080; color:white">{{ trans('main_trans.total_driver_amount') }} </th>
                                    <th style="background-color: #ffff00; color:white">{{ trans('main_trans.total_gas') }}</th>
                                    <th style="background-color:#f79646; color:white">{{ trans('main_trans.extera_fees') }}</th>
                                    <th style="background-color:#4f6228; color:white">{{ trans('main_trans.total_expenses') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $index=>$result)
                                    {{-- @dd($result) --}}
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
                                            <td>{{ trans('main_trans.payment_type')[@$result->busType->contract_route->payment_type] }}</td>
                                            <td>{{ @$result->busType->contract_route->service_value }}</td>
                                            <td><a href="{{ url('maintance-details/'.$result->id) }}"> {{ @$result->reminders->count() }}</a></td>
                                            <td><a href="{{ url('maintance-details/'.$result->id) }}">{{ @$result->reminders->count('reminderHistories') }}</a></td>
                                            <td>
                                                {{-- {{ (@$result->reminders->count('reminderHistories') != null ? @$result->reminders->withSum('reminderHistories','total_paid') : 0 )}} --}}
                                                <a href="{{ url('maintance-details/'.$result->id) }}">{{ (@$result->reminders->sum('reminder_histories_sum_total_paid'))}}</a>
                                            </td>
                                            <td><a href="{{ url('penalty-details/'.$result->id) }}">{{ @$result->penelties->count() }}</a></td>
                                            <td><a href="{{ url('penalty-details/'.$result->id) }}">{{ @$result->penelties->sum('amount') }}</a></td>
                                            <td><a href="{{ url('accident-details/'.$result->id) }}">{{ @$result->accidents->count() }}</a></td>
                                            <td><a href="{{ url('accident-details/'.$result->id) }}">{{ @$result->accidents->sum('insurance_pay') }}</a></td>
                                            <td><a href="{{ url('accident-details/'.$result->id) }}">{{ @$result->accidents->sum('company_pay') }}</a></td>
                                            <td><a href="{{ url('accident-details/'.$result->id) }}">{{ @$result->accidents->sum('driver_pay') }}</a></td>
                                            <td><a href="{{ url('accident-details/'.$result->id) }}">{{ @$result->accidents->sum('fixing_amount') }}</a></td>
                                            <td><a href="{{ url('debt-details/'.$result->id) }}">{{ @$result->payments->count("car_payment_dates") }}</a></td>
                                            <td><a href="{{ url('debt-details/'.$result->id) }}">{{ @$result->payments->sum('total_amount')}}</a></td>
                                            <td>{{ @$result->employee_run_trip_buses->count()}}</td>
                                            <td>{{ @$total_amount_driver }}</td>
                                            <td><a href="{{ url('fuel-details/'.$result->id) }}">{{ @$result->gas->sum('amount')}}</a></td>
                                            <td><a href="{{ url('extera-fees/'.$result->id) }}">{{ @$result->extera_fees->sum('amount')}}</a></td>
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
