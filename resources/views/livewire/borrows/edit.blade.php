<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-6 mb-2">
                    <label for="driver_id">السواق</label>
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
                <div class="col-md-6 mb-2">
                    <label for="borrow_type_id">نوع السلف</label>
                    <select class="form-control mr-sm-2 p-2" name="borrow_type_id" wire:model.lazy='borrow_type_id'>
                    <option selected >choose</option>
                        @if(count($borrow_types))
                            @foreach($borrow_types as $borrow_type)
                                <option value="{{$borrow_type->id}}">{{$borrow_type->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('borrow_type_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="date" class="mr-sm-2">التاريخ </label>
                    <input id="date" type="date"  class="form-control" wire:model.lazy='date'>
                    @error('date')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="amount" class="mr-sm-2"> التكلفه</label>
                    <input id="amount" type="number"  class="form-control" wire:model.lazy='amount'>
                    @error('amount')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
            </div>
        </div>
        <br><br>
        <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">close</button>
            <button type="submit" class="btn btn-success">{{ $ids != null ? 'edit' : 'save' }}</button>
    </form>
</div>
