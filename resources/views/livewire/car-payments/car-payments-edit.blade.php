<div>
    <div class="card card-statistics h-100">
        <div class="card-body">
            <form wire:submit.prevent='store_update'>
                <div class="card-body col-md-8 offset-2">
                    <div class="form-group row ">
                        <div class="col-md-12 mb-10">
                            <label for="bus_id" class="mr-sm-2">buses</label>
                            <select name="bus_id" class="form-control mr-sm-2 p-2" id="" class="w-100 mb-10" wire:model.lazy='bus_id'>
                                <option value="0"> </option>
                                @if (isset($buses))
                                    @foreach ($buses as $bus)
                                        <option value="{{ $bus->id }}">{{ $bus->code }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('bus_id')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12">
                            <label for="total_amount" class="mr-sm-2"> total amount</label>
                            <input id="total_amount" type="number"  class="form-control" wire:model.lazy='total_amount'>
                            @error('total_amount')<span style="color: red"> {{ $message }}</span>@enderror
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
