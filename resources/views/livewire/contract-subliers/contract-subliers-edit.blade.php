<div>
    <div class="card card-statistics h-100">
        <div class="card-body">
            <form wire:submit.prevent='store_update'>
                <div class="card-body col-md-8 offset-2">
                    <div class="form-group row">
                        <div class="col-md-6 mb-5">
                            <label for="name" class="mr-sm-2">name</label>
                            <input id="name" type="text" name="name" class="form-control" wire:model.lazy='name'>
                            @error('name')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="sublier" class="mr-sm-2">sublier</label>
                            <input id="sublier" type="text" class="form-control" wire:model='sublier_id'>
                            @if(($serches))
                                @foreach($serches as $search)
                                <a href="javascript:void(0);" wire:click='defin_sublier({{ $search->id }})'>
                                    <span class="form-text text-muted">{{ $search->name }}</span>
                                </a>
                                @endforeach
                            @endif
                            @error('sublier')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="start date" class="mr-sm-2">start date</label>
                            <input id="start_date" type="date" class="form-control" wire:model.lazy='start_date'>
                            @error('start_date')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="end_date" class="mr-sm-2">end_date</label>
                            <input id="end_date" type="date" class="form-control" wire:model.lazy='end_date'>
                            @error('end_date')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12">
                            <label for="number_of_routes" class="mr-sm-2">number of routes</label>
                            <input id="number_of_routes" type="number"  class="form-control" wire:model.lazy='number_of_routes'>
                            @error('number_of_routes')<span style="color: red"> {{ $message }}</span>@enderror
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
