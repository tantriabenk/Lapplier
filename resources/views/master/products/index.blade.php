@extends("layouts.global")
@section("title") Master Product @endsection
@section("content")

@if( session( 'status' ) )
<div class="alert alert-success">
    {{ session( 'status' ) }}
</div>
@endif

@include( 'master.products.filter' )

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{ route( 'products.create' ) }}" class="btn btn-success">Tambah Produk</a>
    </div>
</div>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="60px"><b>No</b></th>
            <th><b>Nama Produk</b></th>
            <th><b>Stok</b></th>
            <th><b>Status</b></th>
            <th><b>Harga Jual</b></th>
            <th><b>Harga Beli</b></th>
            <th><b>Tindakan</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $products as $index => $product )
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->status }}</td>
            <td>@currency($product->price_buy)</td>
            <td>@currency($product->price_sell)</td>
            <td>
                <a class="btn btn-info text-white btn-sm" href="{{ route( 'products.edit', [$product->id] ) }}">Ubah</a>
                <form onsubmit="return confirm('Apakah yakin ingin menghapus data produk?')" class="d-inline"
                    action="{{ route( 'products.destroy', [$product->id] ) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan=10>
                {{ $products->appends( Request::all() )->links() }}
            </td>
        </tr>
    </tfoot>
</table>
@endsection
