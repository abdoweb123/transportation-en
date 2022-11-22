<!-- edit_modal_city -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    تعديل تشغيل الرحلة
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('runTrips.update', 'test') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input id="id" type="hidden" name="id" class="form-control" value="{{ $item->id }}">
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">اسم الرحلة * :</label>
                            <select class="form-control mr-sm-2 p-2" name="tripData_id">
                                <option class="custom-select mr-sm-2 p-2" disabled>--- اختر من القائمة ---</option>
                                <option value="{{$item->tripData->id}}">{{ $item->tripData->name }}</option>
                                @foreach($data['tripData'] as $trip)
                                    @if($trip->id !== $item->tripData->id)
                                        <option value="{{$trip->id}}">{{ $trip->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="name" class="mr-sm-2">اسم السائق * :</label>
                            <select class="form-control mr-sm-2 p-2" name="driver_id">
                                <option class="custom-select mr-sm-2 p-2" disabled>--- اختر من القائمة ---</option>
                                <option value="{{$item->driver->id}}">{{ $item->driver->name }}</option>
                                @foreach($data['drivers'] as $driver)
                                    @if($driver->id !== $item->driver->id)
                                        <option value="{{$driver->id}}">{{ $driver->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>التاريخ * : </label>
                            <input type="date" name="startDate" class="form-control" value="{{ $item->startDate }}" data-date-format="yyyy-mm-dd">
                        </div>
                        <div class="col">
                            <label>توقيت الرحلة * : </label>
                            <input type="time" name="startTime" class="form-control" value="{{ $item->startTime }}" data-date-format="yyyy-mm-dd">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">اسم الحافلة * :</label>
                            <select class="form-control mr-sm-2 p-2" name="bus_id">
                                <option class="custom-select mr-sm-2 p-2" disabled>--- اختر من القائمة ---</option>
                                <option value="{{$item->bus->id}}">{{ $item->bus->code }}</option>
                                @foreach($data['buses'] as $bus)
                                    @if($bus->id !== $item->bus->id)
                                        <option value="{{$bus->id}}">{{ $bus->code }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">الحالة * :</label>
                            <div class="form-control">
                                <input type="radio" name="active" value="1" {{$item->active == 1 ? 'checked' : ' '}} > مفعل&nbsp;&nbsp;
                                <input type="radio" name="active" value="2" {{$item->active == 2 ? 'checked' : ' '}} > غير مفعل
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">اسم المضيف * :</label>
                            <select class="form-control mr-sm-2 p-2" name="host_id">
                                <option class="custom-select mr-sm-2 p-2" disabled>--- اختر من القائمة ---</option>
                                <option value="{{$item->host->id}}">{{ $item->host->name }}</option>
                                @foreach($data['hosts'] as $host)
                                    @if($host->id !== $item->host->id)
                                        <option value="{{$host->id}}">{{ $host->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">نوع الرحلة * :</label>
                            <select class="form-control mr-sm-2 p-2" name="type">
                                <option class="custom-select mr-sm-2 p-2" disabled>--- اختر من القائمة ---</option>
                                <option value="{{$item->type}}">{{$item->type  == 1 ? 'ذهاب' : 'ذهاب وعودة'}}</option>
                                @if($item->type == 1)
                                    <option value="2">ذهاب وعودة</option>
                                @else
                                    <option value="1">ذهاب</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">عمولة السائق * :</label>
                            <input type="number" class="form-control" name="driverTips" value="{{$item->driverTips}}">
                        </div>
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">عمولة المضيف * :</label>
                            <input type="number" class="form-control" name="hostTips" value="{{$item->hostTips}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">ملاحظات :</label>
                            <textarea class="form-control" name="notes">{{$item->notes}}</textarea>
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
