@extends("layouts.global")
@section('pageTitle') Master Pelanggan - Tambah Pelanggan @endsection
@section("title") Master Pelanggan @endsection
@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            <div class="card-header text-right">
                <h3 class="card-title">Tambah Pelanggan</h3>
                <a href="{{ route( 'customers.index' ) }}" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>

            <form enctype="multipart/form-data" action="{{ route( 'customers.store' ) }}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Toko</label>
                                <input class="form-control @error( 'store_name' ) is-invalid @enderror" placeholder="Masukkan nama toko" type="text" name="store_name" id="store_name" value="{{ old( 'store_name' ) }}" />
                                @error( 'store_name' )
                                    <span class="invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nomor Handphone</label>
                                <input class="form-control @error( 'phone_number' ) is-invalid @enderror" placeholder="Masukkan nomor handphone" type="text" name="phone_number" id="phone_number" value="{{ old( 'phone_number' ) }}" />
                                @error( 'phone_number' )
                                    <span class="invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control @error( 'address' ) is-invalid @enderror" placeholder="Masukkan alamat toko" name="address" id="address">{{ old( 'address' ) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label><br/>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="active" name="status" value="Active" checked>
                                    <label for="active">Active</label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="inactive" name="status" value="Inactive">
                                    <label for="inactive">Inactive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer">
                    <input class="btn btn-primary" type="submit" value="Simpan" />
                </div>
            </form>

        </div>
    </div>
</div>

@endsection