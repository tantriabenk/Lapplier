@extends("layouts.global")

@section("title") Detail Transaksi Pembelian @endsection

@section("content")

<div class="row">
    <div class="col-md-12">
        <h2 class="m-b-20">Detail Transaksi Pembelian</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="bg-white shadow-sm p-3">

            <div class="alert" id="response">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="alert-heading"></h5>
                <div class="box"></div>
            </div>

            <form method="POST" name="transactions">
                @csrf

                <!-- Data Transaksi -->
                <div class="row m-b-20 transactions-data">
                    <div class="col-md-12">
                        <h4>Data Transaksi</h4>
                    </div>
                    <div class="col-md-4">
                        <label for="no_nota">Nomor Nota</label>
                        <input type="text" readonly name="nota_no" value="{{ $purchases->no_faktur }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="date">Tanggal</label>
                        <input type="text" readonly name="date" value="{{ $purchases->date }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="customer">Pelanggan</label>
                        <input type="text" readonly name="customer" value="{{ $purchases->suppliers->name }}" class="form-control">
                    </div>
                </div>


                <!-- Detail Order -->
                <div class="row m-b-20">
                    <div class="col-md-12">
                        <h4>Detail Order</h4>
                    </div>
                    
                    <div class="col-md-12">
                        <table class="table table-bordered table-transactions">
                            <thead>
                                <tr>
                                    <th width="25%">Produk</th>
                                    <th width="15%">Harga Produk</th>
                                    <th width="80px">Jumlah</th>
                                    <th width="15%">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                
                                @foreach( $purchases->products as $purchase_detail )
                                    @php
                                        $pivot_price_buy = $purchase_detail->pivot->price;
                                        $pivot_qty = $purchase_detail->pivot->qty;
                                        $sub_total = $pivot_price_buy * $pivot_qty;

                                        $total += $sub_total;
                                    @endphp
                                    <tr>
                                        <td>{{ $purchase_detail->product_name }}</td>
                                        <td>Rp {{ number_format( $pivot_price_buy, 0 ) }}</td>
                                        <td>{{ $pivot_qty }}</td>
                                        <td>Rp {{ number_format( $sub_total,0 ) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" style="text-align: right;"><b class="total_transactions">Total</b></th>
                                    <th><b class="total_transactions">Rp {{ number_format( $total,0 ) }}</b></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection