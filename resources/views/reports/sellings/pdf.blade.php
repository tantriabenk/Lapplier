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
                <h3 class="m-b-20">Laporan Rekapitulasi Penjualan</h3>
                <h6>Periode {{ $start }} - {{ $end }} </h6>
            </div>
            @foreach( $sellings as $selling )
                <div class="row m-b-20">
                    <div class="col-md-12">
                        <table>
                            <tr>
                                <td><b>Nomor Nota: {{ $selling->nota_number }}</b></td>
                                <td style="padding: 0px 20px;"></td>
                                <td><b>Tanggal: {{ date( "d F Y", strtotime( $selling->date ) ) }}</b></td>
                                <td style="padding: 0px 20px;"></td>
                                <td><b>Customer: {{ $selling->customers->name }} / {{ $selling->customers->store_name }}</b></td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <tr>
                                <td>No</td>
                                <td>Produk</td>
                                <td>Harga Produk</td>
                                <td>Jumlah</td>
                                <td>Sub Total Sebelum Diskon</td>
                                <td>Diskon</td>
                                <td>Sub Total Setelah Diskon</td>
                            </tr>

                            @php
                                $no = 1;
                                $total_after_discount = 0;
                                $total_before_discount = 0;
                                $total_discount = 0;
                            @endphp

                            @foreach( $selling->products as $selling_detail )
                                @php
                                    $pivot_price_sell = $selling_detail->pivot->price_sell;
                                    $pivot_qty = $selling_detail->pivot->qty;
                                    $pivot_discount = $selling_detail->pivot->discount;
                                    $sub_total_before_discount = $pivot_price_sell * $pivot_qty;
                                    $sub_total_after_discount = $sub_total_before_discount - $pivot_discount;

                                    $total_after_discount += $sub_total_after_discount;
                                    $total_before_discount += $sub_total_before_discount;
                                    $total_discount += $pivot_discount;
                                @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $selling_detail->product_name }}</td>
                                    <td>@currency( $pivot_price_sell )</td>
                                    <td>{{ $pivot_qty }}</td>
                                    <td>@currency( $sub_total_before_discount )</td>
                                    <td>@currency( $pivot_discount )</td>
                                    <td>@currency( $sub_total_before_discount )</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="4" class="text-right"><b>Total</b></td>
                                <td>@currency( $total_before_discount )</td>
                                <td>@currency( $total_discount )</td>
                                <td>@currency( $total_after_discount )</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endforeach 
        </div>
    </div>
</body>

</html>