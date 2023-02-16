<div>
    <?php 
    $amount_dics='d-none';
    $supplier_kined='d-none';
    if ($type == 'gas_type') {
        $amount_dics='';
    }
    if ($type == 'suppliers') {
        $supplier_kined='';
    }
    
    ?>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="name" class="mr-sm-2">name <span style="color:red">*</span></label>
                    <input id="name" type="text" name="name" class="form-control" wire:model.lazy='name' required>
                    <input type="hidden" wire:model.lazy='type'>
                    @error('name')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 {{ $amount_dics }}">
                    <label for="name" class="mr-sm-2">price <span style="color:red">*</span></label>
                    <input id="name" type="text" name="amount" class="form-control" wire:model.lazy='amount' >
                </div>
                <div class="col-md-12 mb-3 {{ $supplier_kined }}">
                    <label for="supplier_kind_id">supplier kind</label>
                    <select class="form-control mr-sm-2 p-2" name="supplier_kind_id" wire:model.lazy='supplier_kind_id'>
                        <option selected >choose</option>
                        @if(isset($supplier_kinds))
                            @foreach($supplier_kinds as $supplier_kind)
                                <option value="{{$supplier_kind->id}}">{{$supplier_kind->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('supplier_kind_id')<span style="color: red"> {{ $message }}</span>@enderror
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
