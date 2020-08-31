@extends("layouts.global")
@section('pageTitle') Master Pemasok - Ubah Pemasok @endsection
@section("title") Master Pemasok @endsection
@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            <div class="card-header text-right">
                <h3 class="card-title">Ubah Produk</h3>
                <a href="{{ route( 'suppliers.index' ) }}" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>

            <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route( 'suppliers.update', [$supplier->id] ) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    @if( session( 'status' ) )
                        <div class="alert alert-success">
                            {{ session( 'status' ) }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input class="form-control @error( 'name' ) is-invalid @enderror" placeholder="Masukkan nama" type="text" name="name" id="name" value="{{ $supplier->name }}" />
                                @error( 'name' )
                                    <span class="invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nomor Handphone</label>
                                <input class="form-control @error( 'phone_number' ) is-invalid @enderror" placeholder="Masukkan nomor handphone" type="text" name="phone_number" id="phone_number" value="{{ $supplier->phone_number }}" />
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
                                <textarea class="form-control @error( 'address' ) is-invalid @enderror" placeholder="Masukkan alamat toko" name="address" id="address">{{ $supplier->address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label><br/>
                                <div class="icheck-primary d-inline mr-3">
                                    <input type="radio" id="active" name="status" value="Active" {{ $supplier->status == "Active" ? "checked" : "" }}>
                                    <label for="active">Aktif</label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="inactive" name="status" value="Inactive" {{ $supplier->status == "Inactive" ? "checked" : "" }}>
                                    <label for="inactive">Tidak Aktif</label>
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