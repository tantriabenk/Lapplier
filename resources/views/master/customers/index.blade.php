@extends("layouts.global")
@section('pageTitle') Master Pelanggan @endsection
@section("title") Master Pelanggan @endsection
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
                <h3 class="card-title">Data Pelanggan</h3>
                <a href="{{ route( 'customers.create' ) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pelanggan</a>
                <a href="{{ route( 'customers.trash' ) }}" class="btn btn-danger"><i class="fas fa-trash"></i> Data Sampah</a>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="60px"><b>No</b></th>
                            {{-- <th><b>Nama Pelanggan</b></th> --}}
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
                            {{-- <td>{{ $customer->name }}</td> --}}
                            <td>{{ $customer->store_name }}</td>
                            <td>{{ $customer->phone_number }}</td>
                            <td>{[ status_indonesia( $customer->status ) }}</td>
                            <td>
                                <a class="btn btn-info text-white btn-sm" href="{{ route( 'customers.edit', [$customer->id] ) }}"><i class="fas fa-pen-square"></i> Ubah</a>

                                @if( $customer->status == "Inactive" )
                                    <form onsubmit="return confirm('Pindahkan data pelanggan ke tong sampah?')" class="d-inline"
                                        action="{{ route( 'customers.destroy', [$customer->id] ) }}" method="POST">
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