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
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">لوحة التحكم</span>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#cities">
                            <div class="pull-left"><i class="ti-layers"></i><span class="right-nav-text">{{trans('main_trans.cities')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="cities" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('cities.index')}}">{{trans('main_trans.cities_list')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#stations">
                            <div class="pull-left"><i class="ti-palette"></i><span class="right-nav-text">{{trans('main_trans.stations')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="stations" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('stations.index')}}">{{trans('main_trans.stations_list')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#offices">
                            <div class="pull-left"><i class="ti-blackboard"></i><span class="right-nav-text">المكاتب</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="offices" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('offices.index')}}">قائمة المكاتب</a> </li>
                        </ul>
                    </li>



                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#buses">
                            <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">الحافلات</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="buses" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('busTypes.index')}}">أساطيل الحافلات</a></li>
                            <li> <a href="{{route('buses.index')}}">قائمة الحافلات</a></li>
                        </ul>
                    </li>
                    <!-- menu title -->



{{--                    <li>--}}
{{--                        <a href="todo-list.html"><i class="ti-menu-alt"></i><span class="right-nav-text">Todo--}}
{{--                                list</span> </a>--}}
{{--                    </li>--}}
                    <!-- menu item chat-->
{{--                    <li>--}}
{{--                        <a href="chat-page.html"><i class="ti-comments"></i><span class="right-nav-text">Chat--}}
{{--                            </span></a>--}}
{{--                    </li>--}}
{{--                    <!-- menu item mailbox-->--}}
{{--                    <li>--}}
{{--                        <a href="mail-box.html"><i class="ti-email"></i><span class="right-nav-text">Mail--}}
{{--                                box</span> <span class="badge badge-pill badge-warning float-right mt-1">HOT</span> </a>--}}
{{--                    </li>--}}
{{--                    <!-- menu item Charts-->--}}
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#seats">
                            <div class="pull-left"><i class="ti-menu-alt"></i><span class="right-nav-text">المقاعد</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="seats" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('seats.create')}}">إضافة تصميم</a></li>
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
{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page">--}}
{{--                            <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">Custom--}}
{{--                                    pages</span></div>--}}
{{--                            <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </a>--}}
{{--                        <ul id="custom-page" class="collapse" data-parent="#sidebarnav">--}}
{{--                            <li> <a href="projects.html">projects</a> </li>--}}
{{--                            <li> <a href="project-summary.html">Projects summary</a> </li>--}}
{{--                            <li> <a href="profile.html">profile</a> </li>--}}
{{--                            <li> <a href="app-contacts.html">App contacts</a> </li>--}}
{{--                            <li> <a href="contacts.html">Contacts</a> </li>--}}
{{--                            <li> <a href="file-manager.html">file manager</a> </li>--}}
{{--                            <li> <a href="invoice.html">Invoice</a> </li>--}}
{{--                            <li> <a href="blank.html">Blank page</a> </li>--}}
{{--                            <li> <a href="layout-container.html">layout container</a> </li>--}}
{{--                            <li> <a href="error.html">Error</a> </li>--}}
{{--                            <li> <a href="faqs.html">faqs</a> </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <!-- menu item Authentication-->--}}
{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">--}}
{{--                            <div class="pull-left"><i class="ti-id-badge"></i><span--}}
{{--                                    class="right-nav-text">Authentication</span></div>--}}
{{--                            <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </a>--}}
{{--                        <ul id="authentication" class="collapse" data-parent="#sidebarnav">--}}
{{--                            <li> <a href="login.html">login</a> </li>--}}
{{--                            <li> <a href="register.html">register</a> </li>--}}
{{--                            <li> <a href="lockscreen.html">Lock screen</a> </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
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
