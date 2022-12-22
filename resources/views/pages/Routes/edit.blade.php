<!-- edit_modal_city -->
<div class="modal fade" id="editRoute{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Edit Office Data
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('routes.update','test') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">Name :</label>
                            <input id="Name" type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $item->id }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="image" class="mr-sm-2">Status</label>
                            <select name="active" class="form-control">
                                @if($item->active == 1)
                                    <option value="1" selected>active</option>
                                    <option value="2">un active</option>
                                @else
                                    <option value="1">active</option>
                                    <option value="2" selected>un active</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
