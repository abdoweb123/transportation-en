<!-- edit_modal_city -->
<div class="modal fade" id="editRouteStation{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Edit Route Station
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('routeStations.update','test') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input id="id" type="hidden" name="id" class="form-control" value="{{ $item->id }}">
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Station :</label>
                            <select class="form-control mr-sm-2 p-2" name="station_id">
                                <option class="custom-select mr-sm-2 p-2" value=" ">--- Choose ---</option>
                                @foreach($stations as $station)
                                    <option value="{{$station->id}}" {{$station->id == $item->station->id ? 'selected' : ''}}>{{ $station->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Route :</label>
                            <select class="form-control mr-sm-2 p-2" name="route_id">
                                <option class="custom-select mr-sm-2 p-2" value=" ">--- Choose ---</option>
                                @foreach($routes as $route)
                                    <option value="{{$route->id}}" {{$route->id == $item->route->id ? 'selected' : ''}}>{{ $route->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="image" class="mr-sm-2">Status</label>
                            <select name="active" class="form-control">
                                @if($item->active == 1)
                                    <option value="1" selected>active</option>
                                    <option value="2">un active</option>
                                @else
                                    <option value="1">active</option>
                                    <option value="2" selected>un active</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
