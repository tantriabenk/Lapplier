@extends("layouts.global")
@section("title") Master Product @endsection
@section("content")

@if( session( 'status' ) )
<div class="alert alert-success">
    {{ session( 'status' ) }}
</div>
@endif

@include( 'products.filter' )

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
                <a href="{{ route( 'products.restore', [$product->id] ) }}" class="btn btn-success">Restore</a>
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
