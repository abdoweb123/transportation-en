<div>
    <div class="card card-statistics h-100">
        <div class="card-body">
            <form wire:submit.prevent='store_update'>
                <div class="card-body col-md-8 offset-2">
                    <div class="form-group row">
                        <div class="col-md-12 mb-5">
                            <label for="description" class="mr-sm-2">Description</label>
                            <input id="description" type="text" name="description" class="form-control" wire:model.lazy='description'>
                            @error('description')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 mb-5">
                            <label for="penelty_type_id">penelty type</label>
                            <select class="form-control mr-sm-2 p-2" name="penelty_type_id" wire:model.lazy='penelty_type_id'>
                                <option selected >choose</option>
                                @if(count($penelty_types))
                                    @foreach($penelty_types as $penelty_type)
                                        <option value="{{$penelty_type->id}}">{{$penelty_type->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('penelty_type_id')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                         <div class="col-md-12 mb-5">
                            <label for="driver_id"> driver</label>
                            <select class="form-control mr-sm-2 p-2" name="driver_id" wire:model.lazy='driver_id'>
                                <option selected >choose</option>
                                @if(count($drivers))
                                    @foreach($drivers as $driver)
                                        <option value="{{$driver->id}}">{{$driver->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('driver_id')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 mb-5">
                            <label for="date" class="mr-sm-2"> date </label>
                            <input id="date" type="date"  class="form-control" wire:model.lazy='date'>
                            @error('date')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 mb-5">
                            <label for="amount" class="mr-sm-2">amount</label>
                            <input id="amount" type="number"  class="form-control" wire:model.lazy='amount'>
                            @error('amount')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 mb-5">
                            <label for="driver_pay" class="mr-sm-2">driver pay</label>
                            <input id="driver_pay" type="number"  class="form-control" wire:model.lazy='driver_pay'>
                            @error('driver_pay')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 mb-5">
                            <label for="company_pay" class="mr-sm-2"> company pay</label>
                            <input id="company_pay" type="number"  class="form-control" wire:model.lazy='company_pay'>
                            @error('company_pay')<span style="color: red"> {{ $message }}</span>@enderror
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
