<!-- delete_modal_city -->
<div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="exampleModalLabel">
                    حذف المحافظه
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('countries.destroy',$item->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                   <p> هل أنت متأكد من عملية الحذف ؟</p>
                  <p> سيتم نقل  إلى سلة المهملات</p>
                    <input id="id" type="hidden" name="id" class="form-control" value="{{ $item->id }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
