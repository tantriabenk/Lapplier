@extends("layouts.global")
@section('pageTitle') Master Pelanggan - Ubah Pelanggan @endsection
@section("title") Master Pelanggan @endsection
@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            <div class="card-header text-right">
                <h3 class="card-title">Ubah Pelanggan</h3>
                <a href="{{ route( 'customers.index' ) }}" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>

            <form enctype="multipart/form-data" action="{{ route( 'customers.update', [$customer->id] ) }}" method="POST">
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
                                <label for="name">Nama Toko</label>
                                <input class="form-control @error( 'store_name' ) is-invalid @enderror" placeholder="Masukkan nama toko" type="text" name="store_name" id="store_name" value="{{ $customer->store_name }}" />
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
                                <input class="form-control @error( 'phone_number' ) is-invalid @enderror" placeholder="Masukkan nomor handphone" type="text" name="phone_number" id="phone_number" value="{{ $customer->phone_number }}" />
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
                                <textarea class="form-control @error( 'address' ) is-invalid @enderror" placeholder="Masukkan alamat toko" name="address" id="address">{{ $customer->address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label><br/>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="active" name="status" value="Active" {{ $customer->status == "Active" ? "checked" : "" }}>
                                    <label for="active">Active</label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="inactive" name="status" value="Inactive" {{ $customer->status == "Inactive" ? "checked" : "" }}>
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