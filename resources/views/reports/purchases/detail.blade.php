@extends("layouts.global")

@section("title") Laporan Rekapitulasi Pembelian @endsection

@section("content")

    @if( !empty( $purchase_count ) )
        <div class="row m-b-40">
            <div class="col-md-9">
                <h3 class="m-b-20">Laporan Rekapitulasi Pembelian</h3>
                <h6>Periode {{ $start }} - {{ $end }} </h6>
            </div>
            <div class="col-md-3 text-right">
                {!! Form::open( ['url' => route( 'reports.purchases.export_to_pdf' ), 'method' => 'post', 'target' => '_blank', 'class'  => 'form-basic', 'files' => 'true', 'name' => 'reports'] ) !!}
                    {!! Form::hidden( 'supplier_id', $supplier_id ) !!}
                    {!! Form::hidden( 'peiode', $periode ) !!}
                    {!! Form::submit('Export Ke PDF', [ 'class' => 'btn btn-success' ]) !!}
                {!! Form::close() !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @foreach( $purchases as $purchase )
                    <div class="row m-b-10">
                        <div class="col-md-3"><b>Nomor Faktur: {{ $purchase->no_faktur }}</b></div>
                        <div class="col-md-3"><b>Tanggal: {{ date( "d F Y", strtotime( $purchase->date ) ) }}</b></div>
                        <div class="col-md-3"><b>Pelanggan: {{ $purchase->suppliers->name }}</b></div>
                    </div>
                    <div class="row m-b-20">
                        <div class="col-md-12">
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
    @else
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Laporan tidak di temukan.</h2>
            </div>
        </div>
    @endif

@endsection