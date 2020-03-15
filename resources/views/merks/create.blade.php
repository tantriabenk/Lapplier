@extends("layouts.global")

@section("title") Master Merk @endsection

@section("content")

<div class="row">
    <div class="col-md-11">
        <h2>Master Merk</h2>
    </div>
    <div class="col-md-1">
        <a href="{{ route( 'merks.index' ) }}" class="btn btn-danger btn-block">Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        @if( session( 'status' ) )
            <div class="alert alert-success">
                {{ session( 'status' ) }}
            </div>
        @endif

        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route( 'merks.store' ) }}" method="POST">
            @csrf
            <label for="name">Nama Merk</label>
            <input class="form-control" placeholder="Nama Merk" type="text" name="nama_merk" id="nama_merk" />
            <br>

            <label for="status">Status</label>
            <br>
            <input checked value="ACTIVE" name="status" type="radio" class="form-control" id="active">
            <label for="active">Active</label>
            <input value="INACTIVE" name="status" type="radio" class="form-control" id="inactive">
            <label for="inactive">Inactive</label>
            <br><br>
            <input class="btn btn-primary" type="submit" value="Save" />
        </form>
    </div>
</div>

@endsection