@extends("layouts.global")
@section("title") Master Supplier @endsection
@section("content")

@if( session( 'status' ) )
    <div class="alert alert-success">
        {{ session( 'status' ) }}
    </div>
@endif

@include( 'master.suppliers.filter' )
<br/>
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="60px"><b>No</b></th>
            <th><b>Nama Supplier</b></th>
            <th><b>Nomor Handphone</b></th>
            <th><b>Alamat</b></th>
            <th><b>Status</b></th>
            <th><b>Tindakan</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $suppliers as $index => $supplier )
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->phone_number }}</td>
            <td>{{ $supplier->address }}</td>
            <td>{{ $supplier->status }}</td>
            <td>
                <a href="{{ route( 'suppliers.restore', [$supplier->id] ) }}" class="btn btn-success">Restore</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan=10>
                {{ $suppliers->appends( Request::all() )->links() }}
            </td>
        </tr>
    </tfoot>
</table>
@endsection
