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
                <h3 class="m-b-20">Laporan Laba Rugi</h3>
                <h6>Periode {{ $start }} - {{ $end }} </h6>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <table width="100%">
                        <tr>
                            <td width="60%"><h5>Total Penjualan</h5></td>
                            <td><h5>@currency( $total_selling )</h5></td>
                        </tr>
                        <tr>
                            <td><h5>Total Pembelian</h5></td>
                            <td><h5>@currency( $total_purchase )</h5></td>
                        </tr>
                        <tr>
                            <td><h5>{{ $text_laba_rugi_kotor }}</h5></td>
                            <td><h5>@currency( $laba_rugi_kotor )</h5></td>
                        </tr>
                        <tr>
                            <td coslpan="2"><h5>Biaya - Biaya Pengeluaran</h5></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row m-b-20">
                <div class="col-md-5">
                    <table width="100%" border="1" cellpadding="5">
                        <tr style="font-weight: bold;">
                            <td width="20%">Tanggal</td>
                            <td>Deskripsi</td>
                            <td width="30%">Biaya</td>
                        </tr>
                        @php
                            $total_pengeluaran = 0;
                        @endphp
                        @foreach( $spendings as $spending )
                            @foreach( $spending->spending_details as $spending_detail )
                                <tr>
                                    <td>{{ $spending->date }}</td>
                                    <td>{{ $spending_detail->description }}</td>
                                    <td>@currency( $spending_detail->amount )</td>
                                </tr>
                                @php
                                    $total_pengeluaran += $spending_detail->amount;
                                @endphp
                            @endforeach
                        @endforeach
                        <tr style="font-weight: bold;">
                            <td colspan="2" class="text-right">Total Pengeluaran: </td>
                            <td>@currency( $total_pengeluaran )</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Laba Bersih -->
            @php
                $laba_bersih = $laba_rugi_kotor - $total_pengeluaran;
                $text_laba_bersih = ($laba_bersih < 0) ? 'Rugi Bersih' : 'Laba Bersih';
            @endphp
            <div class="row">
                <div class="col-md-6">
                    <table width="100%">
                        <tr>
                            <td width="60%"><h5>{{ $text_laba_bersih }}</h5></td>
                            <td><h5>@currency( $laba_bersih )</h5></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>