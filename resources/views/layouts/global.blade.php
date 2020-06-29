<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9 no-js" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lapplier @yield("title")</title>
    <link rel="stylesheet" href="{{ asset('polished/polished.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    @yield( 'css' )

    <link rel="stylesheet" href="{{ asset('custom/css/main.css') }}">
    
    <script type="text/javascript">
        document.documentElement.className = document.documentElement.className.replace('no-js', 'js') + (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure ", "1.1 ") ? ' svg' : ' no-svg');
    </script>

    @yield( 'js_top' )
</head>

<body>
    <div class="loader">
        <img src="{{ asset('custom/spinner.svg') }}" />
    </div>

    <nav class="navbar navbar-expand p-0">
        <a class="navbar-brand text-center col-xs-12 col-md-3 col-lg-2" href="index.html"> Lapplier </a>
        <button class="btn btn-link d-block d-md-none" datatoggle="collapse" data-target="#sidebar-nav" role="button">
            <span class="oi oi-menu"></span>
        </button>
        
        <div class="dropdown d-none d-md-block custom-dropdown">
            @if(\Auth::user())
                <button class="btn btn-link btn-link-primary dropdown-toggle" id="navbar-dropdown" data-toggle="dropdown">
                    {{Auth::user()->name}}
                </button>
            @endif
            <div class="dropdown-menu dropdown-menu-right" id="navbardropdown">
                <a href="#" class="dropdown-item">Profile</a>
                <a href="#" class="dropdown-item">Setting</a>
                <div class="dropdown-divider"></div>
                <li>
                    <form action="{{route("logout")}}" method="POST">
                        @csrf
                        <button class="dropdown-item" style="cursor:pointer">Sign Out</button>
                    </form>
                </li>
            </div>
        </div>
    </nav>
    <div class="container-fluid h-100 p-0">
        <div style="min-height: 100%" class="flex-row d-flex align-itemsstretch m-0">
            <div class="polished-sidebar bg-light col-12 col-md-3 col-lg-2 p-0 collapse d-md-inline" id="sidebar-nav">
                <ul class="polished-sidebar-menu ml-0 pt-4 p-0 d-md-block">
                    <input class="border-dark form-control d-block d-md-none mb-4" type="text" placeholder="Search" aria-label="Search" />
                    <li>
                        <a href="/home"><span class="oi oi-home"></span> Dashboard</a>
                    </li>
                </ul>

                <!-- Master -->
                <h5 class="ml-0 pt-4 p-0 pl-lg-4 d-md-block">Master</h5>
                <ul class="polished-sidebar-menu ml-0 p-0 d-md-block">
                    <li class="@if( request()->segment(2) == 'users' ) current-menu-item @endif">
                        <a href="{{ route( 'users.index' ) }}">
                            <span class="oi oi-people"></span> Master User
                        </a>
                    </li>
                    <li class="@if( request()->segment(2) == 'customers' ) current-menu-item @endif">
                        <a href="{{ route( 'customers.index' ) }}">
                            <span class="oi oi-people"></span> Master Pelanggan
                        </a>
                    </li>
                    <li class="@if( request()->segment(2) == 'merks' ) current-menu-item @endif">
                        <a href="{{ route( 'merks.index' ) }}">
                            <span class="oi oi-people"></span> Master Merk
                        </a>
                    </li>
                    <li class="@if( request()->segment(2) == 'products' ) current-menu-item @endif">
                        <a href="{{ route( 'products.index' ) }}">
                            <span class="oi oi-people"></span> Master Produk
                        </a>
                    </li>
                    <li class="@if( request()->segment(2) == 'suppliers' ) current-menu-item @endif">
                        <a href="{{ route( 'suppliers.index' ) }}">
                            <span class="oi oi-people"></span> Master Pemasok
                        </a>
                    </li>
                </ul>

                <!-- Transactions -->
                <h5 class="ml-0 pt-4 p-0 pl-lg-4 d-md-block">Transaksi</h5>
                <ul class="polished-sidebar-menu ml-0 p-0 d-md-block">
                    <li class="@if( request()->segment(1) == 'transactions' && request()->segment(2) == 'sellings' ) current-menu-item @endif">
                        <a href="{{ route( 'sellings.index' ) }}">
                            <span class="oi oi-people"></span> Transaksi Penjualan
                        </a>
                    </li>
                    <li class="@if( request()->segment(1) == 'transactions' && request()->segment(2) == 'purchases' ) current-menu-item @endif">
                        <a href="{{ route( 'purchases.index' ) }}">
                            <span class="oi oi-people"></span> Transaksi Pembelian
                        </a>
                    </li>
                    <li class="@if( request()->segment(1) == 'spendings' ) current-menu-item @endif">
                        <a href="{{ route( 'spendings.index' ) }}">
                            <span class="oi oi-people"></span> Pengeluaran
                        </a>
                    </li>
                </ul>

                <!-- Report -->
                <h5 class="ml-0 pt-4 p-0 pl-lg-4 d-md-block">Laporan</h5>
                <ul class="polished-sidebar-menu ml-0 p-0 d-md-block">
                    <li class="@if( request()->segment(1) == 'reports' && request()->segment(2) == 'sellings' ) current-menu-item @endif">
                        <a href="{{ route( 'reports.sellings.index' ) }}">
                            <span class="oi oi-people"></span> Laporan Penjualan
                        </a>
                    </li>

                    <li class="@if( request()->segment(1) == 'reports' && request()->segment(2) == 'purchases' ) current-menu-item @endif">
                        <a href="{{ route( 'reports.purchases.index' ) }}">
                            <span class="oi oi-people"></span> Laporan Pembelian
                        </a>
                    </li>

                    <div class="d-block d-md-none">
                        <div class="dropdown-divider"></div>
                        <li><a href="#"> Profile</a></li>
                        <li><a href="#"> Pengaturan</a></li>
                        <li>
                            <form action="{{route("logout")}}" method="POST">
                                @csrf
                                <button class="dropdown-item" style="cursor:pointer">Sign Out</button>
                            </form>
                        </li>
                    </div>
                </ul>

            </div>
            <div class="col-lg-10 col-md-9 p-4">
                <div class="row ">
                    <div class="col-md-12 pl-3 pt-2">
                        <div class="pl-3">
                            <h3>@yield("pageTitle")</h3>
                            <br/> 
                        </div> 
                    </div> 
                </div> 
                
                @yield("content")

            </div> 
        </div> 
    </div> 

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
    <script src="{{ asset('custom/js/main.js') }}"></script>

    @yield('script')
</body>

</html>
