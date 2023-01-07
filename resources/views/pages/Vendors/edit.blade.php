<!-- edit_modal_city -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                 Edit Vendor's Data
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('vendors.update', $item->id) }}" method="post">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Name :</label>
                            <input type="text" name="name" value="{{$item->name}}" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Phone :</label>
                            <input type="text" name="phone" value="{{$item->phone}}" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Email :</label>
                            <input type="email" name="email" value="{{$item->email}}" class="form-control">
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
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Description :</label>
                            <textarea name="description" class="form-control">{{$item->description}}</textarea>
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
