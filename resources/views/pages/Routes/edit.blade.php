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
                        {{-- <div class="col-md-6">
                            <label class="mr-sm-2">companies</label>
                            <select name="company_id" class="form-control">
                                <option value=" " selected>-- Choose --</option>
                                @foreach($comapnies as $company)
                                    <option value="{{$company->id}}" {{$item->company_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="col-md-12">
                            <label class="mr-sm-2">description</label>
                            <textarea name="description" class="form-control" id="" cols="15" rows="5">{{ $item->description }}</textarea>
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


<div class="modal fade" id="importExcel" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                   add file
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <!-- add_form -->
               <form action="{{ url('importRoutes') }}" method="post" enctype="multipart/form-data">
                   {{ method_field('post') }}
                   @csrf
                   <div class="row">
                       <div class="col">
                           <label for="file" class="mr-sm-2">{{ trans('cities_trans.file') }}:</label>
                           {{-- <input type="text" name="test" value="test" id=""> --}}
                           <input type="file" name="excel">
                       </div>
                       <div class="col">
                        <label for="file" class="mr-sm-2">company:</label>
                        <select name="company_id" class="form-control">
                            <option value=" ">-- Choose --</option>
                            @foreach($comapnies as $company)
                                <option value="{{$company->id}}" {{$request_company_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                            @endforeach
                        </select>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                       <button type="submit" class="btn btn-success">{{ trans('main_trans.submit') }}</button>
                   </div>
               </form>

           </div>
       </div>
   </div>
</div>