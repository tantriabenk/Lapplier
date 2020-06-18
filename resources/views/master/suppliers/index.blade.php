@extends("layouts.global")
@section("title") Master Pelanggan @endsection
@section("content")

@if( session( 'status' ) )
    <div class="alert alert-success">
        {{ session( 'status' ) }}
    </div>
@endif

@include( 'master.suppliers.filter' )

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{ route( 'suppliers.create' ) }}" class="btn btn-success">Tambah Supplier</a>
    </div>
</div>
<br>

<table class="table table-bordered">
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
            <td>{{ $supplier->status }}</td>
            <td>
                <a class="btn btn-info text-white btn-sm" href="{{ route( 'suppliers.edit', [$supplier->id] ) }}">Ubah</a>

                @if( $supplier->status == "Inactive" )
                    <form onsubmit="return confirm('Pindahkan data pelanggan ke tong sampah?')" class="d-inline"
                        action="{{ route( 'suppliers.destroy', [$supplier->id] ) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan=10>
                {{ $suppliers->appends( Request::all() )->links() }}
            </td>
        </tr>
    </tfoot>
</table>
@endsection
