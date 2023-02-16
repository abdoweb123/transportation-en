

<div class="modal fade" id="importExcel" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                   add file
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <!-- add_form -->
               <form action="{{ url('importStation') }}" method="post" enctype="multipart/form-data">
                   {{ method_field('post') }}
                   @csrf
                   <div class="row">
                       <div class="col">
                           <label for="file" class="mr-sm-2">{{ trans('cities_trans.file') }}:</label>
                           {{-- <input type="text" name="test" value="test" id=""> --}}
                           <input type="file" name="excel">
                       </div>
                       {{-- <div class="col">
                        <label for="file" class="mr-sm-2">company:</label>
                        <select name="company_id" class="form-control">
                            <option value=" ">-- Choose --</option>
                            @foreach($comapnies as $company)
                                <option value="{{$company->id}}" {{$request_company_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                            @endforeach
                        </select>
                       </div> --}}
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                       <button type="submit" class="btn btn-success">{{ trans('main_trans.submit') }}</button>
                   </div>
               </form>

           </div>
       </div>
   </div>
</div>


<!-- edit_modal_city -->
<div class="modal fade" id="editStation{{ $item->id }}" tabindex="-1" role="dialog"
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
                            <label for="name_ar" class="mr-sm-2">Latitude :</label>
                            <input type="number" step="0.1" value="{{$item->lat}}" name="lat" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">Longitude :</label>
                            <input type="number" step="0.1" value="{{$item->lon}}" class="form-control" name="lon">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="city_id" class="mr-sm-2">{{ trans('stations_trans.choose_city_name') }}
                                :</label>
                            <select class="form-control mr-sm-2 p-2" name="city_id">
                                <option class="custom-select" disabled>{{ trans('stations_trans.choose') }}</option>
{{--                                <option value="{{$item->city->id}}">{{ $item->city->name }}</option>--}}
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{$city->id == $item->city_id ? 'selected' : ''}}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-md-6">
                            <label class="mr-sm-2">companies</label>
                            <select name="company_id" class="form-control">
                                <option value=" " selected>-- Choose --</option>
                                @foreach($comapnies as $company)
                                    <option value="{{$company->id}}" {{$item->company_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="description" class="mr-sm-2">description :</label>
                            <textarea name="description" class="form-control" id="" cols="10" rows="2">{{$item->description}}"</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="description" class="mr-sm-2">description en:</label>
                            <textarea name="description_en" class="form-control"  id="" cols="10" rows="2">{{$item->description_en}}</textarea>
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




