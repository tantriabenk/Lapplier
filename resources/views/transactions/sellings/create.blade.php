@extends("layouts.global")

@section("title") Transaksi Penjualan @endsection

@section("content")

<div class="row">
    <div class="col-md-12">
        
        <div class="bg-white shadow-sm p-3">

            <div class="alert" id="response">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="alert-heading">Error!</h4>
                <div class="box"></div>
            </div>

            <h1 class="m-b-20">Transaksi Penjualan</h1>

            <form method="POST" name="transactions">
                @csrf

                <div class="row m-b-20">
                    <div class="col-md-2">
                        <label for="no_nota">Nomor Nota</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="nota_no" value="" placeholder="Masukkan nomor nota" class="form-control">
                    </div>
                </div>

                <div class="row m-b-20">
                    <div class="col-md-2">
                        <label for="no_nota">Tanggal</label>
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="date" value="" class="form-control date">
                    </div>
                </div>

                <div class="row m-b-20">
                    <div class="col-md-2">
                        <label for="no_nota">Pelanggan</label>
                    </div>
                    <div class="col-md-4">
                        <select name="customer" id="customer" class="form-control customer">
                            <option value="">Pilih Pelanggan</option>
                            @foreach( $customers as $customer )
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row m-b-20">
                    <div class="col-md-12">
                        <table class="table table-bordered table-transactions">
                            <thead>
                                <tr>
                                    <th width="25%">Produk</th>
                                    <th width="15%">Harga Produk</th>
                                    <th width="10%">Stok</th>
                                    <th width="10%">Jumlah</th>
                                    <th>Potongan Harga</th>
                                    <th width="20%">Sub Total</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>

                                @include('transactions.sellings.row_transaction')

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" style="text-align: right;"><b class="total_transactions">Total</b></th>
                                    <th>
                                        <b class="total_transactions">Rp <span class="total_transaction">0</span></b>
                                        <input type="hidden" name="total_trans" value="0" />
                                    </th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-md-2 offset-md-10">
                        <input type="hidden" name="url_add_row" value="{{ route( 'sellings.add_row' ) }}">
                        <input type="hidden" name="url_get_product" value="{{ route( 'product.get_detail' ) }}">
                        <input type="hidden" name="row_number" value="{{ $row_number }}" />
                        <button class="btn btn-success btn-block btn-add-row" type="button">Tambah Baris</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="url_store_transaksi" value="{{ route( 'sellings.store' ) }}">
                        <input type="hidden" name="url_index" value="{{ route( 'sellings.index' ) }}">
                        <button class="btn btn-primary btn-block" type="submit">Simpan Transaksi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@include('transactions.sellings.script')