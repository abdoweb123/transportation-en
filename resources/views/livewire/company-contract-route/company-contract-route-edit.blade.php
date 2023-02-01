<div>
    <div class="card card-statistics h-100">
        <div class="card-body">
            <form wire:submit.prevent='store_update'>
                <div class="card-body col-md-8 offset-2">
                    <div class="form-group row">
                        {{-- <div class="col-md-6">
                            <label for="contracts_id" class="mr-sm-2">contracts</label>
                            <select name="contracts_id" id="" class="w-100 mb-10" wire:model.lazy='contracts_id'>
                                <option value="0"> </option>
                                @if (isset($contracts))
                                    @foreach ($contracts as $contract)
                                        <option value="{{ $contract->id }}">{{ $contract->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('contracts_id')<span style="color: red"> {{ $message }}</span>@enderror
                        </div> --}}
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
                            <select name="service_type_id" id=""class="form-control mr-sm-2 p-2" wire:model.lazy='service_type_id'>
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
                            <input id="service_value" type="number" class="form-control " wire:model.lazy='service_value'>
                            @error('service_value')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        {{-- <div class="col-md-6">
                            <label for="discount_id" class="mr-sm-2">discount</label>
                            <select name="discount_id" id="" class="form-control mr-sm-2 p-2" wire:model.lazy='discount_id'>
                                <option value="0"> </option>
                                @if (isset($discounts))
                                    @foreach ($discounts as $discount)
                                        <option value="{{ $discount->id }}">{{ $discount->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('discount_id')<span style="color: red"> {{ $message }}</span>@enderror
                        </div> --}}
                        <div class="col-md-6">
                            <label for="payment_type" class="mr-sm-2">payment types</label>
                            <select name="payment_type" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='payment_type'>
                                <option value="0"> </option>
                                @if (count(trans('main_trans.payment_type')))
                                    @foreach (trans('main_trans.payment_type') as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('payment_type')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="payment_type" class="mr-sm-2">Rate Charge</label><br>
                            <input type="radio"  wire:model='rate_charge' id="age1" name="age" value="Y">
                            <label for="age1">Apply Route Cahrge</label><br>
                            <input type="radio"  wire:model='rate_charge' id="age2" name="age" value="N">
                            <label for="age2">Not Apply Route Cahrge</label><br>  
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
    </div>
</div>
