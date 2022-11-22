<!-- add_modal_station -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    إضافة رحلة
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('tripData.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">اسم الرحلة * :</label>
                            <input id="name" type="text" name="name" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name" class="mr-sm-2">درجة الرحلة * :</label>
                            <select class="form-control mr-sm-2 p-2" name="degree_id">
                                <option class="custom-select mr-sm-2 p-2" value=" ">--- اختر من القائمة ---</option>
                                @foreach($degrees as $degree)
                                    <option value="{{$degree->id}}">{{ $degree->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">اسم الأسطول * :</label>
                            <select class="form-control mr-sm-2 p-2" name="busType_id">
                                <option class="custom-select mr-sm-2 p-2" value=" ">--- اختر من القائمة ---</option>
                                @foreach($busTypes as $busType)
                                    <option value="{{$busType->id}}">{{ $busType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">ملاحظات :</label>
                            <textarea rows="5" class="form-control" name="notes"></textarea>
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
