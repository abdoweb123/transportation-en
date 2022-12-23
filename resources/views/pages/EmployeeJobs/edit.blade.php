<!-- edit_modal_city -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Edit Job
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('employeeJobs.update',$item->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">Name :</label>
                            <input type="text" name="name" value="{{old('name',$item->name)}}" class="form-control" required>
                        </div>
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
