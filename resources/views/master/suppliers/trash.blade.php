@extends("layouts.global")
@section('pageTitle') Master Pemasok @endsection
@section("title") Master Supplier @endsection
@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header text-right">
                <h3 class="card-title">Data Pemasok</h3>
                <a href="{{ route( 'suppliers.create' ) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pemasok</a>
                <a href="{{ route( 'suppliers.index' ) }}" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="60px"><b>No</b></th>
                            <th><b>Nama</b></th>
                            <th><b>Nomor Handphone</b></th>
                            <th><b>Alamat</b></th>
                            <th><b>Status</b></th>
                            <th><b>Tindakan</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $suppliers as $index => $supplier )
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->phone_number }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>{{ status_indonesia( $supplier->status ) }}</td>
                            <td>
                                <a href="{{ route( 'suppliers.restore', [$supplier->id] ) }}" class="btn btn-success">Restore</a>
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