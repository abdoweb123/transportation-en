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
                    <label for="bus_id" class="mr-sm-2">buses</label>
                    <select name="bus_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='bus_id'>
                        <option value="0"> </option>
                        @if (isset($buses))
                            @foreach ($buses as $bus)
                                <option value="{{ $bus->id }}">{{ $bus->code }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('bus_id')<span style="color: red"> {{ $message }}</span>@enderror
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
                <div class="col-md-6 mb-2">
                    <label for="kilometer" class="mr-sm-2">kilometer</label>
                    <input id="kilometer" type="number" class="form-control" wire:model.lazy='kilometer'>
                    @error('kilometer')<span style="color: red"> {{ $message }}</span>@enderror
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
                <div class="col-md-6 mb-2">
                    <label for="gas_amount" class="mr-sm-2">gas amount</label>
                    <input id="gas_amount" type="number" class="form-control" wire:model.lazy='gas_amount'>
                    @error('gas_amount')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                  <div class="col-md-12 mb-2">
                    <label for="paid_amount" class="mr-sm-2">paid amount</label>
                    <input id="paid_amount" type="number" class="form-control" wire:model.lazy='paid_amount'>
                    @error('paid_amount')<span style="color: red"> {{ $message }}</span>@enderror
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
