@extends("layouts.global")

@section("title") Master Merk @endsection

@section("content")

<div class="col-md-8">

    @if( session( 'status' ) )
        <div class="alert alert-success">
            {{ session( 'status' ) }}
        </div>
    @endif

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route( 'merks.update', [$merk->id] ) }}" method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <label for="name">Nama Merk</label>
        <input class="form-control" placeholder="Nama Merk" type="text" name="nama_merk" id="nama_merk" value="{{ $merk->nama_merk }}" />
        <br>

        <label for="status">Status</label>
        <br>
        <input {{ $merk->status == 'ACTIVE' ? 'checked' : '' }} value="ACTIVE" name="status" type="radio" class="form-control" id="active">
        <label for="active">Active</label>
        <input {{ $merk->status == 'INACTIVE' ? 'checked' : '' }} value="INACTIVE" name="status" type="radio" class="form-control" id="inactive">
        <label for="inactive">Inactive</label>
        <br><br>
        <input class="btn btn-primary" type="submit" value="Save" />
    </form>
</div>

@endsection