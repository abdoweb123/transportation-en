<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="driver_id" class="mr-sm-2">drivers</label>
                    <select name="driver_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='driver_id'>
                        <option value="0"> </option>
                        @if (isset($drivers))
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('driver_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
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
                    <label for="bus_type_id" class="mr-sm-2">bus types</label>
                    <select name="bus_type_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='bus_type_id'>
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
                    <label for="route_id" class="mr-sm-2">routes</label>
                    <select name="route_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='route_id'>
                        <option value="0"> </option>
                        @if (isset($routes))
                            @foreach ($routes as $route)
                                <option value="{{ $route->id }}">{{ $route->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('route_id')<span style="color: red"> {{ $message }}</span>@enderror
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
