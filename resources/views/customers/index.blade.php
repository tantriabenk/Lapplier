@extends("layouts.global")
@section("title") Master Pelanggan @endsection
@section("content")

@if( session( 'status' ) )
<div class="alert alert-success">
    {{ session( 'status' ) }}
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <h2>Master Pelanggan</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <form action="{{ route( 'customers.index' ) }}">
            <div class="row">
                <div class="col-md-6">
                    <input value="{{ Request::get( 'keyword' ) }}" name="keyword" class="form-control" type="text" placeholder="Masukan nama pelanggan untuk filter..." />
                </div>
                <div class="col-md-6">
                    <input type="submit" value="Filter" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{ route( 'customers.create' ) }}" class="btn btn-primary">Tambah pelanggan</a>
    </div>
</div>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="60px"><b>No</b></th>
            <th><b>Nama Pelanggan</b></th>
            <th><b>Nama Toko</b></th>
            <th><b>Nomor Handphone</b></th>
            <th><b>Status</b></th>
            <th><b>Tindakan</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $customers as $index => $customer )
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->store_name }}</td>
            <td>{{ $customer->phone_number }}</td>
            <td>{{ $customer->status }}</td>
            <td>
                <a class="btn btn-info text-white btn-sm" href="{{ route( 'customers.edit', [$customer->id] ) }}">Ubah</a>
                <form onsubmit="return confirm('Pindahkan data pelanggan ke tong sampah?')" class="d-inline"
                    action="{{ route( 'customers.destroy', [$customer->id] ) }}" method="POST">
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
                {{ $customers->appends( Request::all() )->links() }}
            </td>
        </tr>
    </tfoot>
</table>
@endsection
