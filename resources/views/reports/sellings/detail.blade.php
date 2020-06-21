@extends("layouts.global")

@section("title") Detail Transaksi Penjualan @endsection

@section("content")

<div class="row m-b-40">
    <div class="col-md-9">
        <h3 class="m-b-20">Laporan Penjualan</h3>
        <h6>Periode {{ $start }} - {{ $end }} </h6>
    </div>
    <div class="col-md-3 text-right">
        <button class="btn btn-success">Export Laporan</button>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @foreach( $sellings as $selling )
            <div class="row m-b-10">
                <div class="col-md-3"><b>Nomor Nota: {{ $selling->nota_number }}</b></div>
                <div class="col-md-3"><b>Tanggal: {{ date( "d F Y", strtotime( $selling->date ) ) }}</b></div>
                <div class="col-md-3"><b>Customer: {{ $selling->customers->name }} / {{ $selling->customers->store_name }}</b></div>
            </div>
            <div class="row m-b-20">
                <div class="col-md-12">
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
                                <td>Rp {{ number_format( $pivot_price_sell, 0 ) }}</td>
                                <td>{{ $pivot_qty }}</td>
                                <td>Rp {{ number_format( $sub_total_before_discount ) }}</td>
                                <td>Rp {{ number_format( $pivot_discount ) }}</td>
                                <td>Rp {{ number_format( $sub_total_before_discount ) }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="4" class="text-right"><b>Total</b></td>
                            <td>Rp {{ number_format( $total_before_discount ) }}</td>
                            <td>Rp {{ number_format( $total_discount ) }}</td>
                            <td>Rp {{ number_format( $total_after_discount ) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach 
    </div>
</div>

@endsection