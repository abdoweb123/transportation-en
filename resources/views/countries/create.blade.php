<!-- add_modal_city -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    إضافة محافظه
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('countries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name_ar" class="mr-sm-2">اسم المحافظه باللغة العربية</label>
                            <input id="name_ar" type="text" name="name_ar" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="name_en" class="mr-sm-2">اسم المحافظه باللغة الإنجليزية</label>
                            <input id="name_en" type="text" name="name_en" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="mr-sm-2">الصوره</label>
                            <input id="image" type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="code" class="mr-sm-2">الكود</label>
                            <input id="code" type="text" name="code" class="form-control">
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
