<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-2">
                    @if($image_face != null)
                        <img src="{{ url('assets/images/'.$image_face) }}" title="image_face" alt="" style="height:50px;width50px;">
                    @endif
                    @if($image_left != null)
                        <img src="{{ url('assets/images/'.$image_left) }}" title="image_left" alt="" style="height:50px;width50px;">
                    @endif
                    @if($advertisement_image != null)
                        <img src="{{ url('assets/images/'.$advertisement_image) }}" title="advertisement_image" alt="" style="height:50px;width50px;">
                    @endif
                   
                    

                </div>
                <div class="col-md-6 mb-2">
                    <label for="name" class="mr-sm-2 ">name <span style="color:red">*</span></label>
                    <input id="name" type="text" class="form-control" wire:model.lazy='name'>
                    @error('name')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="code" class="mr-sm-2">code <span style="color:red">*</span></label>
                    <input id="code" type="text" class="form-control" wire:model.lazy='code'>
                    @error('code')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="busType_id">busTypes <span style="color:red">*</span> </label>
                    <select class="form-control mr-sm-2 p-2" name="busType_id" wire:model.lazy='busType_id'>
                        <option selected >choose</option>
                        @if(count($busTypes))
                            @foreach($busTypes as $busType)
                                <option value="{{$busType->id}}">{{$busType->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('busType_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="gas_type_id">gas_types <span style="color:red">*</span></label>
                    <select class="form-control mr-sm-2 p-2" name="gas_type_id" wire:model.lazy='gas_type_id'>
                        <option selected >choose</option>
                        @if(count($gas_types))
                            @foreach($gas_types as $gas_type)
                                <option value="{{$gas_type->id}}">{{$gas_type->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('gas_type_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="motor_number" class="mr-sm-2">motor_number <span style="color:red">*</span></label>
                    <input id="motor_number" type="number" class="form-control" wire:model.lazy='motor_number'>
                    @error('motor_number')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="suplier_id">supliers</label>
                    <select class="form-control mr-sm-2 p-2" name="suplier_id" wire:model.lazy='suplier_id'>
                        <option selected >choose</option>
                        @if(count($supliers))
                            @foreach($supliers as $suplier)
                                <option value="{{$suplier->id}}">{{$suplier->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('suplier_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="driver_id">drivers</label>
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
                    <label for="shase_number" class="mr-sm-2">shase_number</label>
                    <input id="shase_number" type="text" class="form-control" wire:model.lazy='shase_number'>
                    @error('shase_number')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="bus_model_id">bus_models <span style="color:red">*</span></label>
                    <select class="form-control mr-sm-2 p-2" name="bus_model_id" wire:model.lazy='bus_model_id'>
                        <option selected >choose</option>
                        @if(count($bus_models))
                            @foreach($bus_models as $bus_model)
                                <option value="{{$bus_model->id}}">{{$bus_model->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('bus_model_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="insurance_company_id">insurance_companies</label>
                    <select class="form-control mr-sm-2 p-2" name="insurance_company_id" wire:model.lazy='insurance_company_id'>
                        <option selected >choose</option>
                        @if(count($insurance_companies))
                            @foreach($insurance_companies as $insurance_company)
                                <option value="{{$insurance_company->id}}">{{$insurance_company->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('insurance_company_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="bank_id">bank</label>
                    <select class="form-control mr-sm-2 p-2" name="bank_id" wire:model.lazy='bank_id'>
                        <option selected >choose</option>
                        @if(count($banks))
                            @foreach($banks as $bank)
                                <option value="{{$bank->id}}">{{$bank->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('bank_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-4">
                    <label for="face_image" class="mr-sm-2">face image</label>
                    <input id="face_image" type="file" class="form-control" wire:model.lazy='image_face'>
                    @error('image_face')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="face_left" class="mr-sm-2">image left</label>
                    <input id="face_left" type="file" class="form-control" wire:model.lazy='image_left'>
                    @error('face_left')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="advertisement_image" class="mr-sm-2">Advertisement image</label>
                    <input id="advertisement_image" type="file" class="form-control" wire:model.lazy='advertisement_image'>
                    @error('advertisement_image')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                
                <div class="col-md-6 mb-2">
                    <label for="expiration_insurance_from" class="mr-sm-2">Expiration of the insurance license From</label>
                    <input id="expiration_insurance_from" type="date" class="form-control" wire:model.lazy='expiration_insurance_from'>
                    @error('expiration_insurance_from')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="expiration_insurance_to" class="mr-sm-2">Expiration of the insurance license To</label>
                    <input id="expiration_insurance_to" type="date" class="form-control" wire:model.lazy='expiration_insurance_to'>
                    @error('expiration_insurance_to')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 ">
                    <label for="insurance_insurance_from" class="mr-sm-2">Insurance taxes expire From</label>
                    <input id="insurance_insurance_from" type="date" class="form-control" wire:model.lazy='insurance_insurance_from'>
                    @error('insurance_insurance_from')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 ">
                    <label for="insurance_insurance_to" class="mr-sm-2">Insurance taxes expire To</label>
                    <input id="insurance_insurance_to" type="date" class="form-control" wire:model.lazy='insurance_insurance_to'>
                    @error('insurance_insurance_to')<span style="color: red"> {{ $message }}</span>@enderror
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
