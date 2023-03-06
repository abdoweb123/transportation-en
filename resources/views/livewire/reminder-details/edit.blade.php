<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="supplier_id" class="mr-sm-2">supplier</label>
                    <select name="supplier_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='supplier_id'>
                        <option value="0"> </option>
                        @if (isset($suppliers))
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('supplier_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="admin_id" class="mr-sm-2">admins</label>
                    <select name="admin_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='admin_id'>
                        <option value="0"> </option>
                        @if (isset($admins))
                            @foreach ($admins as $admin)
                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('admin_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="gudget_brand_id" class="mr-sm-2">gudget brand</label>
                    <select name="gudget_brand_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='gudget_brand_id'>
                        <option value="0"> </option>
                        @if (isset($gudget_brands))
                            @foreach ($gudget_brands as $gudget_brand)
                                <option value="{{ $gudget_brand->id }}">{{ $gudget_brand->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('gudget_brand_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="gudget_type_id" class="mr-sm-2">gudget_type</label>
                    <select name="gudget_type_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='gudget_type_id'>
                        <option value="0"> </option>
                        @if (isset($gudget_types))
                            @foreach ($gudget_types as $gudget_type)
                                <option value="{{ $gudget_type->id }}">{{ $gudget_type->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('gudget_type_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="number_of_gudgets" class="mr-sm-2">number_of_gudgets</label>
                    <input id="number_of_gudgets" type="number" class="form-control" wire:model.lazy='number_of_gudgets' wire:change='total_apied'>
                    @error('number_of_gudgets')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="cost_of_gudget" class="mr-sm-2">cost_of_gudget</label>
                    <input id="cost_of_gudget" type="number" class="form-control" wire:model.lazy='cost_of_gudget' wire:change='total_apied'>
                    @error('cost_of_gudget')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="fixing_cost" class="mr-sm-2">fixing_cost</label>
                    <input id="fixing_cost" type="number" class="form-control" wire:model.lazy='fixing_cost' wire:change='total_apied'>
                    @error('fixing_cost')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="total_paid" class="mr-sm-2">total paid</label>
                    <input id="total_paid" type="number" class="form-control" wire:model.lazy='total_paid'>
                    @error('total_paid')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="cost_per_day" class="mr-sm-2">cost per day</label>
                    <input id="cost_per_day" type="number" class="form-control" wire:model.lazy='cost_per_day'>
                    @error('cost_per_day')<span style="color: red"> {{ $message }}</span>@enderror
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
