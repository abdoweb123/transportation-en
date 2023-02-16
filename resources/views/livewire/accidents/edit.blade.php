<div>
    <div>
        @foreach(['danger','warning','success','info'] as $msg)
            @if(Session::has('alert-'.$msg))
                <div class="alert alert-{{$msg}}">
                    {{Session::get('alert-'.$msg)}}
                </div>
            @endif
        @endforeach

    </div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-6 mb-3">
                    <label for="accident_type_id">Accident Type <span style="color:red">*</span></label>
                    <select class="form-control mr-sm-2 p-2" name="accident_type_id" wire:model.lazy='accident_type_id'>
                        <option selected >choose</option>
                        @if(count($accident_types))
                            @foreach($accident_types as $accident_type)
                                <option value="{{$accident_type->id}}">{{$accident_type->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('accident_type_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="driver_id">Driver <span style="color:red">*</span></label>
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
                <div class="col-md-6 mb-3">
                    <label for="bus_id">Bus <span style="color:red">*</span></label>
                    <select class="form-control mr-sm-2 p-2" name="bus_id" wire:model.lazy='bus_id'>
                        <option selected >choose</option>
                        @if(count($buses))
                            @foreach($buses as $bus)
                                <option value="{{$bus->id}}">{{$bus->code}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('bus_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="payment_type" class="mr-sm-2">Stop Car</label><br>
                    <input type="radio"  wire:model='stop_car' id="age1" name="age" value="Y">
                    <label for="age1">Yes</label><br>
                    <input type="radio"  wire:model='stop_car' id="age2" name="age" value="N">
                    <label for="age2">No</label><br>  
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date" class="mr-sm-2"> Date <span style="color:red">*</span></label>
                    <input id="date" type="date"  class="form-control" wire:model.lazy='date'>
                    @error('date')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="time" class="mr-sm-2"> Time <span style="color:red">*</span></label>
                    <input id="time" type="time"  class="form-control" wire:model.lazy='time'>
                    @error('time')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fixing_amount" class="mr-sm-2">Fixing Amount <span style="color:red">*</span></label>
                    <input id="fixing_amount" type="number"  class="form-control" wire:model.lazy='fixing_amount'>
                    @error('fixing_amount')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="driver_pay" class="mr-sm-2"> Driver Share <span style="color:red">*</span></label>
                    <input id="driver_pay" type="number"  class="form-control" wire:model.lazy='driver_pay'>
                    @error('driver_pay')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="company_pay" class="mr-sm-2"> Company Share <span style="color:red">*</span></label>
                    <input id="company_pay" type="number"  class="form-control" wire:model.lazy='company_pay'>
                    @error('company_pay')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="insurance_pay" class="mr-sm-2"> Insurance Share <span style="color:red">*</span></label>
                    <input id="insurance_pay" type="number"  class="form-control" wire:model.lazy='insurance_pay'>
                    @error('insurance_pay')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
               
                <div class="col-md-12 mb-3">
                    <label for="distance_reading" class="mr-sm-2"> Distance Reading</label>
                    <input id="distance_reading" type="number"  class="form-control" wire:model.lazy='distance_reading'>
                    @error('distance_reading')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12">
                    <label for="description" class="mr-sm-2">Description</label>
                    <textarea name="" id="" cols="15" rows="3" class="form-control" wire:model.lazy='description'></textarea>
                    {{-- <input id="description" type="text" name="description" class="form-control" wire:model.lazy='description'> --}}
                    @error('description')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
            </div>
        </div>
        <br><br>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">close</button>
            <button type="submit" class="btn btn-success">{{ $ids != null ? 'edit' : 'save' }}</button>
        </div>
    </form>
</div>
