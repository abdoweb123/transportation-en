<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="description" class="mr-sm-2">description</label>
                    <input id="description" type="text" name="description" class="form-control" wire:model.lazy='description'>
                    @error('description')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-5">
                    <label for="driver_id">Driver</label>
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
                    <label for="fixing_amount" class="mr-sm-2">fixing amount</label>
                    <input id="fixing_amount" type="number"  class="form-control" wire:model.lazy='fixing_amount'>
                    @error('fixing_amount')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-5">
                    <label for="driver_pay" class="mr-sm-2"> driver pay;</label>
                    <input id="driver_pay" type="number"  class="form-control" wire:model.lazy='driver_pay'>
                    @error('driver_pay')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-5">
                    <label for="company_pay" class="mr-sm-2"> company pay</label>
                    <input id="company_pay" type="number"  class="form-control" wire:model.lazy='company_pay'>
                    @error('company_pay')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-5">
                    <label for="insurance_pay" class="mr-sm-2"> insurance pay</label>
                    <input id="insurance_pay" type="number"  class="form-control" wire:model.lazy='insurance_pay'>
                    @error('insurance_pay')<span style="color: red"> {{ $message }}</span>@enderror
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
