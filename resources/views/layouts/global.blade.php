<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ezramotor.com</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    @yield( 'css' )

    @if( request()->segment(1) != 'home' )
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    @endif

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/custom/main.css') }}">

    @yield( 'js_top' )
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="loader">
        <img src="{{ asset('custom/spinner.svg') }}" />
    </div>

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <form action="{{route("logout")}}" method="POST">
                            @csrf
                            <button class="dropdown-item" style="cursor:pointer">Keluar</button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route( 'home' ) }}" class="brand-link">
                <span class="brand-text font-weight-light">Ezramotor.com</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="{{ route( 'home' ) }}" class="nav-link @if( request()->segment(1) == 'home' ) active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Beranda</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview @if( request()->segment(1) == 'master' ) menu-open @endif">
                            <a href="#" class="nav-link @if( request()->segment(1) == 'master' ) active @endif">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>Master <i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route( 'users.index' ) }}" class="nav-link @if( request()->segment(2) == 'users' ) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Petugas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route( 'customers.index' ) }}" class="nav-link @if( request()->segment(2) == 'customers' ) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Pelanggan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route( 'merks.index' ) }}" class="nav-link @if( request()->segment(2) == 'merks' ) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Merek</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route( 'products.index' ) }}" class="nav-link @if( request()->segment(2) == 'products' ) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Produk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route( 'suppliers.index' ) }}" class="nav-link @if( request()->segment(2) == 'suppliers' ) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Pemasok</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview @if( request()->segment(1) == 'transactions' ) menu-open @endif">
                            <a href="#" class="nav-link @if( request()->segment(1) == 'transactions' ) active @endif">
                            <i class="nav-icon fas fa-file-invoice"></i>
                                <p>Transaksi <i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route( 'sellings.index' ) }}" class="nav-link @if( request()->segment(1) == 'transactions' && request()->segment(2) == 'sellings' ) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Penjualan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route( 'purchases.index' ) }}" class="nav-link @if( request()->segment(1) == 'transactions' && request()->segment(2) == 'purchases' ) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pembelian</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route( 'spendings.index' ) }}" class="nav-link @if( request()->segment(1) == 'spendings' ) active @endif">
                                <i class="nav-icon fas fa-file-invoice"></i>
                                <p>Pengeluaran</p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview @if( request()->segment(1) == 'reports' ) menu-open @endif">
                            <a href="#" class="nav-link @if( request()->segment(1) == 'reports' ) active @endif">
                            <i class="nav-icon fas fa-file-invoice"></i>
                                <p>Laporan <i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route( 'reports.sellings.index' ) }}" class="nav-link @if( request()->segment(1) == 'reports' && request()->segment(2) == 'sellings' ) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Penjualan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route( 'reports.purchases.index' ) }}" class="nav-link @if( request()->segment(1) == 'reports' && request()->segment(2) == 'purchases' ) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pembelian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route( 'reports.income.index' ) }}" class="nav-link @if( request()->segment(1) == 'reports' && request()->segment(2) == 'income_statement' ) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laba Rugi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
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
                            <h1 class="m-0 text-dark">@yield("pageTitle")</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    @yield("content")

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->

        </div>

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 202020 <a href="{{ route( 'home' ) }}">Ezramotor.com</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
    <script src="{{ asset('custom/js/main.js') }}"></script>

    @yield('script')

    @if( request()->segment(1) != 'home' )
        <!-- DataTables -->
        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script>
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        </script>
    @endif

</body>

</html>
