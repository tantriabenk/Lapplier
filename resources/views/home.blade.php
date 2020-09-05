@extends('layouts.global')

@section('pageTitle') Dashboard @endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ DashboardHelp::get_count_data( 'products' ) }}</h3>
                <p>Jumlah Produk</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route( 'products.index' ) }}" class="small-box-footer">Lihat Produk <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ DashboardHelp::get_count_data( 'users' ) }}</h3>
                <p>Jumlah Petugas</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route( 'users.index' ) }}" class="small-box-footer">Lihat Petugas <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ DashboardHelp::get_count_data( 'customers' ) }}</h3>
                <p>Jumlah Pelanggan</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route( 'customers.index' ) }}" class="small-box-footer">Lihat Pelanggan <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ DashboardHelp::get_count_data( 'suppliers' ) }}</h3>
                <p>Jumlah Supplier</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route( 'suppliers.index' ) }}" class="small-box-footer">Lihat Supplier <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">

    <section class="col-lg-6 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Chart Stok Produk
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content p-0">
                    <canvas id="chart-stock" width="100%"></canvas>
                </div>
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>

    <section class="col-lg-6 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Produk Paling Laris
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content p-0">
                    <canvas id="product-best-seller" width="100%"></canvas>
                </div>
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>

</div>
<!-- /.row (main row) -->
@endsection


@section('script')
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>

    <script>

        @php $chart_product = ProductHelp::get_chart_product_stock(); @endphp

        var ctx = document.getElementById( 'chart-stock' );
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: {!! json_encode( $chart_product['label'] ) !!},
                datasets: [{
                    label: 'Stok produk saat ini',
                    data: {!! json_encode( $chart_product['value'] ) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        @php $best_seller = ProductHelp::get_best_seller(); @endphp

        var ctx = document.getElementById( 'product-best-seller' );
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: {!! json_encode( $best_seller['label'] ) !!},
                datasets: [{
                    label: 'Produk Paling Laris',
                    data: {!! json_encode( $best_seller['value'] ) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection