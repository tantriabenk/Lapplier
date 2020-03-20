@extends( 'layouts.global' )
@section( 'title' ) Trashed Merks @endsection
@section( 'content' )

<div class="row">
    <div class="col-md-11">
        <h2>Master Merk</h2>
    </div>
    <div class="col-md-1">
        <a href="{{ route( 'merks.index' ) }}" class="btn btn-danger btn-block">Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="{{ route( 'merks.index' ) }}">
            <div class="row">
                <div class="col-md-6">
                    <input value="{{ Request::get( 'keyword' ) }}" name="keyword" class="form-control" type="text" placeholder="Masukan nama merk untuk filter..." />
                </div>
                <div class="col-md-6">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route( 'merks.index' ) }}">Published</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route( 'merks.trash' ) }}">Trash</a>
                    </li>
                </ul>
                </div>
            </div>
        </form>
    </div>
</div>

<br/>

<div class="row">
    <div class="col-md-12">
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
                        <a href="{{ route( 'merks.restore', [$merk->id] ) }}" class="btn btn-success">Restore</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colSpan="10">
                        {{ $merks->appends( Request::all() )->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection
