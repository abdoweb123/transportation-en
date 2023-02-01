<!-- add_modal_city -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Add Vendor
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('vendors.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Name :</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Phone :</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="registration_number" class="mr-sm-2">Registration Number :</label>
                            <input type="text" name="registration_number" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Taxes Number :</label>
                            <input type="text" name="taxes_number" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="vendor_type" class="mr-sm-2">Vendor Type:</label>
                            <select class="form-control mr-sm-2 p-2" name="vendor_type_id">
                                <option class="custom-select mr-sm-2 p-2" value=" ">{{ trans('stations_trans.choose') }}</option>
                                @foreach($vendor_types as $vendor_type)
                                <option value="{{$vendor_type->id}}">{{ $vendor_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="national_id" class="mr-sm-2">National Id:</label>
                            <input type="text" name="national_id" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Email :</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">Description :</label>
                            <textarea name="description" class="form-control"></textarea>
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
