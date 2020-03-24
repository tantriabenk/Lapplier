@extends("layouts.global")

@section("title") Master Product @endsection

@section("content")

@include( 'products.filter' )

<div class="row">
    <div class="col-md-12">

        @if( session( 'status' ) )
            <div class="alert alert-success">
                {{ session( 'status' ) }}
            </div>
        @endif

        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route( 'products.update', [$product->id] ) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="product_name">Nama Produk</label>
            <input class="form-control @error( 'product_name' ) is-invalid @enderror" placeholder="Nama Produk" type="text" name="product_name" id="product_name" value="{{ $product->product_name }}" />
            @error('product_name')
                <span class="invalid">{{ $message }}</span>
            @enderror
            <br>

            <label for="stock">Stok</label>
            <input class="form-control @error( 'stock' ) is-invalid @enderror" placeholder="Stok" type="text" name="stock" id="stock" value="{{ $product->stock }}" />
            @error('stock')
                <span class="invalid">{{ $message }}</span>
            @enderror
            <br>

            <label for="status">Status</label>
            <br>
            <input @if( $product->status == "Active" ) checked @endif value="Active" name="status" type="radio" class="form-control" id="active">
            <label for="active">Active</label>
            <input @if( $product->status == "Inactive" ) checked @endif value="Inactive" name="status" type="radio" class="form-control" id="inactive">
            <label for="inactive">Inactive</label>
            <br><br>

            <label for="price_buy">Harga Beli</label>
            <input class="form-control @error( 'price_buy' ) is-invalid @enderror" placeholder="Harga Beli" type="text" name="price_buy" id="price_buy" value="{{ $product->price_buy }}" />
            @error('price_buy')
                <span class="invalid">{{ $message }}</span>
            @enderror
            <br>

            <label for="price_sell">Harga Jual</label>
            <input class="form-control @error( 'price_sell' ) is-invalid @enderror" placeholder="Harga Jual" type="text" name="price_sell" id="price_sell" value="{{ $product->price_sell }}" />
            @error('price_sell')
                <span class="invalid">{{ $message }}</span>
            @enderror
            <br>

            <input class="btn btn-primary" type="submit" value="Simpan" />
        </form>
    </div>
</div>

@endsection