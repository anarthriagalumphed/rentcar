<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Palawa | @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/palawa-icon-colored.png') }}">
    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet"
        href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    {{-- <link rel="stylesheet"
        href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Dapatkan dari https://fontawesome.com/start -->
    <script src="https://kit.fontawesome.com/2877f6b29f.js" crossorigin="anonymous"></script>






</head>



<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->

        @if (session('just_logged_in'))
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__wobble" src="{{ asset('img/palawa-icon-colored.png') }}" alt="Logo"
                    height="150" width="150">
            </div>
            @php
                // Hapus variabel sesi setelah menampilkan preloader
                session()->forget('just_logged_in');
            @endphp
        @endif

        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="dashboard" class="nav-link">Home</a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="mailto:galih22.mp@gmail.com" class="nav-link">Contact</a>
                </li> --}}
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <div class="sidebar-overlay">
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                            <i class="nav-icon fas fa-sign-out-alt"> Logout</i>
                        </a>




                        {{-- <div class="navbar-search-block">
                            <form class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-navbar" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                    </li>
                </div>
            </ul>
        </nav><!-- Navbar -->



        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 mt-3 pb-3 mb-3 d-flex">
            <!-- Logo -->
            <a href="javascript:location.reload(true)" class="brand-link">
                <img href="dashboard" src="{{ asset('img/palawa-icon-colored.png') }}" alt=" Logo"
                    class="brand-image " style="opacity: .8">
                <span class="brand-text font-weight-light">Palawa</span>
            </a>



            {{-- <!-- Sidebar --> --}}
            <div class="sidebar">
                @if (auth()->check() &&
                        auth()->user()->hasRole('1'))
                    <!-- Sidebar user panel (optional) -->
                    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <a href="profile">
                                <img src="{{ asset('/img/pp fix.png') }}" class="img-circle elevation-2"
                                    alt="User Image">
                            </a>
                        </div>
                        <div class="info">
                            @if (auth()->check())
                                <a href="profile" class="d-block">{{ Auth()->user()->username }}</a>
                            @endif
                        </div>
                    </div> --}}
                    <!-- SidebarSearch Form -->
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                            {{-- @if (Auth::user()->role_id == 1) --}}
                            <li class="nav-item">
                                <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }} ">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Dashboard
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                            {{-- <li class="nav-header">EXAMPLES</li> --}}
                            <li class="nav-item">
                                <a href="/books"
                                    class="nav-link {{ request()->is('books') ? 'active' : '' }} || {{ request()->is('add_books') ? 'active' : '' }} || {{ request()->is('edit_books') ? 'active' : '' }} || {{ request()->is('delete_books') ? 'active' : '' }} || {{ request()->is('deleted_books') ? 'active' : '' }}">
                                    <i class="nav-icon fa-solid fa-car"></i>
                                    <p>
                                        Car Data
                                    </p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="/categories"
                                    class="nav-link {{ request()->is('categories') ? 'active' : '' }} || {{ request()->is('add_category') ? 'active' : '' }} || {{ request()->is('edit_category') ? 'active' : '' }} || {{ request()->is('delete_category') ? 'active' : '' }} || {{ request()->is('deleted_category') ? 'active' : '' }}">
                                    <i class="nav-icon  	fas fa-book "></i>
                                    <p>
                                        Categories
                                    </p>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="/users" class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users "></i>
                                    <p>
                                        User
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/book_rent" class="nav-link {{ request()->is('book_rent') ? 'active' : '' }}">
                                    {{-- <i class='nav-icon fas fa-money-bill-wave-alt '></i> --}}
                                    <i class=' nav-icon fas fa-arrow-alt-circle-right '></i>
                                    <p>
                                        Car Rental
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/book_return"
                                    class="nav-link {{ request()->is('book_return') ? 'active' : '' }}">
                                    <i class=' nav-icon fas fa-arrow-alt-circle-left '></i>
                                    <p>
                                        Car Return
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/rent_logs" class="nav-link {{ request()->is('rent_logs') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-business-time "></i>
                                    <p>
                                        Rent Logs
                                    </p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link" id="logoutButton">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>
                                        Logout
                                    </p>
                                </a>
                            </li> --}}
                        @elseif (auth()->check() &&
                                auth()->user()->hasRole('2'))
                            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                <div class="image">
                                    <a href="profile">
                                        <img src="{{ asset('/img/pp fix.png') }}" class="img-circle elevation-2"
                                            alt="User Image">
                                    </a>
                                </div>
                                <div class="info">
                                    @if (auth()->check())
                                        <a href="profile" class="d-block">{{ Auth()->user()->username }}</a>
                                    @endif
                                </div>
                            </div>
                            <nav class="mt-2">
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                    data-accordion="false">
                                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                                    {{-- @if (Auth::user()->role_id == 1) --}}
                                    <li class="nav-item">
                                        <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }} ">
                                            <i class="nav-icon fas fa-swatchbook "></i>
                                            <p>
                                                Book List
                                                {{-- <span class="right badge badge-danger">New</span> --}}
                                            </p>
                                        </a>
                                    </li>
                                    {{-- <li class="nav-header">EXAMPLES</li> --}}
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" id="logoutButton">
                                            <i class="nav-icon fas fa-sign-out-alt"></i>
                                            <p>
                                                Logout
                                            </p>
                                        </a>
                                    </li>
                                @else
                                    <nav class="mt-2">
                                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview"
                                            role="menu" data-accordion="false">
                                            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                                            {{-- @if (Auth::user()->role_id == 1) --}}
                                            <li class="nav-item">
                                                <a href="/register"
                                                    class="nav-link {{ request()->is('dashboard') ? 'active' : '' }} ">
                                                    <i class="nav-icon fas fa-sign-in-alt"></i>
                                                    <p>
                                                        Register
                                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                                    </p>
                                                </a>
                                            </li>
                @endif
                </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    @yield('content')
                                </div>
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- /.col -->

                        <!-- fix for small devices only -->



                        <!-- /.col -->

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->


                    <!-- /.row -->

                    <!-- Main row -->

                    <!-- /.row -->
                </div>

                {{-- terakhir --}}
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer" style="font-size: 0.8rem;">
            <strong>Copyright &copy; 2023 <a href="mailto:galihmahendrastudio.mp@gmail.com">Palawa.com</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                {{-- <b>Version</b> 3.2.0 --}}
            </div>
        </footer>
    </div>
    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Are you sure you want to logout?</h5>

                </div>

                <div class="modal-footer">
                    <a href="#" id="confirmLogout" class="btn btn-primary">Logout</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src=" {{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/dist/js/adminlte.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('template/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('template/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>

    {{-- <script src="{{ asset('template/dist/js/pages/dashboard2.js') }}"></script> --}}

    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js') }}">
    </script>



    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Menampilkan modal saat tombol Logout ditekan
            $('#logoutButton').on('click', function() {
                $('#logoutModal').modal('show');
            });

            // Redirect setelah Logout di-konfirmasi
            $('#confirmLogout').on('click', function() {
                window.location.href = '/logout'; // Ganti dengan URL logout sesuai dengan kebutuhan Anda
            });
        });
    </script>


</body>

</html>
