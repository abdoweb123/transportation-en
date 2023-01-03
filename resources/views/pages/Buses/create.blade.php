<!-- add_modal_city -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                   Add Bus
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('buses.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="code" class="mr-sm-2">bus code :</label>
                            <input id="code" type="text" name="code" class="form-control">
                        </div>
                        <div class="col">
                            <label for="Classroom_id">belongs to : <span class="text-danger">*</span></label>
                            <select class="form-control mr-sm-2 p-2" name="busType_id">
                                <option selected disabled>--choose --</option>
                                @foreach($busTypes as $busType)
                                    <option value="{{$busType->id}}">{{$busType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="Classroom_id">gas type : <span class="text-danger">*</span></label>
                            <select class="form-control mr-sm-2 p-2" name="gas_type_id">
                                <option selected disabled>--choose --</option>
                                @foreach($gas_types as $gas_type)
                                    <option value="{{$gas_type->id}}">{{$gas_type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-success">إرسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
