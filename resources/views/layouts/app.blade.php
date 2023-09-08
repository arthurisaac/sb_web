<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config("app.name", "Smarbox") }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset("vendors/feather/feather.css")}}">
    <link rel="stylesheet" href="{{asset("vendors/mdi/css/materialdesignicons.min.css")}}">
    <link rel="stylesheet" href="{{asset("vendors/ti-icons/css/themify-icons.css")}}">
    <link rel="stylesheet" href="{{asset("vendors/typicons/typicons.css")}}">
    <link rel="stylesheet" href="{{asset("vendors/simple-line-icons/css/simple-line-icons.css")}}">
    <link rel="stylesheet" href="{{asset("vendors/css/vendor.bundle.base.css")}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset("vendors/datatables.net-bs4/dataTables.bootstrap4.css")}}">
    <link rel="stylesheet" href="{{asset("js/select.dataTables.min.css")}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset("css/vertical-layout-light/style.css")}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset("images/favicon.png")}}"/>
</head>
<body>
<div class="container-scroller">
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <div class="me-3">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
            </div>
            <div>
                <a class="navbar-brand brand-logo" href="{{ route("home") }}">
                    <img src="{{ asset("images/logo.svg")}}" alt="logo"/>
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ route("home") }}">
                    <img src="{{ asset("images/logo-mini.svg")}}" alt="logo"/>
                </a>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
            <ul class="navbar-nav">
                <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                    <h1 class="welcome-text">{{ ("Bonjour") }}, <span class="text-black fw-bold">{{ auth()->user()->nom }} {{ auth()->user()->prenom }}</span></h1>
                    <h3 class="welcome-sub-text">{{ $subtitle ?? "" }} </h3>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                {{--<li class="nav-item d-none d-lg-block">
                    <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                          <span class="input-group-addon input-group-prepend border-right">
                            <span class="icon-calendar input-group-text calendar-icon"></span>
                          </span>
                        <input type="text" class="form-control">
                    </div>
                </li>--}}
                <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                    <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="img-xs rounded-circle" src="https://ui-avatars.com/api/?name={{ auth()->user()->nom }}+{{ auth()->user()->prenom }}" alt="Profile image"> </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <img class="img-md rounded-circle" src="https://ui-avatars.com/api/?name={{ auth()->user()->nom }}+{{ auth()->user()->prenom }}" alt="Profile image">
                            <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->nom }} {{ auth()->user()->prenom }}</p>
                            <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
                        </div>
                        <a class="dropdown-item"><i
                                class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>{{ __("Profil") }}
                            <span class="badge badge-pill badge-danger">1</span></a>
                        <a class="dropdown-item"><i
                                class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i>
                            {{ __("Activité") }}</a>
                        <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>{{ __("Déconnexion") }}</a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
            <div id="settings-trigger"><i class="ti-settings"></i></div>
            <div id="theme-settings" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <p class="settings-heading">Menu</p>
                <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                    <div class="img-ss rounded-circle bg-light border me-3"></div>
                    Light
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-dark border me-3"></div>
                    Dark
                </div>
                <p class="settings-heading mt-2">Entête</p>
                <div class="color-tiles mx-0 px-4">
                    <div class="tiles success"></div>
                    <div class="tiles warning"></div>
                    <div class="tiles danger"></div>
                    <div class="tiles info"></div>
                    <div class="tiles dark"></div>
                    <div class="tiles default"></div>
                </div>
            </div>
        </div>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("home") }}">
                        <i class="mdi mdi-grid-large menu-icon"></i>
                        <span class="menu-title">{{__("Tableau de bord")}}</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Coffrets/Boxes</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}">
                        <i class="mdi mdi-grid-large menu-icon"></i>
                        <span class="menu-title">{{__("Commandes")}}</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Général</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.index') }}">
                        <i class="mdi mdi-grid-large menu-icon"></i>
                        <span class="menu-title">{{__("Catégories")}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sub-categories.index') }}">
                        <i class="mdi mdi-grid-large menu-icon"></i>
                        <span class="menu-title">{{__("Sous-catégories")}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                       aria-controls="auth">
                        <i class="mdi mdi-grid-large menu-icon"></i>
                        <span class="menu-title">{{ __("Box") }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="auth">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{ route("boxes.index") }}"> {{ __("Gestion") }} </a></li>
                        </ul>
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{ route("boxes.create") }}"> {{ __("Ajouter") }} </a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#experiences" aria-expanded="false"
                       aria-controls="experiences">
                        <i class="mdi mdi-grid-large menu-icon"></i>
                        <span class="menu-title">{{ __("Expériences") }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="experiences">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{ route("experiences.index") }}"> {{ __("Gestion") }} </a></li>
                        </ul>
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{ route("experiences.create") }}"> {{ __("Ajouter") }} </a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('app-settings.index') }}">
                        <i class="mdi mdi-grid-large menu-icon"></i>
                        <span class="menu-title">{{__("Paramètres app")}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sections.index') }}">
                        <i class="mdi mdi-grid-large menu-icon"></i>
                        <span class="menu-title">{{__("Section")}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('faqs.index') }}">
                        <i class="mdi mdi-grid-large menu-icon"></i>
                        <span class="menu-title">{{__("FAQ")}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="mdi mdi-grid-large menu-icon"></i>
                        <span class="menu-title">{{__("Gestion des utilisateurs")}}</span>
                    </a>
                </li>
                {{--<li class="nav-item nav-category">help</li>
                <li class="nav-item">
                    <a class="nav-link" href="http://bootstrapdash.com/demo/star-admin2-free/docs/documentation.html">
                        <i class="menu-icon mdi mdi-file-document"></i>
                        <span class="menu-title">Documentation</span>
                    </a>
                </li>--}}
            </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
        {{-- <footer class="footer">
             <div class="d-sm-flex justify-content-center justify-content-sm-between">
                 <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                         href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
                 <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
             </div>
         </footer>--}}
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="{{ asset("vendors/js/vendor.bundle.base.js")}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset("vendors/chart.js/Chart.min.js")}}"></script>
<script src="{{ asset("vendors/bootstrap-datepicker/bootstrap-datepicker.min.js")}}"></script>
<script src="{{ asset("vendors/progressbar.js/progressbar.min.js")}}"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset("js/off-canvas.js")}}"></script>
<script src="{{ asset("js/hoverable-collapse.js")}}"></script>
{{--<script src="{{ asset("js/template.js")}}"></script>--}}
<script src="{{ asset("js/settings.js")}}"></script>
<script src="{{ asset("js/todolist.js")}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset("js/jquery.cookie.js")}}" type="text/javascript"></script>
<script src="{{ asset("js/dashboard.js")}}"></script>
<script src="{{ asset("js/Chart.roundedBarCharts.js")}}"></script>
<!-- End custom js for this page-->

@stack('other-scripts')

</body>

</html>
