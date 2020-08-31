@extends("layouts.global")
@section('pageTitle') Master Produk - Tambah Produk @endsection
@section("title") Master Produk @endsection
@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            <div class="card-header text-right">
                <h3 class="card-title">Ubah Produk</h3>
                <a href="{{ route( 'products.index' ) }}" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>

            <form enctype="multipart/form-data" action="{{ route( 'products.update', [$product->id] ) }}" method="POST">
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
                                <label for="product_name">Nama Produk</label>
                                <input class="form-control @error( 'product_name' ) is-invalid @enderror" placeholder="Nama Produk" type="text" name="product_name" id="product_name" value="{{ $product->product_name }}" />
                                @error('product_name')
                                    <span class="invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock">Stok Awal</label>
                                <input class="form-control @error( 'stock' ) is-invalid @enderror" placeholder="Stok" type="text" name="stock" id="stock" value="{{ $product->stock }}" />
                                @error('stock')
                                    <span class="invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_buy">Harga Beli</label>
                                <input class="form-control @error( 'price_buy' ) is-invalid @enderror" placeholder="Harga Beli" type="text" name="price_buy" id="price_buy" value="{{ $product->price_buy }}" />
                                @error('price_buy')
                                    <span class="invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_sell">Harga Jual</label>
                                <input class="form-control @error( 'price_sell' ) is-invalid @enderror" placeholder="Harga Jual" type="text" name="price_sell" id="price_sell" value="{{ $product->price_sell }}" />
                                @error('price_sell')
                                    <span class="invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label><br/>
                                <div class="icheck-primary d-inline mr-3">
                                    <input type="radio" id="active" name="status" value="Active" @if( $product->status == "Active" ) checked @endif>
                                    <label for="active">Active</label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="inactive" name="status" value="Inactive" @if( $product->status == "Inactive" ) checked @endif>
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