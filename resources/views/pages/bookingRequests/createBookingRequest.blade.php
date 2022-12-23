<!-- edit_modal_city -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                   Create Booking
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('bookingRequests.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">Collection Point From :</label>
                            <select class="form-control mr-sm-2 p-2" name="collection_point_from_id" required>
                                <option class="custom-select" value=" " selected>--- Choose ---</option>
                                @foreach($stations as $station)
                                    <option value="{{$station->id}}">{{ $station->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">Collection Point To:</label>
                            <select class="form-control mr-sm-2 p-2" name="collection_point_to_id" required>
                                <option class="custom-select"  value=" " selected>--- Choose ---</option>
                                @foreach($stations as $station)
                                    <option value="{{$station->id}}">{{ $station->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">Route :</label>
                            <select class="form-control mr-sm-2 p-2" name="route_id" required>
                                <option class="custom-select"  value=" " selected>--- Choose ---</option>
                                @foreach($routes as $route)
                                    <option value="{{$route->id}}">{{ $route->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="station_id" class="mr-sm-2">Date :</label>
                            <input class="form-control" type="date" name="date" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="station_id" class="mr-sm-2">Time :</label>
                            <input class="form-control" type="time" name="time" required>
                        </div>
                    </div>

                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
