@extends("layouts.global")
@section('pageTitle') Master Produk @endsection
@section("title") Master Produk @endsection
@section("content")

<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header text-right">
                <h3 class="card-title">Data Produk</h3>
                <a href="{{ route( 'products.create' ) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Produk</a>
                <a href="{{ route( 'products.trash' ) }}" class="btn btn-danger"><i class="fas fa-trash"></i> Data Sampah</a>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="60px"><b>No</b></th>
                            <th><b>Nama Produk</b></th>
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
                            <td>{{ $product->status }}</td>
                            <td>@currency($product->price_buy)</td>
                            <td>@currency($product->price_sell)</td>
                            <td>
                                <a href="{{ route( 'products.restore', [$product->id] ) }}" class="btn btn-success">Restore</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
