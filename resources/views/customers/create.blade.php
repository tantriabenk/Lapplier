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

        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route( 'customers.store' ) }}" method="POST">
            @csrf

            <label for="name">Nama</label>
            <input class="form-control @error( 'name' ) is-invalid @enderror" placeholder="Masukkan nama pemilik toko" type="text" name="name" id="name" value="{{ old( 'name' ) }}" />
            @error( 'name' )
                <span class="invalid">{{ $message }}</span>
            @enderror
            <br>

            <label for="name">Nama Toko</label>
            <input class="form-control @error( 'store_name' ) is-invalid @enderror" placeholder="Masukkan nama toko" type="text" name="store_name" id="store_name" value="{{ old( 'store_name' ) }}" />
            @error( 'store_name' )
                <span class="invalid">{{ $message }}</span>
            @enderror
            <br>

            <label for="name">Nomor Handphone</label>
            <input class="form-control @error( 'phone_number' ) is-invalid @enderror" placeholder="Masukkan nomor handphone" type="text" name="phone_number" id="phone_number" value="{{ old( 'phone_number' ) }}" />
            @error( 'phone_number' )
                <span class="invalid">{{ $message }}</span>
            @enderror
            <br>

            <label for="address">Alamat</label>
            <textarea class="form-control @error( 'address' ) is-invalid @enderror" placeholder="Masukkan alamat toko" name="address" id="address">{{ old( 'address' ) }}</textarea>
            <br>

            <label for="status">Status</label>
            <br>
            <input checked value="Active" name="status" type="radio" class="form-control" id="active">
            <label for="active">Active</label>
            <input value="Inactive" name="status" type="radio" class="form-control" id="inactive">
            <label for="inactive">Inactive</label>
            <br><br>

            <input class="btn btn-primary" type="submit" value="Simpan" />
        </form>
    </div>
</div>

@endsection