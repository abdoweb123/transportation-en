<!-- add_modal_station -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Add Office
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('offices.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Name in arabic :</label>
                            <input id="name_ar" type="text" name="name_ar" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">Name in english :</label>
                            <input type="text" class="form-control" name="name_en">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">City :</label>
                            <select class="form-control mr-sm-2 p-2" name="city_id">
                                <option class="custom-select mr-sm-2 p-2" value=" ">--- Choose City Name ---</option>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="station_id" class="mr-sm-2">Station :</label>
                            <select class="form-control mr-sm-2 p-2" name="station_id">
                                <option class="custom-select mr-sm-2 p-2" value=" ">--- Choose City Name ---</option>
                                @foreach($stations as $station)
                                <option value="{{$station->id}}">{{ $station->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
