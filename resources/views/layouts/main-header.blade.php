        <!--=================================
 header start-->
        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="index.html"><img src="{{asset('assets/images/logo-dark.png')}}" alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('assets/images/logo-icon-dark.png')}}"
                        alt=""></a>
            </div>
            <!-- Top bar left -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>
                <li class="nav-item">
                    <div class="search">
                        <a class="search-btn not_click" href="javascript:void(0);"></a>
                        <div class="search-box not-click">
                            <input type="text" class="not-click form-control" placeholder="Search" value=""
                                name="search">
                            <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">
{{--                <li class="nav-item dropdown">--}}
{{--                    <a id="navbarDropdown" class="btn btn-success p-10 nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                         {{trans('main_trans.change_language')}}--}}
{{--                    </a>--}}

{{--                    <div class="dropdown-menu dropdown-menu-end p-10" aria-labelledby="navbarDropdown">--}}
{{--                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}

{{--                                <a class="d-block p-1" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">--}}
{{--                                    {{ $properties['native'] }}--}}
{{--                                </a>--}}
{{--                            @endforeach--}}
{{--                    </div>--}}
{{--                </li>--}}

                <li class="nav-item dropdown">
                    <div class="btn-group mb-1">
                        <button type="button" class="btn p-10 btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{--   {{trans('main_trans.change_language')}}--}}
                            @if(App::getLocale() == 'ar')
                                العربية
                                <img src="{{ URL::asset('assets/images/flags/EG.png') }}" alt="">
                            @elseif(App::getLocale() == 'en')
                                 English
                                <img src="{{ URL::asset('assets/images/flags/US.png') }}" alt="">
                            @endif
                        </button>
                        <div class="dropdown-menu">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </li>

                <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="ti-bell"></i>
                        <span class="badge badge-danger notification-status"> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                        <div class="dropdown-header notifications">
                            <strong>Notifications</strong>
                            <span class="badge badge-pill badge-warning">05</span>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">New registered user <small
                                class="float-right text-muted time">Just now</small> </a>
                        <a href="#" class="dropdown-item">New invoice received <small
                                class="float-right text-muted time">22 mins</small> </a>
                        <a href="#" class="dropdown-item">Server error report<small
                                class="float-right text-muted time">7 hrs</small> </a>
                        <a href="#" class="dropdown-item">Database report<small class="float-right text-muted time">1
                                days</small> </a>
                        <a href="#" class="dropdown-item">Order confirmation<small class="float-right text-muted time">2
                                days</small> </a>
                    </div>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="true"> <i class=" ti-view-grid"></i> </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-big">
                        <div class="dropdown-header">
                            <strong>Quick Links</strong>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="nav-grid">
                            <a href="#" class="nav-grid-item"><i class="ti-files text-primary"></i>
                                <h5>New Task</h5>
                            </a>
                            <a href="#" class="nav-grid-item"><i class="ti-check-box text-success"></i>
                                <h5>Assign Task</h5>
                            </a>
                        </div>
                        <div class="nav-grid">
                            <a href="#" class="nav-grid-item"><i class="ti-pencil-alt text-warning"></i>
                                <h5>Add Orders</h5>
                            </a>
                            <a href="#" class="nav-grid-item"><i class="ti-truck text-danger "></i>
                                <h5>New Orders</h5>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown mr-30">
                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('assets/images/profile-avatar.jpg')}}" alt="avatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-0"> @if(auth('superVisor')->check()) {{auth('superVisor')->user()->name}} @elseif(auth('admin')->check()) {{auth('admin')->user()->name}}  @elseif(auth('employee')->check()) {{auth('employee')->user()->name}} @else {{auth('web')->user()->name}} @endif</h5>
                                    <span>@if(auth('superVisor')->check()) {{auth('superVisor')->user()->email}} @elseif(auth('admin')->check()) {{auth('admin')->user()->email}}  @elseif(auth('employee')->check()) {{auth('employee')->user()->email}} @else {{auth('web')->user()->email}} @endif</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="text-warning ti-user"></i>Profile</a>
                        <a class="dropdown-item" href="#"><i class="text-dark ti-layers-alt"></i>Projects <span
                                class="badge badge-info">6</span> </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="text-info ti-settings"></i>Settings</a>
                        @if(auth('superVisor')->check())
                            <form method="GET" action="{{ route('logout','superVisor') }}">
                        @elseif(auth('admin')->check())
                            <form method="GET" action="{{ route('logout','admin') }}">
                        @elseif(auth('employee')->check())
                            <form method="GET" action="{{ route('logout','employee') }}">
                        @else
                            <form method="GET" action="{{ route('logout','web') }}">
                        @endif
                        @csrf
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();this.closest('form').submit();"><i class="bx bx-log-out"></i>تسجيل الخروج</a>
                            </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!--=================================
 header End-->
