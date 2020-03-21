@extends("layouts.global")
@section("title") Merks list @endsection
@section("content")

@if( session( 'status' ) )
<div class="alert alert-success">
    {{ session( 'status' ) }}
</div>
@endif

@include( 'merks.filter' )

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{ route( 'merks.create' ) }}" class="btn btn-success">Tambah merk</a>
    </div>
</div>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="60px"><b>No</b></th>
            <th><b>Nama Merk</b></th>
            <th><b>Slug</b></th>
            <th><b>Tindakan</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $merks as $index => $merk )
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $merk->merk_name }}</td>
            <td>{{ $merk->slug }}</td>
            <td>
                <a class="btn btn-info text-white btn-sm" href="{{ route( 'merks.edit', [$merk->id] ) }}">Ubah</a>
                <form onsubmit="return confirm('Pindahkan data merk ke tong sampah?')" class="d-inline"
                    action="{{ route( 'merks.destroy', [$merk->id] ) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan=10>
                {{ $merks->appends( Request::all() )->links() }}
            </td>
        </tr>
    </tfoot>
</table>
@endsection
