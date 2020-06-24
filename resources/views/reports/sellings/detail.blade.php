@extends("layouts.global")

@section("title") Detail Transaksi Penjualan @endsection

@section("content")

    @if( !empty( $selling_count ) )
        <div class="row m-b-40">
            <div class="col-md-9">
                <h3 class="m-b-20">Laporan Rekapitulasi Penjualan</h3>
                <h6>Periode {{ $start }} - {{ $end }} </h6>
            </div>
            <div class="col-md-3 text-right">
                {!! Form::open( ['url' => route( 'reports.sellings.export_to_pdf' ), 'method' => 'post', 'target' => '_blank', 'class'  => 'form-basic', 'files' => 'true', 'name' => 'reports'] ) !!}
                    {!! Form::hidden( 'customer_id', $customer_id ) !!}
                    {!! Form::hidden( 'peiode', $periode ) !!}
                    {!! Form::submit('Export Ke PDF', [ 'class' => 'btn btn-success' ]) !!}
                {!! Form::close() !!}
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
                                    <td>@currency( $total_after_discount )}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach 
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Laporan tidak di temukan.</h2>
            </div>
        </div>
    @endif

@endsection