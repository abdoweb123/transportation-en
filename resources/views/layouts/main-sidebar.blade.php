<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <input type="text" class="form-control" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
                    
                    <li>
                        <a href="{{url('dashboard')}}" style="padding-bottom:30px;">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ trans('main_trans.dashboard') }}</span>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Fleet">
                            <div class="pull-left"><i class="fab fa-mastodon"></i><span class="right-nav-text">{{ trans('main_trans.master_data') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Fleet" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#master_code">
                                    <i class="fab fa-digital-ocean"></i>{{ trans('main_trans.system_code') }}
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="master_code" class="collapse" data-parent="#master_code">
                                    <li> <a href="{{url('static-table/insurance_kind')}}"><i class="menu-item"></i> {{ trans('main_trans.driving_license') }}</a></li>
                                    <li> <a href="#"><i class="menu-item"></i> {{ trans('main_trans.customer_type') }}</a></li>
                                    <li> <a href="{{url('static-table/supplier_type')}}"><i class="menu-item"></i> {{ trans('main_trans.supplier_type') }}</a></li>
                                    <li> <a href="{{url('static-table/service')}}"><i class="menu-item"></i> {{ trans('main_trans.service_type') }}</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#hr_system_code">
                                    <i class="fas fa-hryvnia"></i>{{ trans('main_trans.hr_system_code') }}
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="hr_system_code" class="collapse" data-parent="#hr_system_code">
                                    <li> <a href="{{route('departments.index')}}"><i class="menu-item"></i> {{ trans('main_trans.list_of_depart') }}</a> </li>
                                    <li> <a href="{{route('employeeJobs.index')}}"><i class="menu-item"></i> {{ trans('main_trans.list_of_jod') }}</a> </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#booking_system_codes">
                                    <i class="fab fa-dochub"></i>{{ trans('main_trans.booking_system_codes') }}
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="booking_system_codes" class="collapse" data-parent="#booking_system_codes">
                                    <li> <a href="{{url('static-table/discount_type')}}"><i class="menu-item"></i> {{ trans('main_trans.list_of_discount_types') }}</a> </li>
                                    <li> <a href="{{url('discounts')}}"><i class="menu-item"></i> {{ trans('main_trans.list_of_discounts') }}</a> </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#list_of_benificiaries">
                                    <i class="fab fa-behance"></i>{{ trans('main_trans.list_of_benificiaries') }}
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="list_of_benificiaries" class="collapse" data-parent="#list_of_benificiaries">
                                    <li> <a href="{{route('getAllDrivers')}}"><i class="menu-item"></i> {{ trans('main_trans.list_of_driver') }}</a> </li>
                                    <li> <a href="{{url('companies')}}"><i class="menu-item"></i> {{ trans('main_trans.list_of_customers') }}</a> </li>
                                    <li> <a href="{{url('static-table/suppliers')}}"><i class="menu-item"></i> {{ trans('main_trans.list_of_suppliers') }}</a> </li>
                                    <li> <a href="{{route('myEmployees.index')}}"><i class="menu-item"></i> {{ trans('main_trans.list_of_employees') }}</a> </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#list_of_locations">
                                    <i class="fas fa-location-arrow"></i>{{ trans('main_trans.list_of_locations') }}
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="list_of_locations" class="collapse" data-parent="#list_of_locations">
                                    <li> <a href="{{ url('countries') }}"><i class="menu-item"></i> {{ trans('main_trans.list_of_governorate') }}</a> </li>
                                    <li> <a href="{{route('cities.index')}}"><i class="menu-item"></i>{{trans('main_trans.list_of_cities')}}</a> </li>
                                    <li> <a href="{{route('stations.index')}}"><i class="menu-item"></i>{{trans('main_trans.list_of_stations')}}</a> </li>
                                    <li> <a href="{{route('offices.index')}}"><i class="menu-item"></i>{{trans('main_trans.list_of_offices')}}</a> </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#fleet_management_systemone">
                                    <i class="fab fa-first-order-alt"></i>{{ trans('main_trans.fleet_management_system') }}
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>

                                <ul id="fleet_management_systemone" class="collapse" data-parent="#fleet_management_system">
                                    <li> <a href="{{url('static-table/penalty_type')}}"><i class="menu-item"></i> {{ trans('main_trans.list_of_penalty_types') }}</a> </li>
                                    <li> <a href="{{url('static-table/accident_type')}}"><i class="menu-item"></i>{{trans('main_trans.list_of_accident_ypes')}}</a> </li>
                                    <li> <a href="{{url('static-table/gas_type')}}"><i class="menu-item"></i>{{trans('main_trans.list_of_fuel_types')}}</a> </li>
                                    <li> <a href="{{route('expenses')}}"><i class="menu-item"></i>{{trans('main_trans.list_of_expenses_types')}}</a> </li>
                                    <li> <a href="{{url('static-table/gudget_brand')}}"><i class="menu-item"></i>{{trans('main_trans.list_of_spare_parts')}}</a> </li>
                                    <li> <a href="{{url('static-table/gudget_type')}}"><i class="menu-item"></i>{{trans('main_trans.list_of_spare_part_types')}}</a> </li>
                                </ul>
                            </li>

                         
                            <li> <a href="{{route('seats.create')}}"><i class='fas fa-business-time'></i> Add Design to bus</a></li>
                            <li> <a href="{{url('static-table/extra_fees_type')}}"><i class="fas fa-external-link-square-alt"></i>Extra fees types</a> </li>
                            <li> <a href="{{url('extra-fees')}}"><i class="fas fa-code-branch"></i>Extra fees</a> </li>
                            <li> <a href="{{route('vendors.index')}}"><i class="fas fa-store"></i>Vendors</a> </li>
                            <li> <a href="{{url('static-table/vendor_type')}}"><i class="fas fa-external-link-square-alt"></i>Vendor Type</a> </li>
                            <li> <a href="{{route('categories.index')}}"><i class="fas fa-bus-alt"></i>Bus Categories</a> </li>
                            <li> <a href="{{route('issues.index')}}"><i class="fas fa-wrench"></i>Bus Categories Issues </a> </li>
                            <li> <a href="{{url('static-table/borrow_type')}}"><i class="fas fa-external-link-square-alt"></i>borrow Type</a> </li>
                            <li> <a href="{{route('routeStations.index')}}">Route Stations List</a> </li>
                            {{-- <li> <a href="{{route('car-payment-dates')}}"><i class="fas fa-history"></i>car payments </a></li> --}}
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#operation_management_system">
                            <div class="fab fa-glide-g"> <span class="right-nav-text">{{ trans('main_trans.operation_management_system') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="operation_management_system" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('routes.index')}}"><i class="fas fa-route"></i> {{ trans('main_trans.list_of_routes') }}</a> </li>
                        
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#list_of_routes">
                                    <i class="fab fa-first-order-alt"></i>{{ trans('main_trans.list_of_routes') }}
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="list_of_routes" class="collapse" data-parent="#list_of_routes">
                                    <li> <a href="{{url('contract-client')}}"><i class="menu-item"></i> {{ trans('main_trans.customers_contracts') }}</a> </li>
                                    <li> <a href="{{url('contract-sublier')}}"><i class="menu-item"></i>{{trans('main_trans.suppliers_Contracts')}}</a> </li>
                                    <li> <a href="{{url('driver-salary')}}"><i class="menu-item"></i>{{trans('main_trans.drivers_Contracts')}}</a> </li>
                                </ul>
                            </li>
                            <li> <a href="{{route('bookingRequests.index')}}"><i class="fas fa-swatchbook"></i> {{ trans('main_trans.booking_list') }}</a> </li>
                            <li> <a href="{{url('employeeRunTripsNew')}}"><i class="fab fa-cc-stripe"></i> {{ trans('main_trans.list_of_trips') }}</a> </li>
                            <li> <a href="{{route('getAssignEmployee')}}"><i class="fab fa-markdown"></i>{{ trans('main_trans.route_client_mang') }}</a> </li>
                            <li> <a href="{{url('swap-request')}}"><i class="fab fa-symfony"></i> {{ trans('main_trans.swap_equests') }}</a> </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#fleet_management_system1">
                            <div class="fab fa-confluence"> <span class="right-nav-text">{{ trans('main_trans.fleet_management_system') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="fleet_management_system1" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#fleet_maData">
                                    <i class="fab fa-first-order-alt"></i>{{ trans('main_trans.fleet_maData') }}
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>

                                <ul id="fleet_maData" class="collapse" data-parent="#fleet_maData">
                                    <li> <a href="{{url('static-table/bank')}}"><i class="menu-item"></i> {{ trans('main_trans.bank_details') }}</a> </li>
                                    <li> <a href="{{url('static-table/insurance_company')}}"><i class="menu-item"></i> {{ trans('main_trans.insurance_companies') }}</a> </li>
                                    <li> <a href="{{url('contract-sublier')}}"><i class="menu-item"></i>{{trans('main_trans.list_of_brands')}}</a> </li>
                                    <li> <a href="{{url('static-table/bus_model')}}"><i class="menu-item"></i>{{trans('main_trans.list_of_models')}}</a> </li>
                                    <li> <a href="{{route('busTypes.index')}}"><i class="menu-item"></i>{{trans('main_trans.list_of_designs')}}</a> </li>
                                    <li> <a href="{{url('buses')}}"><i class="menu-item"></i>{{trans('main_trans.list_of_fleet')}}</a> </li>
                                </ul>
                            </li>
                            <li> <a href="{{url('gases')}}"><i class="fas fa-swatchbook"></i> {{ trans('main_trans.Fuel_data') }}</a> </li>
                            <li> <a href="{{url('penelties')}}"><i class="fab fa-cc-stripe"></i> {{ trans('main_trans.penalty_data') }}</a> </li>
                            <li> <a href="{{url('accidents')}}"><i class="fab fa-markdown"></i>{{ trans('main_trans.accident_data') }}</a> </li>
                            <li> <a href="{{route('reminderHistory.index')}}"><i class="fab fa-symfony"></i>{{ trans('main_trans.preventive_maintenance_reminders') }}</a> </li>
                            <li> <a href="{{route('reminders.index')}}"><i class="fab fa-markdown"></i>{{ trans('main_trans.repair_data') }}</a> </li>
                            <li> <a href="{{url('car-payments')}}"><i class="fab fa-markdown"></i>{{ trans('main_trans.fleet_installments') }}</a> </li>


                        </ul>
                    </li>

                    {{-- <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#database">
                            <div class="pull-left"><i class="ti-dropbox-alt"></i><span class="right-nav-text">Database</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="database" class="collapse" data-parent="#sidebarnav"> --}}
                            
                            {{-- <li> <a href="{{route('bookingRequests.index')}}">Booking Requests</a> </li>
                            <li> <a href="{{route('employeeRunTrips.index')}}">Employees Run Trip</a> </li> --}}
    
                            {{-- <li> <a href="{{url('company-contract-route')}}">company contract route</a></li> --}}
                            {{-- <li> <a href="{{url('suplier-contract-route')}}">suplier contract route</a></li> --}}
                            
{{-- 
                        </ul>
                    </li> --}}


                    {{-- <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#database_booking_request">
                            <div class="pull-left"><i class="ti-ticket"></i><span class="right-nav-text">Booking Request Database</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="database_booking_request" class="collapse" data-parent="#sidebarnav">
                            
                        </ul>
                    </li> --}}


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#reports">
                            <div class="pull-left"><i class="ti-notepad"></i><span class="right-nav-text">{{ trans('main_trans.report') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="reports" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('revenues')}}">{{ trans('main_trans.revenus') }}</a></li>
                            <li> <a href="{{route('emptySeatsPerBus')}}">{{ trans('main_trans.empty_seats_per_car') }}</a> </li>
                            <li> <a href="{{route('getRunTripByBus_id')}}">{{ trans('main_trans.name_of_employee') }}</a></li>
                            {{-- <li> <a href="{{route('emptySeatsPerRoute')}}">Empty Seats Per Route</a></li> --}}
                            <li> <a href="{{route('bookingrequest-report')}}">{{ trans('main_trans.boo_request') }}</a></li>
                            {{-- <li> <a href="{{route('employeeRunTrips.index')}}">Names Of Employees Per Departure</a></li>
                            <li> <a href="{{route('employeeRunTrips.index')}}">Names Of Employees Per Arrival</a></li> --}}
                            
                        </ul>
                    </li>
                    



                    {{--  <li>
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
                    </li>  --}}
{{--
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#drivers">
                            <div class="pull-left"><i class="ti-car"></i><span class="right-nav-text">drivers</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="drivers" class="collapse" data-parent="#sidebarnav">
                        </ul>
                    </li>  --}}

                    {{--  <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#clients">
                            <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">العملاء</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="clients" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('getAllUsers')}}">قائمة العملاء</a></li>
                        </ul>
                    </li>  --}}



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

            
