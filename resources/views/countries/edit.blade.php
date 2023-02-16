<!-- edit_modal_city -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    تعديل بيانات المحافظه
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('countries.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name_ar" class="mr-sm-2">اسم المحافظه باللغة العربية</label>
                            <input id="name_ar" type="text" name="name_ar" value="{{ $item->getTranslation('name', 'ar') }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="name_en" class="mr-sm-2">اسم المحافظه باللغة الإنجليزية</label>
                            <input id="name_en" type="text" name="name_en" value="{{ $item->getTranslation('name', 'en') }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="mr-sm-2">الصوره</label>
                            <input id="image" type="file" name="image"  class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="code" class="mr-sm-2">الكود</label>
                            <input id="code" type="text" name="code" value="{{ $item->code }}" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="image" class="mr-sm-2">الحالة</label>
                            <select name="active" class="form-control">
                                @if($item->active == 1)
                                    <option value="1" selected>نشط</option>
                                    <option value="2">غير نشط</option>
                                @else
                                    <option value="1">نشط</option>
                                    <option value="2" selected>غير نشط</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">إرسال</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
