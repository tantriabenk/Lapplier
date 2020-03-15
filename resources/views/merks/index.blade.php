@extends("layouts.global")
@section("title") Merks list @endsection
@section("content")

@if( session( 'status' ) )
<div class="alert alert-success">
    {{ session( 'status' ) }}
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <form action="{{route('merks.index')}}">
            <div class="row">
                <div class="col-md-6">
                    <input value="{{Request::get('keyword')}}" name="keyword" class="form-control" type="text" placeholder="Masukan nama merk untuk filter..." />
                </div>
                <div class="col-md-6">
                    <input {{Request::get('status') == 'ACTIVE' ? 'checked' : ''}} value="ACTIVE" name="status" type="radio" class="form-control" id="active">
                    <label for="active">Active</label>

                    <input {{Request::get('status') == 'INACTIVE' ? 'checked' : ''}} value="INACTIVE" name="status" type="radio" class="form-control" id="inactive">
                    <label for="inactive">Inactive</label>
                    <input type="submit" value="Filter" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{ route( 'merks.create' ) }}" class="btn btn-primary">Tambah merk</a>
    </div>
</div>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th><b>Nama Merk</b></th>
            <th><b>Status</b></th>
            <th><b>Tindakan</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $merks as $merk )
        <tr>
            <td>{{ $merk->nama_merk }}</td>
            <td>
                @if($merk->status == "ACTIVE")
                <span class="badge badge-success">
                    {{ $merk->status }}
                </span>
                @else
                <span class="badge badge-danger">
                    {{ $merk->status }}
                </span>
                @endif
            </td>
            <td>
                <a class="btn btn-info text-white btn-sm" href="{{ route( 'merks.edit', [$merk->id] ) }}">Ubah</a>
                <form onsubmit="return confirm('Hapus merk secara permanen?')" class="d-inline"
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
