@extends("layouts.global")
@section('pageTitle') Master Pemasok @endsection
@section("title") Master Pemasok @endsection
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
                <h3 class="card-title">Data Pemasok</h3>
                <a href="{{ route( 'suppliers.create' ) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pemasok</a>
                <a href="{{ route( 'suppliers.trash' ) }}" class="btn btn-danger"><i class="fas fa-trash"></i> Data Sampah</a>
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
                            @php
                                $status = $supplier->status;
                            @endphp
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->phone_number }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>{{ status_indonesia( $status ) }}</td>
                            <td>
                                <a class="btn btn-info text-white btn-sm" href="{{ route( 'suppliers.edit', [$supplier->id] ) }}">Ubah</a>

                                @if( $supplier->status == "Inactive" )
                                    <form onsubmit="return confirm('Pindahkan data pelanggan ke tong sampah?')" class="d-inline"
                                        action="{{ route( 'suppliers.destroy', [$supplier->id] ) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                @endif
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
