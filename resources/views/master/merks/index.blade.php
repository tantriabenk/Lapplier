@extends("layouts.global")
@section('pageTitle') Master Merek @endsection
@section("title") Master Merek @endsection
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
                <h3 class="card-title">Data Merek</h3>
                <a href="{{ route( 'merks.create' ) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Merek</a>
                <a href="{{ route( 'merks.trash' ) }}" class="btn btn-danger"><i class="fas fa-trash"></i> Data Sampah</a>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
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
                                <a class="btn btn-info text-white btn-sm" href="{{ route( 'merks.edit', [$merk->id] ) }}"><i class="fas fa-pen-square"></i> Ubah</a>
                                <form onsubmit="return confirm('Pindahkan data merk ke tong sampah?')" class="d-inline"
                                    action="{{ route( 'merks.destroy', [$merk->id] ) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
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
