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
                        {{-- <span class="text-muted mt-3 font-weight-bold font-size-sm">عدد الريكويست({{ $results->count() }})</span> --}}
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
                                        {{-- @if(auth('company')->user()->role_id == 1)
                                        <div class="col-md-4">
                                            <select wire:model='company_id' class="form-control mr-sm-2 p-2" style="width: 100%" wire:change="company_filter">
                                                <option value="">اختر الشركه</option>
                                                @isset($companies)
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        @endif --}}
                                        {{-- <div class="col-md-4">
                                            <select wire:model='user_id' class="form-control mr-sm-2 p-2" style="width: 100%" wire:change='user_filter'>
                                                <option value="">اختر الموظف</option>
                                                @isset($users)
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div> --}}
                                        <div class="col-md-4">
                                            <button class="btn btn-success" wire:click='download_report_one'><i class="fa fa-download"></i> excel</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-3">
                                    <select wire:model='state_id' class="form-group" style="width: 100%">
                                        <option value="0">اختر</option>
                                        @isset($states)
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div> -->
                        </div>

                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>year  </th>
                                    <th> month</th>
                                    <th>client name  </th>
                                    <th> contract start date  </th>
                                    <th> contract end date </th>
                                    <th> number of contracted lines </th>
                                    <th>  line name </th>
                                    <th>  bus type </th>
                                    <th>  services type </th>
                                    <th>  services value </th>
                                    <th>  Number of runs </th>
                                    <th>  total of revenues </th>
                                    <th>  count of penelties </th>
                                    <th>  total of penelties </th>
                                    <th>  Net revenue   </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $index=>$result)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse(@$result->contract->start_date)->format('Y')}}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse(@$result->contract->start_date)->format('M')}}
                                            </td>
                                            <td>{{ @$result->company->name }}</td>
                                            <td>{{ @$result->contract->start_date }}</td>
                                            <td>{{ @$result->contract->end_date }}</td>
                                            <td>{{ @$result->contract->cotract_routes_count }}</td>
                                            <td>{{ @$result->route->name }}</td>
                                            <td>{{ @$result->bus_type->name }}</td>
                                            <td>{{ @$result->service_type->name }}</td>
                                            <td>{{ @$result->service_value }}</td>
                                            <td>{{ @$result->route->employeeRunTrips->count() }}</td>
                                            <td>{{ @$result->route->employeeRunTrips->count() * @$result->service_value }}</td>
                                            <td>{{ @$result->route->employeeRunTrips->count('penelties_count') }}</td>
                                            <td>{{ @$result->route->employeeRunTrips->sum('penelties_sum_amount') - @$result->discounts_sum_discount_value }}</td>
                                            <td>{{ (@$result->route->employeeRunTrips->count() * @$result->service_value) - @$result->route->employeeRunTrips->sum('penelties_sum_amount') }}</td>
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
            $('#one_product_recovery').modal('hide');
            });
            window.livewire.on('showDelete', () => {
            $('#one_product_recovery').modal('show');
            });
        });
        </script>
    @endsection
</div>
