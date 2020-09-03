@extends("layouts.global")
@section('pageTitle') Master Produk @endsection
@section("title") Master Produk @endsection
@section("content")

@if( session( 'status' ) )
<div class="alert alert-success">
    {{ session( 'status' ) }}
</div>
@endif

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
                            <th><b>Stok Awal</b></th>
                            <th><b>Stok Saat Ini</b></th>
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
                            <td>{{ ProductHelp::get_product_stock_recent( $product->id ) }}</td>
                            <td>{{ status_indonesia($product->status) }}</td>
                            <td>@currency($product->price_buy)</td>
                            <td>@currency($product->price_sell)</td>
                            <td>
                                <a class="btn btn-info text-white btn-sm" href="{{ route( 'products.edit', [$product->id] ) }}"><i class="fas fa-pen-square"></i> Ubah</a>

                                @if( $product->status == "Inactive" )
                                <form onsubmit="return confirm('Apakah yakin ingin menghapus data produk?')" class="d-inline"
                                    action="{{ route( 'products.destroy', [$product->id] ) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                                @endif
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
