<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
               <div class="col-md-12 mb-2">
                    <label for="description" class="mr-sm-2">description</label>
                    <input id="description" type="text" class="form-control" wire:model.lazy='description'>
                    @error('description')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="type_id" class="mr-sm-2">types</label>
                    <select name="type_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='type_id'>
                        <option value="0"> </option>
                        @if (isset($types))
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('type_id')<span style="color: red"> {{ $message }}</span>@enderror
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
               
                <div class="col-md-6 mb-2">
                    <label for="amount" class="mr-sm-2">amount</label>
                    <input id="amount" type="number" class="form-control" wire:model.lazy='amount'>
                    @error('amount')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
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
