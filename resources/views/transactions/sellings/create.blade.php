@extends("layouts.global")

@section("title") Transaksi Penjualan @endsection

@section("content")

<div class="row">
    <div class="col-md-12">

        @if( session( 'status' ) )
            <div class="alert alert-success">
                {{ session( 'status' ) }}
            </div>
        @endif
        
        <div class="bg-white shadow-sm p-3">
            <h1 class="m-b-20">Transaksi Penjualan</h1>

            <form enctype="multipart/form-data" action="{{ route( 'sellings.store' ) }}" method="POST">
                @csrf

                <div class="row m-b-20">
                    <div class="col-md-2">
                        <label for="no_nota">Nomor Nota</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="nota_no" value="" placeholder="Masukkan nomor nota" class="form-control">
                    </div>
                </div>

                <div class="row m-b-20">
                    <div class="col-md-2">
                        <label for="no_nota">Tanggal</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="date" value="" class="form-control">
                    </div>
                </div>

                <div class="row m-b-20">
                    <div class="col-md-2">
                        <label for="no_nota">Pelanggan</label>
                    </div>
                    <div class="col-md-4">
                        <select name="customer" id="customer" class="form-control">
                            <option value="">Pilih Pelanggan</option>
                            @foreach( $customers as $customer )
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input class="btn btn-primary btn-block" type="button" value="Simpan Transaksi" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection