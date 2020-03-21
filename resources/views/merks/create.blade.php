@extends("layouts.global")

@section("title") Master Merk @endsection

@section("content")

@include( 'merks.filter' )

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
            <input class="form-control @error( 'merk_name' ) is-invalid @enderror" placeholder="Nama Merk" type="text" name="merk_name" id="merk_name" value="{{ old( 'merk_name' ) }}" />
            @error('merk_name')
                <span class="invalid">{{ $message }}</span>
            @enderror
            <br>

            <input class="btn btn-primary" type="submit" value="Simpan" />
        </form>
    </div>
</div>

@endsection