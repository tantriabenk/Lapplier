@extends("layouts.global")
@section('pageTitle') Pengeluaran @endsection
@section("title") Pengeluaran @endsection
@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header text-right">
                <h3 class="card-title">Tambah Pengeluaran</h3>
                <a href="{{ route( 'spendings.index' ) }}" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>

            <div class="card-body">
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
                    <div class="row mb-4 transactions-data">
                        <div class="col-md-12">
                            <h4>Data Pengeluaran</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="no_nota">Nama Petugas</label>
                                <input type="text" name="officer" value="" placeholder="Masukkan nama petugas" class="form-control officer">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date">Tanggal</label>
                                <input type="date" name="date" value="" class="form-control date">
                            </div>
                        </div>
                    </div>


                    <!-- Detail Transaksi -->
                    <div class="row mb-4 detail-transaksi">
                        <div class="col-md-12">
                            <h4>Detail Pengeluaran</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="description_order">Deskripsi</label>
                                <input type="text" name="description_order" class="form-control" placeholder="Masukkan deskripsi" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="amount_order">Biaya</label>
                                <input type="text" name="amount_order" class="form-control only_number" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <input type="hidden" name="url_add_order" value="{{ route( 'spendings.add_order' ) }}">
                            <button type="button" class="btn btn-info btn-block btn-add-order">Tambah Ke Detail Order</button>
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
                                        <th width="25%">Deskripsi</th>
                                        <th width="15%">Biaya</th>
                                        <th width="15%">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="first_row" style="display: none;">
                                        <td><input type="hidden" name="description[]"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-right"><b class="total_transactions">Total</b></th>
                                        <th>
                                            <b class="total_transactions">Rp <span class="total_transaction">0</span></b>
                                            <input type="hidden" name="total_trans" value="0" />
                                        </th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th colspan="1"></th>
                                        <th colspan="2">
                                            <input type="hidden" name="url_store_transaksi" value="{{ route( 'spendings.store' ) }}">
                                            <input type="hidden" name="url_index" value="{{ route( 'spendings.index' ) }}">
                                            <button class="btn btn-success btn-block" type="submit">SIMPAN TRANSAKSI</button>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection

@include('spendings.script')