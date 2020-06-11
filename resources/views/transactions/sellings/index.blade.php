@extends("layouts.global")
@section("title") Transaksi Penjualan @endsection
@section("content")

@if( session( 'status' ) )
<div class="alert alert-success">
    {{ session( 'status' ) }}
</div>
@endif

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{ route( 'sellings.create' ) }}" class="btn btn-success">Tambah Transaksi</a>
    </div>
</div>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="60px"><b>No</b></th>
            <th><b>Nomor Nota</b></th>
            <th><b>Tanggal</b></th>
            <th><b>Total</b></th>
            <th><b>Pelanggan</b></th>
            <th><b>Aksi</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $sellings as $index => $selling )
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $selling->nota_number }}</td>
                <td>{{ $selling->date }}</td>
                <td>@currency($selling->total_selling)</td>
                <td>{{ $selling->customers->name }}</td>
                <td>
                    <a href="" class="btn btn-primary">Ubah</a>
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
