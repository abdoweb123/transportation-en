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
                    <label for="email" class="mr-sm-2">email</label>
                    <input id="email" type="text" class="form-control" wire:model.lazy='email'>
                    @error('email')<span style="color: red"> {{ $message }}</span>@enderror
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
