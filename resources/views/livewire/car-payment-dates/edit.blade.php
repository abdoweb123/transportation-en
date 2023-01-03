<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="date" class="mr-sm-2">date</label>
                    <input id="date" type="date" class="form-control" wire:model.lazy='date'>
                    @error('date')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-2">
                    <label for="amount" class="mr-sm-2">amount</label>
                    <input id="amount" type="number" class="form-control" wire:model.lazy='amount'>
                    @error('amount')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                   <div class="col-md-12">
                    <label for="amount" class="mr-sm-2">is paid</label>
                    <div>
                        <label for="amount" class="mr-sm-2">yes
                             <input type="radio" id="html" name="fav_language" value="Y" wire:model='paid'>
                        </label>
                        <label for="amount" class="mr-sm-2">no
                            <input type="radio" id="html" name="fav_language" value="N" wire:model='paid'>
                        </label>
                    </div>
                    
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
