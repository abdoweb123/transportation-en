<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.dashboard')}}</li>


                    <li>
                        <a href="{{route('admin.dashboard')}}" style="padding-bottom:30px;">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Dashboard</span>
                            </div>
                        </a>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#database">
                            <div class="pull-left"><i class="ti-dropbox-alt"></i><span class="right-nav-text">Database</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="database" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('cities.index')}}">{{trans('main_trans.cities_list')}}</a> </li>
                            <li> <a href="{{route('stations.index')}}">{{trans('main_trans.stations_list')}}</a> </li>
                            <li> <a href="{{route('offices.index')}}">Offices List</a> </li>
                            <li> <a href="{{route('routes.index')}}">Routes List</a> </li>
                            <li> <a href="{{route('routeStations.index')}}">Route Stations List</a> </li>
                            <li> <a href="{{route('myEmployees.index')}}">Employees List</a> </li>
                            <li> <a href="{{route('bookingRequests.index')}}">Booking Requests</a> </li>
                            <li> <a href="{{route('employeeRunTrips.index')}}">Employees Run Trip</a> </li>
                            <li> <a href="{{route('departments.index')}}">Departments List</a> </li>
                            <li> <a href="{{route('employeeJobs.index')}}">Jobs List</a> </li>
                            <li> <a href="{{url('static-table/company')}}">Campanies</a></li>
                            <li> <a href="{{url('contract-client')}}">Contract Client</a></li>
                            <li> <a href="{{url('static-table/suppliers')}}">Suppliers</a></li>
                            <li> <a href="{{url('contract-sublier')}}">Contract Subliers</a></li>
                            <li> <a href="{{url('company-contract-route')}}">company contract route</a></li>
                            <li> <a href="{{url('suplier-contract-route')}}">suplier contract route</a></li>
                            <li> <a href="{{url('static-table/service')}}">services type</a></li>

                            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Buses</li>
                            <li> <a href="{{route('busTypes.index')}}">Buses Type List</a></li>
                            <li> <a href="{{route('buses.index')}}">Buses List</a></li>
                            <li> <a href="{{route('seats.create')}}">Add Design to bus</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#database_booking_request">

                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="database_booking_request" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('bookingRequests.index')}}">Booking Requests</a> </li>
                            <li> <a href="{{route('employeeRunTrips.index')}}">Employees Run Trip</a> </li>
                        </ul>
                    </li>




                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#coupons">
                            <div class="pull-left"><i class="ti-comment"></i><span class="right-nav-text">الكوبونات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="coupons" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('coupons.index')}}">قائمة الكوبونات</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#packages">
                            <div class="pull-left"><i class="ti-share"></i><span class="right-nav-text">الاشتراكات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="packages" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('packages.index')}}">قائمة الاشتراكات</a></li>
                            <li> <a href="{{route('bookedPackages.index')}}">قائمة الاشتراكات المحجوزة</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#customerTypes">
                            <div class="pull-left"><i class="ti-cloud"></i><span class="right-nav-text">تصنيف العملاء</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="customerTypes" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('customerTypes.index')}}">قائمة التصنيفات</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#millages">
                            <div class="pull-left"><i class="ti-palette"></i><span class="right-nav-text">الخصومات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="millages" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('millages.index')}}">قائمة الخصومات</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#degrees">
                            <div class="pull-left"><i class="ti-star"></i><span class="right-nav-text">درجات الرحلات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="degrees" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('degrees.index')}}">قائمة درجات الرحلات</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#tripData">
                            <div class="pull-left"><i class="ti-car"></i><span class="right-nav-text">الرحلات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="tripData" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('tripData.index')}}">قائمة الرحلات</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#runTrip">
                            <div class="pull-left"><i class="ti-widget"></i><span class="right-nav-text">تشغيل الرحلة</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="runTrip" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('runTrips.index')}}">قائمة الرحلات المشغلة</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#bus_settings">
                            <div class="pull-left"><i class="ti-settings"></i><span class="right-nav-text">إعدادات الحافلات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="bus_settings" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('vendors.index')}}">قائمة الموردين</a> </li>
                            <li> <a href="{{route('categories.index')}}">مكونات الحافلة</a> </li>
                            <li> <a href="{{route('issues.index')}}">مشكلات مكونات الحافلة</a> </li>
                            <li> <a href="{{route('efficiencyFuels.index')}}">الوقود والكفاءة الأوتوماتيكي</a> </li>
                            <li> <a href="{{route('manuallyFuels.index')}}">استهلاك الوقود اليدوي</a> </li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#employees">
                            <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">الموظفون</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="employees" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('getAllEmployees',3)}}">قائمة الموظفين</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#managers">
                            <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">مديرو الفروع</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="managers" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('getAllManagers',2)}}">قائمة المديرين</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#drivers">
                            <div class="pull-left"><i class="ti-car"></i><span class="right-nav-text">السائقون</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="drivers" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('getAllDrivers')}}">قائمة السائقين</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#clients">
                            <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">العملاء</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="clients" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('getAllUsers')}}">قائمة العملاء</a></li>
                        </ul>
                    </li>



