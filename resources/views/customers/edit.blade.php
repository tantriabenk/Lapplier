@extends("layouts.global")

@section("title") Master Pelanggan @endsection

@section("content")

<div class="row">
    <div class="col-md-11">
        <h2>Master Pelanggan</h2>
    </div>
    <div class="col-md-1">
        <a href="{{ route( 'customers.index' ) }}" class="btn btn-danger btn-block">Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        @if( session( 'status' ) )
            <div class="alert alert-success">
                {{ session( 'status' ) }}
            </div>
        @endif

        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route( 'customers.update', [$customer->id] ) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name">Nama</label>
            <input class="form-control" placeholder="Nama" type="text" name="name" id="name" value="{{ $customer->name }}" />
            <br>

            <label for="name">Nama Toko</label>
            <input class="form-control" placeholder="Nama Toko" type="text" name="store_name" value="{{ $customer->store_name }}" id="store_name" />
            <br>

            <label for="name">Nomor Handphone</label>
            <input class="form-control" placeholder="Nomor Handphone" type="text" name="phone_number" value="{{ $customer->phone_number }}" id="phone_number" />
            <br>

            <label for="address">Alamat</label>
            <textarea class="form-control @error( 'address' ) is-invalid @enderror" placeholder="Masukkan alamat toko" name="address" id="address">{{ $customer->address }}</textarea>
            <br>

            <label for="status">Status</label>
            <br>
            <input {{ $customer->status == "Active" ? "checked" : "" }} value="Active" name="status" type="radio" class="form-control" id="active">
            <label for="active">Active</label>
            <input {{ $customer->status == "Inactive" ? "checked" : "" }} value="Inactive" name="status" type="radio" class="form-control" id="inactive">
            <label for="inactive">Inactive</label>
            <br><br>

            <input class="btn btn-primary" type="submit" value="Simpan" />
        </form>
    </div>
</div>

@endsection