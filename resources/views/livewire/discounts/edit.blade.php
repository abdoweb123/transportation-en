<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-6 mb-2">
                    <label for="title" class="mr-sm-2">title</label>
                    <input id="title" type="text" class="form-control" wire:model.lazy='title'>
                    @error('title')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="discount_type_id" class="mr-sm-2">discounts</label>
                    <select name="discount_type_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='discount_type_id'>
                        <option value="0"> </option>
                        @if (isset($discount_types))
                            @foreach ($discount_types as $discount)
                                <option value="{{ $discount->id }}">{{ $discount->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('discount_type_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                
                <div class="col-md-6 mb-2">
                    <label for="amount" class="mr-sm-2">amount</label>
                    <input id="amount" type="number" class="form-control" wire:model.lazy='amount'>
                    @error('amount')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="presentage" class="mr-sm-2">presentage</label>
                    <input id="presentage" type="number" class="form-control" wire:model.lazy='presentage'>
                    @error('presentage')<span style="color: red"> {{ $message }}</span>@enderror
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
