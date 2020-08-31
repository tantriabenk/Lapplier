@extends("layouts.global")
@section('pageTitle') Master Merek @endsection
@section("title") Master Merek @endsection
@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header text-right">
                <h3 class="card-title">Data Merek</h3>
                <a href="{{ route( 'merks.create' ) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Merek</a>
                <a href="{{ route( 'merks.index' ) }}" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
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
                                <a href="{{ route( 'merks.restore', [$merk->id] ) }}" class="btn btn-success">Restore</a>
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
