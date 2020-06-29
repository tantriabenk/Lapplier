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
    <link rel="stylesheet" href="{{ asset('custom/css/main.css') }}">
</head>

<body style="background-color: #fff;">

    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <h3 class="m-b-20">Laporan Rekapitulasi Pembelian</h3>
                <h6>Periode {{ $start }} - {{ $end }} </h6>
            </div>
            @foreach( $purchases as $purchase )
                <div class="row m-b-20">
                    <div class="col-md-12">
                        <table>
                            <tr>
                                <td><b>Nomor Nota: {{ $purchase->no_faktur }}</b></td>
                                <td style="padding: 0px 20px;"></td>
                                <td><b>Tanggal: {{ date( "d F Y", strtotime( $purchase->date ) ) }}</b></td>
                                <td style="padding: 0px 20px;"></td>
                                <td><b>Customer: {{ $purchase->suppliers->name }}</b></td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <tr>
                                <td>No</td>
                                <td>Produk</td>
                                <td>Harga Beli</td>
                                <td>Jumlah</td>
                                <td>Sub Total</td>
                            </tr>

                            @php
                                $no = 1;
                                $total = 0;
                            @endphp

                            @foreach( $purchase->products as $purchase_detail )
                                @php
                                    $pivot_price_buy = $purchase_detail->pivot->price;
                                    $pivot_qty = $purchase_detail->pivot->qty;

                                    $sub_total = $pivot_price_buy * $pivot_qty;
                                    $total += $sub_total;
                                @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $purchase_detail->product_name }}</td>
                                    <td>@currency( $pivot_price_buy )</td>
                                    <td>{{ $pivot_qty }}</td>
                                    <td>@currency( $sub_total )</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="4" class="text-right"><b>Total</b></td>
                                <td>@currency( $total )</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endforeach 
        </div>
    </div>
</body>

</html>