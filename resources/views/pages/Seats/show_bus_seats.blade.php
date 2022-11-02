@extends('layouts.master')
@section('css')
@section('title')
        بيانات الحافلة
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    بيانات الحافلة
@stop
<!-- breadcrumb -->
@endsection

@section('style')
    <style>
        .table td{padding: 8px;}
    </style>
@endsection


@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    @foreach(['danger','warning','success','info'] as $msg)
                        @if(Session::has('alert-'.$msg))
                            <div class="alert alert-{{$msg}}">
                                {{Session::get('alert-'.$msg)}}
                            </div>
                        @endif
                    @endforeach


                    <br><br>

                    <!-- Start bus information -->
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                                <tr>
                                    <th>كود الحافلة</th>
                                    <th>اسم الحافلة</th>
                                    <th>عدد الكراسي</th>
                                    <th>طول الحافلة</th>
                                    <th>عرض الحافلة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $bus->code  }}</td>
                                    <td>{{ $bus->name  }}</td>
                                    <td>{{ $bus->slug  }}</td>
                                    <td>{{ $bus->length  }}</td>
                                    <td>{{ $bus->width  }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- End bus information -->

                    <!-- Start bus design and edit seats-->
                    <form action="{{route('update.seats')}}" method="post">
                        @csrf
                    <div class="bus_design my-5 mx-auto text-center">
                        <h3 style="font-family: 'Cairo', sans-serif;">عرض تصميم الحافلة</h3>
                        <div class="bus_box row mx-auto my-3" style="background-color:#ddd; width:{{$bus->width*100 + $bus->width*20}}px; height:{{$bus->length*90 + $bus->length*20}}px;">
                            @foreach($seats as $item)
                                <div id="select-{{$item->name}}"
                                     style="@if($item->type == 'driver') background-color:#c4c40b; color:white;
                                     @elseif($item->type == 'unacceptable') background-color:red; color:white;
                                     @else background-color:beige;  @endif width:100px; height:90px; padding:37px 0; margin:10px; text-align:center; position:relative">
                                    <a>
                                        <select name="type[{{$item->name}}]" class="select" style="position:absolute; top:0; right:-65px; display:none">
                                            <option selected disabled>اختر</option>
                                            <option value="driver">سائق</option>
                                            <option value="acceptable">متاح</option>
                                            <option value="unacceptable">غير متاح</option>
                                        </select>
                                        {{$item->name}}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <button class="btn btn-success nextBtn btn-lg" type="submit">تعديل</button>
                        </div>
                    </div>
                    </form>
                    <!-- End bus design and edit seats-->

                    <!-- Start seats information -->
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>اسم المقعد</th>
                                <th>حالة المقعد بالنسبة للعميل</th>
                                <th>نوع المقعد</th>
{{--                                <th>العمليات</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($seats as $item)
                                <tr>
                                    <td>{{ $item->name  }}</td>
                                    <td>@if($item->staus == null) غير محدد @else {{$item->staus}} @endif</td>
                                    @if($item->type == 'acceptable')
                                        <td><span style="background-color:green; color:white; padding:3px;">{{$item->type}}</span></td>
                                    @elseif($item->type == 'unacceptable')
                                        <td><span style="background-color:red; color:white; padding:3px;">{{$item->type}}</span></td>
                                    @elseif($item->type == 'driver')
                                        <td><span style="background-color:#c4c40b; color:white; padding:3px;">{{$item->type}}</span></td>
                                    @endif


{{--                                    <td>--}}
{{--                                        <div class="dropdown show">--}}
{{--                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                العمليات--}}
{{--                                            </a>--}}
{{--                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">--}}
{{--                                                <a type="button" class="dropdown-item" style="cursor:pointer" data-toggle="modal"--}}
{{--                                                   data-target="#edit{{ $item->id }}" title="تعديل">--}}
{{--                                                    <i style="color:#a3a373" class="fa fa-edit"></i>&nbsp; تعديل</a>--}}

{{--                                                <a type="button" class="dropdown-item" style="cursor:pointer" data-toggle="modal"--}}
{{--                                                   data-target="#delete{{ $item->id }}" title="حذف">--}}
{{--                                                    <i style="color:red" class="fa fa-trash"></i>&nbsp; حذف</a>--}}

{{--                                                <a type="button" class="dropdown-item" style="cursor:pointer" data-toggle="modal"--}}
{{--                                                   data-target="#show{{ $item->id }}" title="عرض">--}}
{{--                                                    <i style="color:green" class="fa fa-eye"></i>&nbsp; عرض</a>--}}

{{--                                                <a href="{{route('show.bus.seats',$item->id)}}" class="dropdown-item" style="cursor:pointer" title="عرض التفاصيل">--}}
{{--                                                    <i style="color:green" class="fa fa-eye"></i>&nbsp; عرض التفاصيل</a>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End seats information -->


                </div>
            </div>
        </div>


    </div>



@endsection
@section('js')
    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function(){
            $(".alert").delay(5000).slideUp(300);



            /*** To hide select options when click on another seat ***/
            $('.bus_box').on('click', 'div', function ()
            {
                $(this).find('select').fadeIn();
                $(this).siblings().find('select').fadeOut();
            });


            /*** To change the background of a seat after choosing a type ***/
            $('.bus_box').on('change', 'div select', function ()
            {
                let option_val = $(this).find('option:selected').val();
                let option = $(this).find('option:selected').parents().eq(2);
                if (option_val === 'driver'){
                    option.css({
                        backgroundColor:'#c4c40b',
                        color:'white',
                    })
                }
                if(option_val === 'unacceptable'){
                    option.css({
                        backgroundColor:'red',
                        color:'white',
                    })
                }
                if(option_val === 'acceptable'){
                    option.css({
                        backgroundColor:'beige',
                        color:'black',
                    })
                }
            });


        }); //end of document
    </script>
@endsection


