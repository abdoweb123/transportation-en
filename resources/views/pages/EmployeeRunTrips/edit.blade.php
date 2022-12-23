<!-- edit_modal_city -->
<div class="modal fade" id="editEmployeeRunTrip{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Edit Employee Run Trip Data
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('employeeRunTrips.update','test') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input id="id" type="hidden" name="id" class="form-control" value="{{ $item->id }}">
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">Route :</label>
                            <select class="form-control mr-sm-2 p-2" name="route_id">
                                <option class="custom-select" disabled>--- Choose ---</option>
                                @foreach($routes as $route)
                                    <option value="{{$route->id}}" {{$route->id == $item->route_id ? 'selected' : ''}}>{{ $route->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">Date :</label>
                            <input class="form-control" type="text" value="{{$item->date}}"  id="datepicker-action" name="date" data-date-format="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">Time :</label>
                            <input class="form-control" type="time" value="{{$item->time}}" name="time">
                        </div>
                        <div class="col">
                            <label for="station_id" class="mr-sm-2">Driver :</label>
                            <select class="form-control mr-sm-2 p-2" name="driver_id">
                                <option class="custom-select mr-sm-2 p-2" disabled>--- Choose ---</option>
                                @foreach($drivers as $driver)
                                    <option value="{{$driver->id}}" {{$driver->id == $item->driver_id ? 'selected' : ''}}>{{ $driver->nane }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="station_id" class="mr-sm-2">Bus :</label>
                            <select class="form-control mr-sm-2 p-2" name="bus_id[]" multiple>
                                <option class="custom-select mr-sm-2 p-2" disabled>--- Choose ---</option>
                                @foreach($buses as $bus)
                                    @foreach($item->bus as $busRe)
                                    <option value="{{$bus->id}}" {{$bus->id == $busRe->id ? 'selected' : ''}}>{{ $bus->code }}</option>
                                    @endforeach
                                @endforeach
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
