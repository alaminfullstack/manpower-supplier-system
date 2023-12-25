<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
        <div class="content-header bg-white-5">
            <!-- Logo -->
            <a class="fw-semibold text-white tracking-wide" href="{{ route('home') }}">
                <span class="smini-visible">
                    {{ get_system_title() }}
                </span>
                <span class="smini-hidden">
                    <span class="opacity-100">{{ Str::words(get_system_title(), 3) }}</span>
                </span>
            </a>
            <!-- END Logo -->

            <!-- Options -->
            <div>
                <!-- Toggle Sidebar Style -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <!-- Class Toggle, functionality initialized in Helpers.dmToggleClass() -->
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                    data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on"
                    onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');">
                    <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                </button>
                <!-- END Toggle Sidebar Style -->

                <!-- Dark Mode -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                    data-target="#dark-mode-toggler" data-class="far fa"
                    onclick="Dashmix.layout('dark_mode_toggle');">
                    <i class="far fa-moon" id="dark-mode-toggler"></i>
                </button>
                <!-- END Dark Mode -->

                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout"
                    data-action="sidebar_close">
                    <i class="fa fa-times-circle"></i>
                </button>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Options -->
        </div>
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll" id="js-sidebar">
        <!-- Side Navigation -->
        @php
            $url_array = explode('/',Request::path());
        @endphp
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('home') }}">
                        <i class="nav-main-link-icon fa fa-border-all"></i>
                        <span class="nav-main-link-name">{{ trans('Dashboard') }}</span>
                    </a>
                </li>

                
                <li class="nav-main-item {{ in_array('invoice',$url_array) ? 'open' : '' }} {{ in_array('invoice-draft',$url_array) ? 'open' : '' }} {{ in_array('invoice-generate',$url_array) ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-border-all"></i>
                        <span class="nav-main-link-name">{{ trans('Invoice') }}</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::currentRouteName() == 'invoice.index' ? 'active' : '' }}" href="{{ route('invoice.index') }}">
                                <i class="nav-main-link-icon fa fa-border-all"></i>
                                <span class="nav-main-link-name">{{ trans('List Invoice') }}</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::currentRouteName() == 'invoice.create' ? 'active' : '' }}" href="{{ route('invoice.create') }}">
                                <i class="nav-main-link-icon fa fa-border-all"></i>
                                <span class="nav-main-link-name">{{ trans('Generate Invoice') }}</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::currentRouteName() == 'invoice.draft' ? 'active' : '' }}" href="{{ route('invoice.draft') }}">
                                <i class="nav-main-link-icon fa fa-border-all"></i>
                                <span class="nav-main-link-name">{{ trans('Draft Invoice') }}</span>
                            </a>
                        </li>

                    </ul>
                </li>

                

                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::currentRouteName() == 'man-power-supply.index' ? 'active' : '' }}" href="{{ route('man-power-supply.index') }}">
                        <i class="nav-main-link-icon fa fa-border-all"></i>
                        <span class="nav-main-link-name">{{ trans('Man Power Supply') }}</span>
                    </a>
                </li>


                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::currentRouteName() == 'person.index' ? 'active' : '' }}" href="{{ route('person.index') }}">
                        <i class="nav-main-link-icon fa fa-border-all"></i>
                        <span class="nav-main-link-name">{{ trans('Person') }}</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::currentRouteName() == 'designation.index' ? 'active' : '' }}" href="{{ route('designation.index') }}">
                        <i class="nav-main-link-icon fa fa-border-all"></i>
                        <span class="nav-main-link-name">{{ trans('Designation') }}</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::currentRouteName() == 'systemsetting.index' ? 'active' : '' }}" href="{{ route('systemsetting.index') }}">
                        <i class="nav-main-link-icon fa fa-border-all"></i>
                        <span class="nav-main-link-name">{{ trans('System Setting') }}</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::currentRouteName() == 'currency.index' ? 'active' : '' }}" href="{{ route('currency.index') }}">
                        <i class="nav-main-link-icon fa fa-border-all"></i>
                        <span class="nav-main-link-name">{{ trans('Currency') }}</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
