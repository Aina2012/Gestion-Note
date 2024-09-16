<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ITUniversity</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/popup.css') }}">
    <style>
        .solde {
            font-size: 15px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                {{-- <li class="nav-item">--}}
                {{-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">--}}
                {{-- <i class="fas fa-search"></i>--}}
                {{-- </a>--}}
                {{-- <div class="navbar-search-block">--}}
                {{-- <form class="form-inline">--}}
                {{-- <div class="input-group input-group-sm">--}}
                {{-- <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
                {{-- <div class="input-group-append">--}}
                {{-- <button class="btn btn-navbar" type="submit">--}}
                {{-- <i class="fas fa-search"></i>--}}
                {{-- </button>--}}
                {{-- <button class="btn btn-navbar" type="button" data-widget="navbar-search">--}}
                {{-- <i class="fas fa-times"></i>--}}
                {{-- </button>--}}
                {{-- </div>--}}
                {{-- </div>--}}
                {{-- </form>--}}
                {{-- </div>--}}
                {{-- </li>--}}

                <!-- Messages Dropdown Menu -->
                <!-- Notifications Dropdown Menu -->

                <li class="nav-item">
                    <a class="nav-link solde">
                        {{-- money--}}
                        {{-- <span class="badge badge-warning "> </span>--}}
                    </a>
                </li>
                {{-- deconnexion --}}
                <li class="nav-item">
                    <a class="nav-link" href="#" style="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </a>
                    <form id="logout-form" action="#" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <img src="{{ asset('dist/img/log1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block"></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                        
                         <li class="nav-item">
                            <a href="{{ route('admin.bord') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    home
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('import') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    import
                                </p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Note
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reinsialise') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Reinitialiser base
                                </p>
                            </a>
                        </li>
                        
                       
                        </li>
                    </ul>

                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2021 <a href="https://adminlte.io"> Rah Aina
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
</body>

</html>
