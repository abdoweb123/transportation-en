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
                    <div class="col-md-6">
                        <label for="Name" class="mr-sm-2">Route :</label>
                        <select class="form-control mr-sm-2 p-2" name="route_id" wire:model='route_id'>
                            <option class="custom-select" >--- Choose ---</option>
                            @foreach($routes as $route)
                                <option value="{{$route->id}}">{{ $route->name }}</option>
                            @endforeach
                        </select>
                        @error('route_id')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="Name_en" class="mr-sm-2">Date :</label>
                        <input class="form-control" type="date"  wire:model.lazy='date'  id="datepicker-action" name="date" data-date-format="yyyy-mm-dd">
                        @error('date')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="Name_en" class="mr-sm-2">Time :</label>
                        <input class="form-control" type="time"  name="time" wire:model.lazy='time'>
                        @error('time')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="penelty_value" class="mr-sm-2">penelty value :</label>
                        <input class="form-control" type="number"  wire:model.lazy='penelty_value'>
                        @error('penelty_value')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="service_value" class="mr-sm-2">service value :</label>
                        <input class="form-control" type="number" wire:model.lazy='service_value'>
                        @error('service_value')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="supplier_value" class="mr-sm-2">supplier value :</label>
                        <input class="form-control" type="number" wire:model.lazy='supplier_value'>
                        @error('supplier_value')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="penalty_type_id" class="mr-sm-2">Pnalty Type :</label>
                        <select class="form-control mr-sm-2 p-2" name="penalty_type_id"  wire:model.lazy='penalty_type_id'>
                            <option class="custom-select mr-sm-2 p-2" >--- Choose ---</option>
                            @foreach($penalty_types as $penalty_type)
                                <option value="{{$penalty_type->id}}" >{{ $penalty_type->name }}</option>
                            @endforeach
                        </select>
                        @error('penalty_type_id')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="station_id" class="mr-sm-2">company :</label>
                        <select class="form-control mr-sm-2 p-2" name="company_id"  wire:model.lazy='company_id'>
                            <option class="custom-select mr-sm-2 p-2" >--- Choose ---</option>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}" >{{ $company->name }}</option>
                            @endforeach
                        </select>
                        @error('company_id')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>


                    <div class="col-md-6">
                        <label for="station_id" class="mr-sm-2">Driver :</label>
                        <select class="form-control mr-sm-2 p-2" name="driver_id"  wire:model.lazy='driver_id'>
                            <option class="custom-select mr-sm-2 p-2" >--- Choose ---</option>
                            @foreach($drivers as $driver)
                                <option value="{{$driver->id}}" >{{ $driver->name }}</option>
                            @endforeach
                        </select>
                        @error('driver_id')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="station_id" class="mr-sm-2">Bus :</label>
                        <select class="form-control mr-sm-2 p-2"  wire:model='bus_id'>
                            <option class="custom-select mr-sm-2 p-2" >--- Choose ---</option>
                            @foreach($buses as $bus)
                            <option value="{{$bus->id}}" >{{ $bus->code }}</option>
                                {{-- @foreach($bus->bus as $busRe)
                                @endforeach --}}
                            @endforeach
                        </select>
                        @error('bus_id')<span style="color: red"> {{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-12">
                        <label for="station_id" class="mr-sm-2">notes :</label>
                        <textarea name="" id="" cols="10" rows="5" class="form-control" wire:model.lazy='notes'></textarea>
                        @error('notes')<span style="color: red"> {{ $message }}</span>@enderror
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
