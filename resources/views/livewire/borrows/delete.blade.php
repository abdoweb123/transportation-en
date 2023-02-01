<div class="modal modal-info fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content bg-info">
        <div class="modal-header">
            <h4 class="modal-title">Info Modal</h4>
            <a href="javascript:void(0);" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
        </div>
        <div class="modal-body">
                <p> هل أنت متأكد من عملية الحذف ؟</p>
                <p> سيتم نقل عامل التوصيل إلى سلة المهملات</p>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-danger" data-bs-dismiss="modal">غلق</a>
                    <a href="javascript:void(0);" class="btn btn-primary" wire:click.prevent='delete_at'>حذف</a>
                </div>
        </div>
        {{-- <div class="modal-footer">
            <a href="javascript:void(0);" class="btn btn-danger" data-bs-dismiss="modal">غلق</a>
            <a href="javascript:void(0);" class="btn btn-primary" float-end data-bs-dismiss="modal">حذف</a>
        </div> --}}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->