@extends("layouts.global")
@section('pageTitle') Master Merek - Ubah Merek @endsection
@section("title") Master Merk @endsection
@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            <div class="card-header text-right">
                <h3 class="card-title">Ubah Merek</h3>
                <a href="{{ route( 'merks.index' ) }}" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>

            <form enctype="multipart/form-data" action="{{ route( 'merks.update', [$merk->id] ) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Merk</label>
                                <input class="form-control @error( 'merk_name' ) is-invalid @enderror" placeholder="Nama Merk" type="text" name="merk_name" id="merk_name" value="{{ $merk->merk_name }}" />
                                @error('merk_name')
                                    <span class="invalid">{{ $message }}</span>
                                @enderror
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