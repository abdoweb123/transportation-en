<!-- edit_modal_city -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('cities_trans.edit_city') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('buses.update',$item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label for="code" class="mr-sm-2">كود الحافلة
                                :</label>
                            <input id="code" type="text" name="code" value="{{$item->code}}" class="form-control">
                        </div>
                        <div class="col">
                            <label for="Classroom_id">الأسطول التابع لها : <span class="text-danger">*</span></label>
                            <select class="form-control mr-sm-2 p-2" name="busType_id">
                                <option selected value="{{$item->busType_id}}">{{$item->busType->name}}</option>
                                @foreach($busTypes as $busType)
                                    @if($item->busType_id != $busType->id)
                                        <option value="{{$busType->id}}">{{$busType->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="Classroom_id">gas type : <span class="text-danger">*</span></label>
                            <select class="form-control mr-sm-2 p-2"  name="gas_type_id">
                                <option selected disabled>--choose --</option>
                                @foreach($gas_types as $gas_type)
                                    <option value="{{$gas_type->id}}" {{ $gas_type->id == $item->gas_type_id ? 'selected' : ''  }}>{{$gas_type->name}}</option>
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
