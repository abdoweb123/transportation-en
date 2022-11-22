<!-- edit_modal_city -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
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
                <form action="{{ route('tripData.update', 'test') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input id="id" type="hidden" name="id" class="form-control" value="{{ $item->id }}">
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">اسم الرحلة * :</label>
                            <input id="name" type="text" name="name" value="{{$item->name}}" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name" class="mr-sm-2">درجة الرحلة * :</label>
                            <select class="form-control mr-sm-2 p-2" name="degree_id">
                                <option class="custom-select mr-sm-2 p-2" disabled>--- اختر من القائمة ---</option>
                                <option value="{{$item->degree->id}}">{{ $item->degree->name }}</option>
                                @foreach($degrees as $degree)
                                    @if($degree->id !== $item->degree->id)
                                        <option value="{{$degree->id}}">{{ $degree->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
{{--                        <div class="col">--}}
{{--                            <label class="mr-sm-2">نوع الرحلة * :</label>--}}
{{--                            <select class="form-control mr-sm-2 p-2" name="type">--}}
{{--                                <option class="custom-select mr-sm-2 p-2" disabled>--- اختر من القائمة ---</option>--}}
{{--                                <option value="{{$item->type}}">{{$item->type  == 1 ? 'ذهاب' : 'ذهاب وعودة'}}</option>--}}
{{--                                @if($item->type == 1)--}}
{{--                                    <option value="2">ذهاب وعودة</option>--}}
{{--                                @else--}}
{{--                                    <option value="1">ذهاب</option>--}}
{{--                                @endif--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">اسم الأسطول * :</label>
                            <select class="form-control mr-sm-2 p-2" name="busType_id">
                                <option class="custom-select mr-sm-2 p-2" disabled>--- اختر من القائمة ---</option>
                                <option value="{{$item->busType->id}}">{{ $item->busType->name }}</option>
                                @foreach($busTypes as $busType)
                                    @if($busType->id !== $item->busType->id)
                                        <option value="{{$busType->id}}">{{ $busType->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">ملاحظات :</label>
                            <textarea rows="5" class="form-control" name="notes">{{$item->notes}}</textarea>
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
