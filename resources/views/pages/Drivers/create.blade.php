<!-- add_modal_station -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    إضافة سائق
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form method="POST" action="{{ route('create.driver') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">الاسم * :</label>
                            <input id="name" type="text" name="name" class="form-control">
                        </div>
                        <div class="col">
                            <label for="title" class="mr-sm-2">المسمي الوظيفي :</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="email" class="mr-sm-2">البريد الإلكتروني :</label>
                            <input id="email" type="text" name="email" class="form-control">
                        </div>
                        <div class="col">
                            <label for="password" class="mr-sm-2">كلمة المرور * :</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="mobile" class="mr-sm-2">الهاتف * :</label>
                            <input type="text" class="form-control" name="mobile">
                        </div>
                        <div class="col">
                            <label for="image" class="mr-sm-2">الصورة * :</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col">
                            <label for="national_id" class="mr-sm-2">الرقم القومي * :</label>
                            <input type="text" class="form-control" name="national_id">
                        </div>
                        <div class="col">
                            <label for="image" class="mr-sm-2">نوع الرخصه * :</label>
                            <select class="form-control mr-sm-2 p-2" name="insurance_kind_id">
                                <option class="custom-select mr-sm-2 p-2" value=" ">--- اختر نوع الرخصه ---</option>
                                @foreach($insurance_kinds as $insurance)
                                    <option value="{{$insurance->id}}">{{ $insurance->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col ">
                            <label for="expiration_insurance_date" class="mr-sm-2">تاريخ انتهاء الرخصه</label>
                            <input id="expiration_insurance_date" type="date" class="form-control" name='expiration_insurance_date'>
                            @error('expiration_insurance_date')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                        <div class="col ">
                            <label for="insurance_insurance_date" class="mr-sm-2">تاريخ انتهاء الضريبه</label>
                            <input id="insurance_insurance_date" type="date" class="form-control" name='insurance_insurance_date'>
                            @error('insurance_insurance_date')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col ">
                            <label for="city_id" class="mr-sm-2">اسم المكتب التابع له * :</label>
                            <select class="form-control mr-sm-2 p-2" name="office_id">
                                <option class="custom-select mr-sm-2 p-2" value=" ">--- اختر اسم المكتب ---</option>
                                @foreach($offices as $office)
                                    <option value="{{$office->id}}">{{ $office->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col ">
                            <label for="images" class="mr-sm-2">صور للاوراق المطلوبه</label>
                            <input id="images" type="file" class="form-control" name='images[]' multiple>
                            @error('images')<span style="color: red"> {{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-success"><span>حفظ</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
