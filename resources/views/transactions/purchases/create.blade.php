@extends("layouts.global")
@section('pageTitle') Transaksi Pembelian @endsection
@section("title") Transaksi Pembelian @endsection
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
                <h3 class="card-title">Tambah Transaksi Pembelian</h3>
                <a href="{{ route( 'purchases.index' ) }}" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
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
                    <div class="row mb-4 transactions-data">
                        <div class="col-md-12">
                            <h4>Data Transaksi</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="no_nota">Nomor Faktur</label>
                                <input type="text" name="no_faktur" value="" placeholder="Masukkan nomor faktur" class="form-control">
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
                                <label for="supplier">Pemasok</label>
                                <select name="supplier" id="supplier" class="form-control supplier">
                                    <option value="">Pilih Pemasok</option>
                                    @foreach( $suppliers as $supplier )
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Transaksi -->
                    <div class="row mb-4 detail-transaksi">
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
                                <label for="select_qty">Harga Beli</label>
                                <input type="text" name="select_price" class="form-control price_buy only_number" value="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="select_qty">Jumlah</label>
                                <input type="text" name="select_qty" class="form-control qty only_number" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="url_add_order" value="{{ route( 'purchases.add_order' ) }}">
                                <button type="button" class="btn btn-info btn-block btn-add-order">Tambah Ke Detail Order</button>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Order -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4>Detail Order</h4>
                        </div>
                        
                        <div class="col-md-12">
                            <table class="table table-bordered table-transactions">
                                <thead>
                                    <tr>
                                        <th width="25%">Produk</th>
                                        <th width="15%">Harga Beli</th>
                                        <th width="15%">Jumlah</th>
                                        <th width="15%">Sub Total</th>
                                        <th width="15%">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="first_row" style="display: none;">
                                        <td><input type="hidden" name="product[]"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right"><b class="total_transactions">Total</b></th>
                                        <th>
                                            <b class="total_transactions">Rp <span class="total_transaction">0</span></b>
                                            <input type="hidden" name="total_trans" value="0" />
                                        </th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th colspan="3"></th>
                                        <th colspan="2">
                                            <input type="hidden" name="url_store_transaksi" value="{{ route( 'purchases.store' ) }}">
                                            <input type="hidden" name="url_index" value="{{ route( 'purchases.index' ) }}">
                                            <button class="btn btn-success btn-block" type="submit">SIMPAN TRANSAKSI</button>
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

@include('transactions.purchases.script')