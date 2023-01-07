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
                <form action="{{route('createNewBooking')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Oracle_id :</label>
                            <input type="text" name="oracle_id" class="form-control">
                        </div>
                    </div>

                    <input type="hidden" name="newEmployeeRunTrip_id" value="{{$item->id}}">
                    <input type="hidden" name="route_id" value="{{$request->route_id}}">
                    <input type="hidden" name="bus_id" value="{{$request->bus_id}}">
                    <input type="hidden" name="date" value="{{$request->date}}">
                    <input type="hidden" name="time" value="{{$request->time}}">
                    <input type="hidden" name="collection_point_from_id" value="{{$request->collection_point_from_id}}">
                    <input type="hidden" name="collection_point_to_id" value="{{$request->collection_point_to_id}}">
                    <input type="hidden" name="type" value="{{$request->type}}">

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
