<!-- delete_modal_city -->
<div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="exampleModalLabel">
                    Delete Employee
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('myEmployees.destroy',$item->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                   <p> Are you sure about deleting this employee ?  </p>
{{--                   <p> سيتم نقل  هذه المحافظة إلى سلة المهملات</p>--}}
                    <input id="id" type="hidden" name="id" class="form-control" value="{{ $item->id }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Save</button>
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
               <form action="{{ url('importEmployees') }}" method="post" enctype="multipart/form-data">
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