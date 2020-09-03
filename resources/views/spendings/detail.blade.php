@extends("layouts.global")
@section('pageTitle') Detail Pengeluaran @endsection
@section("title") Detail Pengeluaran @endsection
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
                            <h4>Data Transaksi</h4>
                        </div>
                        <div class="col-md-4">
                            <label for="officer">Petugas</label>
                            <input type="text" readonly name="officer" value="{{ $spendings->officer }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="date">Tanggal</label>
                            <input type="text" readonly name="date" value="{{ $spendings->date }}" class="form-control">
                        </div>
                    </div>


                    <!-- Detail Order -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h4>Detail Order</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered table-transactions">
                                <thead>
                                    <tr>
                                        <th width="70%">Deskripsi</th>
                                        <th width="30%">Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp

                                    @foreach( $spendings->spending_details as $spending_detail )
                                        @php
                                            $description = $spending_detail->description;
                                            $amount = $spending_detail->amount;

                                            $total += $amount;
                                        @endphp
                                        <tr>
                                            <td>{{ $description }}</td>
                                            <td>@currency( $amount )</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-right"><b class="total_transactions">Total</b></th>
                                        <th><b class="total_transactions">@currency( $total )</b></th>
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