<!-- edit_modal_city -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                  Edit Category's Data
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('categories.update', $item->id) }}" method="post">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">Name :</label>
                            <input id="Name" type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                        </div>
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Status :</label>
                            <select name="active" class="form-control">
                                @if($item->active == 1)
                                    <option value="1" selected>Active</option>
                                    <option value="0">Un active</option>
                                @else
                                    <option value="1">Active</option>
                                    <option value="0" selected>Un active</option>
                                @endif
                            </select>
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
