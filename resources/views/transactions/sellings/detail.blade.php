@extends("layouts.global")

@section("title") Detail Transaksi Penjualan @endsection

@section("content")

<div class="row">
    <div class="col-md-12">
        <h2 class="m-b-20">Detail Transaksi Penjualan</h2>
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

            <!-- Data Transaksi -->
            <div class="row m-b-20 transactions-data">
                <div class="col-md-12">
                    <h4>Data Transaksi</h4>
                </div>
                <div class="col-md-4">
                    <label for="no_nota">Nomor Nota</label>
                    <input type="text" readonly name="nota_no" value="{{ $sellings->nota_number }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="date">Tanggal</label>
                    <input type="text" readonly name="date" value="{{ $sellings->date }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="customer">Pelanggan</label>
                    <input type="text" readonly name="customer" value="{{ $sellings->customers->name }}" class="form-control">
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
                                <th width="16%">Sub Total Sebelum Diskon</th>
                                <th width="15%">Potongan Harga</th>
                                <th width="15%">Sub Total Setelah Diskon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_after_discount = 0;
                                $total_before_discount = 0;
                                $total_discount = 0;
                            @endphp
                            
                            @foreach( $sellings->products as $selling_detail )
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
                                    <td>{{ $selling_detail->product_name }}</td>
                                    <td>@currency( $pivot_price_sell )</td>
                                    <td>{{ $pivot_qty }}</td>
                                    <td>@currency( $sub_total_before_discount )</td>
                                    <td>@currency( $pivot_discount )</td>
                                    <td>@currency( $sub_total_after_discount )</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-right"><b class="total_transactions">Total</b></th>
                                <th><b class="total_transactions">@currency( $total_before_discount )</b></th>
                                <th><b class="total_transactions">@currency( $total_discount )</b></th>
                                <th><b class="total_transactions">@currency( $total_after_discount )</b></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection