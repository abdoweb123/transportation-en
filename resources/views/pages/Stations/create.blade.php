<!-- add_modal_station -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('stations_trans.add_station') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('stations.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">{{ trans('stations_trans.station_name_ar') }}
                                <span style="color:red">*</span></label>
                            <input id="name_ar" type="text" name="name_ar" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">{{ trans('stations_trans.station_name_en') }}<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="name_en">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Latitude <span style="color:red">*</span></label>
                            <input id="name_ar" type="text" name="lat" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">Longitude <span style="color:red">*</span></label>
                            <input type="text" step="0.1" class="form-control" name="lon">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">{{ trans('stations_trans.choose_city_name') }}<span style="color:red">*</span></label>
                            <select class="form-control mr-sm-2 p-2" name="city_id">
                                <option class="custom-select mr-sm-2 p-2" value=" ">{{ trans('stations_trans.choose') }}</option>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-md-6">
                            <label class="mr-sm-2">companies</label>
                            <select name="company_id" class="form-control">
                                <option value=" " selected>-- Choose --</option>
                                @foreach($comapnies as $company)
                                    <option value="{{$company->id}}" {{old('company_id') == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="description" class="mr-sm-2">description :</label>
                            <textarea name="description" class="form-control" id="" cols="10" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="description" class="mr-sm-2">description en:</label>
                            <textarea name="description_en" class="form-control" id="" cols="10" rows="2"></textarea>
                        </div>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('main_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
