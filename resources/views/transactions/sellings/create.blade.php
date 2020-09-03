@extends("layouts.global")
@section('pageTitle') Transaksi Penjualan - Tambah Penjualan @endsection
@section("title") Transaksi Penjualan @endsection
@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            @if( session( 'status' ) )
                <div class="alert alert-success">
                    {{ session( 'status' ) }}
                </div>
            @endif

            <div class="card-header text-right">
                <h3 class="card-title">Tambah Transaksi</h3>
                <a href="{{ route( 'sellings.index' ) }}" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>

            <form method="POST" name="transactions">
                <div class="card-body">
                    @csrf

                    <div class="alert" id="response">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="alert-heading"></h5>
                        <div class="box"></div>
                    </div>

                    <!-- Data Transaksi -->
                    <div class="row mb-2 transactions-data">
                        <div class="col-md-12">
                            <h4>Data Transaksi</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="no_nota">Nomor Nota</label>
                                <input type="text" name="nota_no" value="" placeholder="Masukkan nomor nota" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date">Tanggal</label>
                                <input type="date" name="date" value="" class="form-control date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="customer">Pelanggan</label>
                                <select name="customer" id="customer" class="form-control customer">
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach( $customers as $customer )
                                        <option value="{{ $customer->id }}">{{ $customer->store_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Transaksi -->
                    <div class="row mb-2 detail-transaksi">
                        <div class="col-md-12">
                            <h4>Detail Transaksi</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="select_product">Produk</label>
                                <select name="select_product" id="select_product" class="form-control product">
                                    <option value="">Pilih Produk</option>
                                    @foreach( $products as $product )
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="select_qty">Jumlah</label>
                                <input type="text" name="select_qty" class="form-control qty only_number" value="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="select_discount">Potongan Harga</label>
                                <input type="text" name="select_discount" class="form-control discount only_number" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <input type="hidden" name="url_add_order" value="{{ route( 'sellings.add_order' ) }}">
                            <button type="button" class="btn btn-info btn-block btn-add-order">Tambah Ke Detail Order</button>
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
                                        <th width="10%">Stok Produk</th>
                                        <th width="80px">Jumlah</th>
                                        <th width="130px">Potongan Harga</th>
                                        <th width="15%">Sub Total</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="first_row" style="display: none;">
                                        <td><input type="hidden" name="product[]"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right"><b class="total_transactions">Total</b></th>
                                        <th>
                                            <b class="total_transactions">Rp <span class="total_transaction">0</span></b>
                                            <input type="hidden" name="total_trans" value="0" />
                                        </th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5"></th>
                                        <th colspan="2">
                                            <input type="hidden" name="url_store_transaksi" value="{{ route( 'sellings.store' ) }}">
                                            <input type="hidden" name="url_index" value="{{ route( 'sellings.index' ) }}">
                                            <button class="btn btn-primary btn-block" type="submit">SIMPAN TRANSAKSI</button>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@include('transactions.sellings.script')