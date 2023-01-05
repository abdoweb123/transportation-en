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
                                            <div class="col-md-6">
                                                <label for="contracts_id" class="mr-sm-2">contracts</label>
                                                <select name="contracts_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='contracts_id'>
                                                    <option value="0"> </option>
                                                    @if (isset($contracts))
                                                        @foreach ($contracts as $contract)
                                                            <option value="{{ $contract->id }}">{{ $contract->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('contracts_id')<span style="color: red"> {{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="company_id" class="mr-sm-2">companies</label>
                                                <select name="company_id" id="" class="form-control mr-sm-2 p-2" wire:model.lazy='company_id'>
                                                    <option value="0"> </option>
                                                    @if (isset($companies))
                                                        @foreach ($companies as $company)
                                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('company_id')<span style="color: red"> {{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="route_id" class="mr-sm-2">routes</label>
                                                <select name="route_id" id="" class="form-control mr-sm-2 p-2" wire:model.lazy='route_id'>
                                                    <option value="0"> </option>
                                                    @if (isset($routes))
                                                        @foreach ($routes as $route)
                                                            <option value="{{ $route->id }}">{{ $route->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('route_id')<span style="color: red"> {{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="bus_type_id" class="mr-sm-2">bus_types</label>
                                                <select name="bus_type_id" id="" class="form-control mr-sm-2 p-2" wire:model.lazy='bus_type_id'>
                                                    <option value="0"> </option>
                                                    @if (isset($bus_types))
                                                        @foreach ($bus_types as $bus_type)
                                                            <option value="{{ $bus_type->id }}">{{ $bus_type->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('bus_type_id')<span style="color: red"> {{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="service_type_id" class="mr-sm-2">service_type</label>
                                                <select name="service_type_id" id="" class="form-control mr-sm-2 p-2" wire:model.lazy='service_type_id'>
                                                    <option value="0"> </option>
                                                    @if (isset($service_types))
                                                        @foreach ($service_types as $service_type)
                                                            <option value="{{ $service_type->id }}">{{ $service_type->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('service_type_id')<span style="color: red"> {{ $message }}</span>@enderror
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <label for="service_value" class="mr-sm-2">service value</label>
                                                <input id="service_value" type="number"  class="form-control" wire:model.lazy='service_value'>
                                                @error('service_value')<span style="color: red"> {{ $message }}</span>@enderror
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
                            {{--  <a href="{{ url('company-contract-route-edit/0') }}" class="btn btn-primary mb-10">{{ 'add ' . $tittle }}</a>  --}}

                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                   style="text-align: center" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>contracts </th>
                                    <th>company </th>
                                    <th>routes </th>
                                    <th> bus type </th>
                                    <th> services type </th>
                                    <th> services value </th>
                                    <th>actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($results))
                                    @foreach ($results as $index=>$result)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ @$result->contract->name }}</td>
                                            <td>{{ @$result->company->name }}</td>
                                            <td>{{ @$result->route->name }}</td>
                                            <td>{{ @$result->bus_type->name }}</td>
                                            <td>{{ @$result->service_type->name }}</td>
                                            <td>{{ @$result->service_value }}</td>
                                            <td style="width: 15%">
                                                <a href="{{ url('/company-contract-route-edit/'.$result->id) }}" class="btn btn-primary"  title="تعديل"><i  class="fa fa-edit"></i></a>
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
                window.livewire.on('toggle', () => {
                      e.preventDefault();
                        var thisAnswer = e.target.parentNode.nextElementSibling;
                        var thisQuestion = e.target;
                        if (thisAnswer.classList.contains("is-collapsed")) {
                        setAccordionAria(thisQuestion, thisAnswer, "true");
                        } else {
                        setAccordionAria(thisQuestion, thisAnswer, "false");
                        }
                        thisQuestion.classList.toggle("is-collapsed");
                        thisQuestion.classList.toggle("is-expanded");
                        thisAnswer.classList.toggle("is-collapsed");
                        thisAnswer.classList.toggle("is-expanded");

                        thisAnswer.classList.toggle("animateIn");
                    };
                    for (var i = 0, len = accordionToggles.length; i < len; i++) {
                        if (touchSupported) {
                        accordionToggles[i].addEventListener("touchstart", skipClickDelay, false);
                        }
                        if (pointerSupported) {
                        accordionToggles[i].addEventListener(
                            "pointerdown",
                            skipClickDelay,
                            false
                        );
                        }
                        accordionToggles[i].addEventListener("click", switchAccordion, false);
                    }
            });
        </script>
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
