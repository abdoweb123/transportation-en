<div>
    <div>
        @foreach(['danger','warning','success','info'] as $msg)
            @if(Session::has('alert-'.$msg))
                <div class="alert alert-{{$msg}}">
                    {{Session::get('alert-'.$msg)}}
                </div>
            @endif
        @endforeach

    </div>
    <form wire:submit.prevent='store_update'>
        <div class="card-body col-md-8 offset-2">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="date" class="mr-sm-2">date :</label>
                    <input class="form-control" type="date" wire:model.lazy='date'>
                    @error('date')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="code" class="mr-sm-2">code :</label>
                    <input class="form-control" type="number" wire:model.lazy='code'>
                    @error('code')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="station_id" class="mr-sm-2">Bus :</label>
                    <select class="form-control mr-sm-2 p-2"  wire:model='bus_id'>
                        <option class="custom-select mr-sm-2 p-2" >--- Choose ---</option>
                        @foreach($buses as $bus)
                        <option value="{{$bus->id}}" >{{ $bus->code }}</option>
                            {{-- @foreach($bus->bus as $busRe)
                            @endforeach --}}
                        @endforeach
                    </select>
                    @error('bus_id')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="solar_g" class="mr-sm-2">solar/g :</label>
                    <input class="form-control" type="number" wire:model.lazy='solar_g' wire:change='total_price'>
                    @error('solar_g')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="solar_liter" class="mr-sm-2">solar/liter :</label>
                    <input class="form-control" type="number" wire:model.lazy='solar_liter' wire:change='total_price'>
                    @error('solar_liter')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="solar_g_liter" class="mr-sm-2">solar/g/liter :</label>
                    <input class="form-control" type="number" wire:model.lazy='solar_g_liter' wire:change='total_price'>
                    @error('solar_g_liter')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="km" class="mr-sm-2">km:</label>
                    <input class="form-control" type="number" wire:model.lazy='km' wire:change='total_price'>
                    @error('km')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="solar_esthlak" class="mr-sm-2">solar_esthlak:</label>
                    <input class="form-control" type="number" wire:model.lazy='solar_esthlak' wire:change='total_price'>
                    @error('solar_esthlak')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="zeyout" class="mr-sm-2">zeyout:</label>
                    <input class="form-control" type="number" wire:model.lazy='zeyout' wire:change='total_price'>
                    @error('zeyout')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="kawetch" class="mr-sm-2">kawetch:</label>
                    <input class="form-control" type="number" wire:model.lazy='kawetch' wire:change='total_price'>
                    @error('kawetch')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="btarya" class="mr-sm-2">btarya:</label>
                    <input class="form-control" type="number" wire:model.lazy='btarya' wire:change='total_price'>
                    @error('btarya')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="zogag" class="mr-sm-2">zogag:</label>
                    <input class="form-control" type="number" wire:model.lazy='zogag' wire:change='total_price'>
                    @error('zogag')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="ghasel_tashhim" class="mr-sm-2">ghasel_tashhim:</label>
                    <input class="form-control" type="number" wire:model.lazy='ghasel_tashhim' wire:change='total_price'>
                    @error('ghasel_tashhim')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="maintance_flater" class="mr-sm-2">maintance_flater:</label>
                    <input class="form-control" type="number" wire:model.lazy='maintance_flater' wire:change='total_price'>
                    @error('maintance_flater')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="eslah_kt_ghear" class="mr-sm-2">eslah_kt_ghear:</label>
                    <input class="form-control" type="number" wire:model.lazy='eslah_kt_ghear' wire:change='total_price'>
                    @error('eslah_kt_ghear')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="grash_edafy" class="mr-sm-2">grash_edafy:</label>
                    <input class="form-control" type="number" wire:model.lazy='grash_edafy' wire:change='total_price'>
                    @error('grash_edafy')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="ather" class="mr-sm-2">ather:</label>
                    <input class="form-control" type="number" wire:model.lazy='ather' wire:change='total_price'>
                    @error('ather')<span style="color: red"> {{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label for="total" class="mr-sm-2">total:</label>
                    <input class="form-control" type="number" wire:model.lazy='total' >
                    @error('total')<span style="color: red"> {{ $message }}</span>@enderror
                </div>

            </div>
        </div>
        <br><br>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">close</button>
            <button type="submit" class="btn btn-success">{{ $ids != null ? 'edit' : 'save' }}</button>
        </div>
    </form>
</div>
