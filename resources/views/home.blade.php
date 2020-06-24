@extends('layouts.global')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
@endsection

@section('js_top')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">Chart Stok Produk</div>

                <div class="card-body">
                    <canvas id="chart-stock" width="100%"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>

        @php $chart_product = ProductHelp::get_chart_product_stock(); @endphp

        var ctx = document.getElementById( 'chart-stock' );
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: {!! json_encode( $chart_product['label_chart'] ) !!},
                datasets: [{
                    label: 'Stok produk saat ini',
                    data: {!! json_encode( $chart_product['product_stock'] ) !!},
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
