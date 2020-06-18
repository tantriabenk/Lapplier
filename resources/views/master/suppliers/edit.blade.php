@extends("layouts.global")

@section("title") Master Supplier @endsection

@section("content")

<div class="row">
    <div class="col-md-11">
        <h2>Master Supplier</h2>
    </div>
    <div class="col-md-1">
        <a href="{{ route( 'suppliers.index' ) }}" class="btn btn-danger btn-block">Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        @if( session( 'status' ) )
            <div class="alert alert-success">
                {{ session( 'status' ) }}
            </div>
        @endif

        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route( 'suppliers.update', [$supplier->id] ) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name">Nama</label>
            <input class="form-control" placeholder="Nama" type="text" name="name" id="name" value="{{ $supplier->name }}" />
            <br>

            <label for="name">Nomor Handphone</label>
            <input class="form-control" placeholder="Nomor Handphone" type="text" name="phone_number" value="{{ $supplier->phone_number }}" id="phone_number" />
            <br>

            <label for="address">Alamat</label>
            <textarea class="form-control @error( 'address' ) is-invalid @enderror" placeholder="Masukkan alamat toko" name="address" id="address">{{ $supplier->address }}</textarea>
            <br>

            <label for="status">Status</label>
            <br>
            <input {{ $supplier->status == "Active" ? "checked" : "" }} value="Active" name="status" type="radio" class="form-control" id="active">
            <label for="active">Active</label>
            <input {{ $supplier->status == "Inactive" ? "checked" : "" }} value="Inactive" name="status" type="radio" class="form-control" id="inactive">
            <label for="inactive">Inactive</label>
            <br><br>

            <input class="btn btn-primary" type="submit" value="Simpan" />
        </form>
    </div>
</div>

@endsection