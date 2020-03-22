@extends("layouts.global")
@section("title") Master Pelanggan @endsection
@section("content")

@if( session( 'status' ) )
    <div class="alert alert-success">
        {{ session( 'status' ) }}
    </div>
@endif

@include( 'customers.filter' )
<br/>
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
                <a href="{{ route( 'customers.restore', [$customer->id] ) }}" class="btn btn-success">Restore</a>
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
