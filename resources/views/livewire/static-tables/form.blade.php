<div wire:ignore.self class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                id="delete">
                حذف 
            </h5>
            <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent='delete_at'>
                <p> هل أنت متأكد من عملية الحذف ؟</p>
                <p> سيتم نقل إلى سلة المهملات</p>
                {{-- <input id="id" type="hidden" name="id" class="form-control""> --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-danger" >حذف</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

<div wire:ignore.self  class="modal fade" id="ModalCreatUpdate" tabindex="-1" role="dialog" aria-labelledby="delivery"
aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="delivery">
                    {{ $ids != null ? 'تعديل' : 'اضافه' }} {{ $tittle }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form wire:submit.prevent='store_update'>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="from_date" class="mr-sm-2">تاريخ البدايه</label>
                            <input id="from_date" type="date" name="from_date" class="form-control" wire:model.lazy='from_date'>
                            @error('from_date')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="mr-sm-2">تاريخ النهايه</label>
                            <input id="end_date" type="date" name="end_date" class="form-control" wire:model.lazy='end_date'>
                            @error('end_date')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="hotel_id" class="mr-sm-2">اختر  الفندق  </label>
                            <select name="hotel_id" id="" class="form-control" wire:model.lazy='hotel_id' wire:change='get_rooms'>
                                <option value="0"> </option>
                                @if (isset($hotels))
                                    @foreach ($hotels as $hotel)
                                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('hotel_id')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="room_id" class="mr-sm-2">اختر  الغرفه  </label>
                            <select name="room_id" id="" class="form-control" wire:model.lazy='room_id' wire:change='get_price'>
                                <option value="0"> </option>
                                @if (isset($rooms))
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->description }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('room_id')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="city_id" class="mr-sm-2">اختر  الدينه  </label>
                            <select name="city_id" id="" class="form-control" wire:model.lazy='city_id'>
                                <option value="0"> </option>
                                @if (isset($cities))
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('city_id')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="company_id" class="mr-sm-2">اختر  الشركه  </label>
                            <select name="company_id" id="" class="form-control" wire:model.lazy='company_id'>
                                <option value="0"> </option>
                                @if (isset($companies))
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('company_id')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="paid" class="mr-sm-2">السعر الدفوع</label>
                            <input id="paid" type="text" name="paid" class="form-control" wire:model.lazy='paid'>
                            @error('paid')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="hotel_total_price" class="mr-sm-2">اجمالي سعر الفندق</label>
                            <input id="hotel_total_price" type="text" name="hotel_total_price" class="form-control" wire:model.lazy='hotel_total_price'>
                            @error('hotel_total_price')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="borker_total_price" class="mr-sm-2">اجمالي سعر السمسار</label>
                            <input id="borker_total_price" type="text" name="borker_total_price" class="form-control" wire:model.lazy='borker_total_price'>
                            @error('borker_total_price')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="adults" class="mr-sm-2">adults </label>
                            <input id="adults" type="number" name="adults" class="form-control" min="0" wire:model.lazy='adults'>
                            @error('adults')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="kids" class="mr-sm-2">kids </label>
                            <input id="kids" type="number" name="kids" class="form-control" min="0" wire:model.lazy='kids'>
                            @error('kids')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12">
                            <label for="note" class="mr-sm-2">تفاصيل</label>
                            <textarea id="" cols="15" class="form-control" rows="5" wire:model.lazy='note'></textarea>
                            @error('note')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12">
                            <label for="note_en" class="mr-sm-2">تفاصيل بالانجليزيه</label>
                            <textarea id="" cols="15" class="form-control" rows="5" wire:model.lazy='note_en'></textarea>
                            @error('note_en')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">إغلاق</button>
                        {{-- <button type="submit" class="btn btn-success">إرسال</button> --}}
                        <button type="submit" class="btn btn-success">{{ $ids != null ? 'تعديل' : 'حفظ' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


