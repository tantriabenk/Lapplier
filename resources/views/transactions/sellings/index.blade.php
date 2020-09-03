@extends("layouts.global")
@section('pageTitle') Transaksi Penjualan @endsection
@section("title") Transaksi Penjualan @endsection
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
                <h3 class="card-title">Data Transaksi Penjualan</h3>
                <a href="{{ route( 'sellings.create' ) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Transaksi</a>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
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
                                <td>{{ $selling->customers->store_name }}</td>
                                <td>
                                    <a href="{{ route( 'sellings.show', $selling->id ) }}" class="btn btn-info"><i class="fas fa-eye"></i> Detail</a>
                                    <a href="{{ route( 'sellings.edit', $selling->id ) }}" class="btn btn-warning"><i class="fas fa-pen-square"></i> Ubah</a>
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