{{--                    <!-- menu title -->--}}
{{--                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Widgets, Forms & Tables </li>--}}
{{--                    <!-- menu item Widgets-->--}}
{{--                    <li>--}}
{{--                        <a href="widgets.html"><i class="ti-blackboard"></i><span class="right-nav-text">Widgets</span>--}}
{{--                            <span class="badge badge-pill badge-danger float-right mt-1">59</span> </a>--}}
{{--                    </li>--}}
{{--                    <!-- menu item Form-->--}}

{{--                    <!-- menu item table -->--}}
{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#table">--}}
{{--                            <div class="pull-left"><i class="ti-layout-tab-window"></i><span class="right-nav-text">data--}}
{{--                                    table</span></div>--}}
{{--                            <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </a>--}}
{{--                        <ul id="table" class="collapse" data-parent="#sidebarnav">--}}
{{--                            <li> <a href="data-html-table.html">Data html table</a> </li>--}}
{{--                            <li> <a href="data-local.html">Data local</a> </li>--}}
{{--                            <li> <a href="data-table.html">Data table</a> </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">More Pages</li>--}}
{{--                    <!-- menu item Custom pages-->--}}

{{--                    <!-- menu item Authentication-->--}}

{{--                    <!-- menu item maps-->--}}
{{--                    <li>--}}
{{--                        <a href="maps.html"><i class="ti-location-pin"></i><span class="right-nav-text">maps</span>--}}
{{--                            <span class="badge badge-pill badge-success float-right mt-1">06</span></a>--}}
{{--                    </li>--}}
{{--                    <!-- menu item timeline-->--}}
{{--                    <li>--}}
{{--                        <a href="timeline.html"><i class="ti-panel"></i><span class="right-nav-text">timeline</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <!-- menu item Multi level-->--}}
{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#multi-level">--}}
{{--                            <div class="pull-left"><i class="ti-layers"></i><span class="right-nav-text">Multi--}}
{{--                                    level Menu</span></div>--}}
{{--                            <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </a>--}}
{{--                        <ul id="multi-level" class="collapse" data-parent="#sidebarnav">--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#auth">Level--}}
{{--                                    item 1<div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                                    <div class="clearfix"></div>--}}
{{--                                </a>--}}
{{--                                <ul id="auth" class="collapse">--}}
{{--                                    <li>--}}
{{--                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#login">Level--}}
{{--                                            item 1.1<div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                                            <div class="clearfix"></div>--}}
{{--                                        </a>--}}
{{--                                        <ul id="login" class="collapse">--}}
{{--                                            <li>--}}
{{--                                                <a href="javascript:void(0);" data-toggle="collapse"--}}
{{--                                                    data-target="#invoice">level item 1.1.1<div class="pull-right"><i--}}
{{--                                                            class="ti-plus"></i></div>--}}
{{--                                                    <div class="clearfix"></div>--}}
{{--                                                </a>--}}
{{--                                                <ul id="invoice" class="collapse">--}}
{{--                                                    <li> <a href="#">level item 1.1.1.1</a> </li>--}}
{{--                                                    <li> <a href="#">level item 1.1.1.2</a> </li>--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li> <a href="#">level item 1.2</a> </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#error">level--}}
{{--                                    item 2<div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                                    <div class="clearfix"></div>--}}
{{--                                </a>--}}
{{--                                <ul id="error" class="collapse">--}}
{{--                                    <li> <a href="#">level item 2.1</a> </li>--}}
{{--                                    <li> <a href="#">level item 2.2</a> </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
