<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <!-- End plugin css for this page -->


    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/css/vertical-layout-light/style.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">

    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('admin/images/logo.svg') }}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />


</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="javascript:void(0)">
                        <h4><b>Uniweb School</b></h4>
                        <!-- <img src="{{ asset('admin/images/logo.svg') }}" alt="logo" /> -->
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="javascript:void(0)">
                        <!-- <h4><b>U</b></h4> -->
                        <!-- <img src="{{ asset('admin/images/logo.svg') }}" alt="logo" /> -->
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Welcome, <span class="text-black fw-bold">{{ auth()->user()->first_name.' '.auth()->user()->last_name }}</span></h1>
                        <h3 class="welcome-sub-text">My account </h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{ asset('admin/images/faces/user.png') }}" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="{{ asset('admin/images/faces/user.png') }}" height="40" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->first_name.' '.auth()->user()->last_name }}</p>
                                <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
                            </div>
                            <!-- <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
                            <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
                            <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
                            <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a> -->

                            <a class="dropdown-item" href="{{ route('change-password.index') }}"><i class="dropdown-item-icon mdi mdi-account-key text-primary me-2"></i> Change Password</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->




        <div class="container-fluid page-body-wrapper">

            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item {{ isset($page) && in_array($page, ['dashboard']) ? 'active-sidebar' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>




                    @if (auth()->user()->role == config('constant.SCHOOLADMIN'))
                    <li class="nav-item nav-category">Student</li>

                    <li class="nav-item {{ isset($page) && in_array($page, ['user']) ? 'active-sidebar' : '' }}">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <i class="menu-icon mdi mdi-account-multiple"></i>
                            <span class="menu-title">Student</span>
                        </a>
                    </li>
                    @endif

                    <li class="nav-item nav-category">School</li>
                    @if (auth()->user()->role == config('constant.SUPERADMIN'))
                    <li class="nav-item {{ isset($page) && in_array($page, ['school']) ? 'active-sidebar' : '' }}">
                        <a class="nav-link" href="{{ route('school.index') }}">
                            <i class="menu-icon mdi mdi-school"></i>
                            <span class="menu-title">School</span>
                        </a>
                    </li>

                    <!-- <li class="nav-item {{ isset($page) && in_array($page, ['school']) ? 'active' : '' }}">
                        <a class="nav-link" data-bs-toggle="collapse" href="#school" aria-expanded="{{ isset($page) && in_array($page, ['school']) ? 'true' : 'false' }}" aria-controls="school">
                            <i class="menu-icon mdi mdi-school"></i>
                            <span class="menu-title">School</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="school">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('school.create') }}">Create</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('school.index') }}">List</a></li>
                            </ul>
                        </div>
                    </li> -->
                    @endif


                    @if (auth()->user()->role == 2)
                    <li class="nav-item {{ isset($page) && in_array($page, ['group']) ? 'active-sidebar' : '' }}">
                        <a class="nav-link" href="{{ route('group.index', ['school' => auth()->user()->id]) }}">
                            <i class="menu-icon mdi mdi-account-switch"></i>
                            <span class="menu-title">Group</span>
                        </a>
                    </li>
                    @endif

                    <!-- <li class="nav-item {{ isset($page) && in_array($page, ['group']) ? 'active' : '' }}">
                        <a class="nav-link" data-bs-toggle="collapse" href="#group" aria-expanded="{{ isset($page) && in_array($page, ['group']) ? 'true' : 'false' }}" aria-controls="group">
                            <i class="menu-icon mdi mdi-group"></i>
                            <span class="menu-title">Group</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="group">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('group.create') }}">Create</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('group.index') }}">List</a></li>
                            </ul>
                        </div>
                    </li> -->
                </ul>
            </nav>
            <!-- partial -->


            <div class="main-panel">

                @yield('content')


                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"> <i class="mdi mdi-heart text-danger"></i> {{ env('APP_NAME') }}</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2022. All rights reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->


        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->




    <!-- plugins:js -->
    <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/progressbar.js/progressbar.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/js/template.js') }}"></script>
    <script src="{{ asset('admin/js/settings.js') }}"></script>
    <script src="{{ asset('admin/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/js/dashboard.js') }}"></script>
    <script src="{{ asset('admin/js/Chart.roundedBarCharts.js') }}"></script>
    <!-- End custom js for this page-->

    <script>
        // $(document).ready(function() {
        //     $('#datatable').DataTable();
        // });

        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            $(document).ready(function() {
                @if(Session::has('error'))
                toastr.error("{{ (Session::get('error')) }}");
                @elseif(Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
                @endif
            });
        });
    </script>

    <script type="text/javascript">
        const SITE_URL = "{{ url('/') }}";
    </script>

    @yield('js')

</body>

</html>
