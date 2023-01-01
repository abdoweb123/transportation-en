<div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="name" class="mr-sm-2">name</label>
                    <input id="name" type="text" name="name" class="form-control" wire:model.lazy='name'>
                    <input type="hidden" wire:model.lazy='type'>
                    @error('name')<span style="color: red"> {{ $message }}</span>@enderror
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
