@extends("layouts.global")
@section('pageTitle') Transaksi Pembelian @endsection
@section("title") Transaksi Pembelian @endsection
@section("content")

@if( session( 'status' ) )
<div class="alert alert-success">
    {{ session( 'status' ) }}
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header text-right">
                <h3 class="card-title">Data Transaksi Pembelian</h3>
                <a href="{{ route( 'purchases.create' ) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Transaksi</a>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="60px"><b>No</b></th>
                            <th><b>Nomor Faktur</b></th>
                            <th><b>Tanggal</b></th>
                            <th><b>Total</b></th>
                            <th><b>Pemasok</b></th>
                            <th><b>Aksi</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $purchases as $index => $purchase )
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $purchase->no_faktur }}</td>
                                <td>{{ $purchase->date }}</td>
                                <td>@currency($purchase->total_purchase)</td>
                                <td>{{ $purchase->suppliers->name }}</td>
                                <td>
                                    <a href="{{ route( 'purchases.show', $purchase->id ) }}" class="btn btn-info"><i class="fas fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
