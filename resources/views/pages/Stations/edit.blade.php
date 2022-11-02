<!-- edit_modal_city -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('stations_trans.edit_station') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('stations.update', 'test') }}" method="post">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('stations_trans.station_name_ar') }}:</label>
                            <input id="Name" type="text" name="name_ar" class="form-control" value="{{ $item->getTranslation('name', 'ar') }}" required>
                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $item->id }}">
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">{{ trans('stations_trans.station_name_en') }}:</label>
                            <input type="text" class="form-control" value="{{ $item->getTranslation('name', 'en') }}" name="name_en" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="type" class="mr-sm-2">{{ trans('stations_trans.choose_station_type') }}
                                :</label>
                            <select class="form-control" name="type">
                                <option class="custom-select" disabled>{{ trans('stations_trans.choose') }}</option>
                                <option value="{{$item->type}}">
                                    @if(App::getLocale() == 'ar')
                                        @if($item->type == 1) صعود @elseif($item->type == 2) نزول @elseif($item->type == 3) صعود ونزول @endif
                                    @else
                                        @if($item->type == 1) Boarding @elseif($item->type == 2) Getting off @elseif($item->type == 3) Boarding and Getting off @endif
                                    @endif
                                </option>
                                <option value="1">{{ trans('stations_trans.up') }}</option>
                                <option value="2">{{ trans('stations_trans.down') }}</option>
                                <option value="3">{{ trans('stations_trans.up_down') }}</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">{{ trans('stations_trans.choose_city_name') }}
                                :</label>
                            <select class="form-control" name="city_id">
                                <option class="custom-select" disabled>{{ trans('stations_trans.choose') }}</option>
                                <option value="{{$item->city->id}}">{{ $item->city->name }}</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('main_trans.submit') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
