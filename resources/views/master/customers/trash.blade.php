@extends("layouts.global")
@section('pageTitle') Master Pelanggan - Data Sampah @endsection
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
                <a href="{{ route( 'customers.index' ) }}" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
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
                            <td>{{ $customer->status }}</td>
                            <td>
                                <a href="{{ route( 'customers.restore', [$customer->id] ) }}" class="btn btn-info"><i class="fas fa-trash-restore"></i> Restore</a>
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
