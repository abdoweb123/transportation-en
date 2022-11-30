<!-- add_modal_city -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    إضافة كوبون
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('coupons.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">الكود:</label>
                            <input id="name" type="text" name="code" value="{{old('code')}}" class="form-control">
                        </div>
                        <div class="col">
                            <label class="mr-sm-2" style="display:block">الخصم:</label>
                            <input type="number" step="0.1" class="form-control" name="amount" value="{{old('amount')}}" style="display:inline-block; width:75%">
                            <select name="percent" id="percent" style="height:42px">
                                <option value="1">جنيه</option>
                                <option value="0">%</option>
                            </select>
                        </div>
                    </div>
                    <div class="row max_amount" style="display:none">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">أكبر قيمة للخصم:</label>
                            <input id="name" type="number" step="0.1" name="max_amount"  value="{{old('max_amount')}}" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">تاريخ البداية:</label>
                            <input id="name" type="date" name="startDate"  value="{{old('startDate')}}" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">تاريخ النهاية:</label>
                            <input id="name" type="date" name="endDate"  value="{{old('endDate')}}" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">العدد الكلي للأشخاص:</label>
                            <input id="name" type="text" name="max_users"  value="{{old('max_users')}}" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">اسم الرحلة:</label>
                            <select name="trips[]" multiple class="form-control trips" style="padding:10px; width:75%; display:inline-block">
                                <option value=" ">-- اختر --</option>
                                @foreach($trips as $trip)
                                    <option value="{{$trip->id}}">{{$trip->name}}</option>
                                @endforeach
                            </select>
                            <label for="name_ar" class="mr-sm-2" > الكل:</label>
                            <input type="checkbox" name="allTrips">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">الملاحظات:</label>
                            <textarea name="notes" class="form-control">{{old('notes')}}</textarea>
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
