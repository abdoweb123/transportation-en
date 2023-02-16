<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="name" class="mr-sm-2">name</label>
                    <input id="name" type="text" class="form-control" wire:model.lazy='name'>
                    @error('name')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="address" class="mr-sm-2">address</label>
                    <input id="address" type="text" class="form-control" wire:model.lazy='address'>
                    @error('address')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-10">
                    <label for="government_id" class="mr-sm-2">government</label>
                    <select name="government_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='government_id'>
                        <option value="0"> </option>
                        @if (isset($governments))
                            @foreach ($governments as $government)
                                <option value="{{ $government->id }}">{{ $government->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('government_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-10">
                    <label for="city_id" class="mr-sm-2">cities</label>
                    <select name="city_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='city_id'>
                        <option value="0"> </option>
                        @if (isset($cities))
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('city_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label for="phone one" class="mr-sm-2">phone one</label>
                    <input id="phone one" type="text" class="form-control" wire:model.lazy='phone_one'>
                    @error('phone_one')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="phone one" class="mr-sm-2">Does this phone have WhatsApp? </label>
                    <input id="phone one" type="checkbox" class="form-control" wire:model.lazy='phone_one_w'>
                    @error('phone_one')<span style="color: red"> {{ $message }}</span>@enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label for="phone two" class="mr-sm-2">phone two</label>
                    <input id="phone two" type="text" class="form-control" wire:model.lazy='phone_two'>
                    @error('phone_two')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="phone two" class="mr-sm-2">Does this phone have WhatsApp? </label>
                    <input id="phone two" type="checkbox" class="form-control" wire:model.lazy='phone_two_w'>
                    @error('phone_two')<span style="color: red"> {{ $message }}</span>@enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label for="email" class="mr-sm-2">email</label>
                    <input id="email" type="text" class="form-control" wire:model.lazy='email'>
                    @error('email')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="commercial_register" class="mr-sm-2">commercial register</label>
                    <input id="commercial_register" type="file" class="form-control" wire:model.lazy='commercial_register'>
                    @error('commercial_register')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="fax" class="mr-sm-2">fax</label>
                    <input id="fax" type="text" class="form-control" wire:model.lazy='fax'>
                    @error('fax')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="tax_card" class="mr-sm-2">Tax Card</label>
                    <input id="tax_card" type="text" class="form-control" wire:model.lazy='tax_card'>
                    @error('tax_card')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="user_name" class="mr-sm-2">Name of the manager</label>
                    <input id="user_name" type="text" class="form-control" wire:model.lazy='user_name'>
                    @error('user_name')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="job" class="mr-sm-2">job</label>
                    <input id="job" type="text" class="form-control" wire:model.lazy='job'>
                    @error('job')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="password" class="mr-sm-2">password</label>
                    <input id="password" type="password" class="form-control" wire:model.lazy='password'>
                    @error('password')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="confirm_password" class="mr-sm-2">confirm_password</label>
                    <input id="confirm_password" type="password" class="form-control" wire:model.lazy='confirm_password'>
                    @error('confirm_password')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
            <br><br>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">close</button>
            {{-- <button type="submit" class="btn btn-success">إرسال</button> --}}
            <button type="submit" class="btn btn-success">{{ $ids != null ? 'edit' : 'save' }}</button>
        </div>
    </form>
</div>
