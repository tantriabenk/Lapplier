@extends("layouts.global")
@section("title") Transaksi Pembelian @endsection
@section("content")

@if( session( 'status' ) )
<div class="alert alert-success">
    {{ session( 'status' ) }}
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <h2>Transaksi Pembelian</h2>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route( 'purchases.create' ) }}" class="btn btn-success">Tambah Transaksi</a>
    </div>
</div>
<br>

<table class="table table-bordered">
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
                    <a href="{{ route( 'purchases.show', $purchase->id ) }}" class="btn btn-info">Detail</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan=10>
                
            </td>
        </tr>
    </tfoot>
</table>
@endsection
