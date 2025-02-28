<!-- edit_modal_city -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('cities_trans.edit_city') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('cities.update', 'test') }}" method="post">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('cities_trans.city_name_ar') }}:</label>
                            <input id="Name" type="text" name="name_ar" class="form-control" value="{{ $item->getTranslation('name', 'ar') }}" required>
                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $item->id }}">
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">{{ trans('cities_trans.city_name_en') }}:</label>
                            <input type="text" class="form-control" value="{{ $item->getTranslation('name', 'en') }}" name="name_en" required>
                        </div>
                        {{-- <div class="col">
                            <label class="mr-sm-2">companies</label>
                            <select name="company_id" class="form-control">
                                <option value=" " selected>-- Choose --</option>
                                @foreach($comapnies as $company)
                                    <option value="{{$company->id}}" {{old('company_id') == $company->company_id ? 'selected' : ''}}>{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}
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

<div class="modal fade" id="importExcel" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                   {{ trans('cities_trans.edit_city') }}
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <!-- add_form -->
               <form action="{{ url('importCities') }}" method="post" enctype="multipart/form-data">
                   {{ method_field('post') }}
                   @csrf
                   <div class="row">
                       <div class="col">
                           <label for="file" class="mr-sm-2">{{ trans('cities_trans.file') }}:</label>
                           {{-- <input type="text" name="test" value="test" id=""> --}}
                           <input type="file" name="excel" required>
                       </div>
                       <div class="col">
                        <label for="file" class="mr-sm-2">company:</label>
                        <select name="company_id" class="form-control" required>
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
