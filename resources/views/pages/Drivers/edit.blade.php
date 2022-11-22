<!-- edit_modal_city -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    تعديل بيانات الموظف
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form method="POST" action="{{ route('update.driver') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{$item->id}}" name="id">
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">الاسم * :</label>
                            <input id="name" type="text" name="name" value="{{$item->name}}" class="form-control">
                        </div>
                        <div class="col">
                            <label for="title" class="mr-sm-2">المسمي الوظيفي :</label>
                            <input type="text" class="form-control" name="title"  value="{{$item->title}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="email" class="mr-sm-2">البريد الإلكتروني :</label>
                            <input id="email" type="text" name="email"  value="{{$item->email}}" class="form-control">
                        </div>
                        <div class="col">
                            <label for="password" class="mr-sm-2">كلمة المرور * :</label>
                            <input type="text" class="form-control" name="password"  value="{{$item->password}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="mobile" class="mr-sm-2">الهاتف * :</label>
                            <input type="text" class="form-control" name="mobile"  value="{{$item->mobile}}">
                        </div>
                        <div class="col">
                            <label for="image" class="mr-sm-2">الصورة * :</label>
                            <input type="file" class="form-control" name="image"  value="{{$item->image}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="city_id" class="mr-sm-2">اسم المكتب التابع له * :</label>
                            <select class="form-control mr-sm-2 p-2" name="office_id" >
                                <option class="custom-select mr-sm-2 p-2" value=" ">--- اختر اسم المكتب ---</option>
                                <option value="{{$item->office_id}}" selected>{{ $item->office->name }}</option>
                                @foreach($offices as $office)
                                    @if($office->id != $item->office_id)
                                    <option value="{{$office->id}}">{{ $office->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-success"><span>تعديل</span></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
