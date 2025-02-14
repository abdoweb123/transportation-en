<div>
    <div>
        @if(Session::has('error_message'))
            <p class="alert alert-danger">{{ Session::get('message') }}</p>
        @endif
    </div>
    <form wire:submit.prevent='store_update'>
                <div class="form-group row">
                    <div class="col-md-6 mb-3">
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
                    <div class="col-md-6 mb-3">
                        <label for="bus_id">Bus</label>
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
                    <div class="col-md-6 mb-3">
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
                    <div class="col-md-6 mb-3">
                        <label for="date" class="mr-sm-2"> date </label>
                        <input id="date" type="date"  class="form-control" wire:model.lazy='date'>
                        @error('date')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="time" class="mr-sm-2"> time </label>
                        <input id="time" type="time"  class="form-control" wire:model.lazy='time'>
                        @error('time')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    {{-- <div class="col-md-6 mb-3">
                        <label for="company_id">Companies</label>
                        <select class="form-control mr-sm-2 p-2" name="company_id" wire:model.lazy='company_id'>
                            <option selected >choose</option>
                            @if(count($companies))
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('company_id')<span style="color: red"> {{ $message }}</span>@enderror
                    </div> --}}
                 
                   
                    <div class="col-md-6 mb-3">
                        <label for="amount" class="mr-sm-2">amount</label>
                        <input id="amount" type="number"  class="form-control" wire:model.lazy='amount'>
                        @error('amount')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="driver_pay" class="mr-sm-2">driver share</label>
                        <input id="driver_pay" type="number"  class="form-control" wire:model.lazy='driver_pay'>
                        @error('driver_pay')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="company_pay" class="mr-sm-2"> company share</label>
                        <input id="company_pay" type="number"  class="form-control" wire:model.lazy='company_pay'>
                        @error('company_pay')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="distance_reading" class="mr-sm-2"> distance_reading </label>
                        <input id="distance_reading" type="number"  class="form-control" wire:model.lazy='distance_reading'>
                        @error('distance_reading')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="employee_run_trip_id">employee run trip</label>
                        <select class="form-control mr-sm-2 p-2" name="employee_run_trip_id" wire:model.lazy='employee_run_trip_id'>
                            <option selected >choose</option>
                            @if(count($run_trip_emplyees))
                                @foreach($run_trip_emplyees as $run_trip)
                                    <option value="{{$run_trip->id}}">{{$run_trip->route->name .','.$run_trip->date .','. $run_trip->time}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('employee_run_trip_id')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description" class="mr-sm-2">Description</label>
                        <textarea name="" id="" cols="30" rows="10" class="form-control" wire:model.lazy='description'></textarea>
                        {{-- <input id="description" type="text" name="description" class="form-control" wire:model.lazy='description'> --}}
                        @error('description')<span style="color: red"> {{ $message }}</span>@enderror
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
