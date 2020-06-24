@extends("layouts.global")
@section("title") Pengeluaran @endsection
@section("content")

@if( session( 'status' ) )
<div class="alert alert-success">
    {{ session( 'status' ) }}
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <h2>Pengeluaran</h2>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route( 'spendings.create' ) }}" class="btn btn-success">Tambah Data</a>
    </div>
</div>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="60px"><b>No</b></th>
            <th><b>Tanggal</b></th>
            <th><b>Petugas</b></th>
            <th><b>Total</b></th>
            <th><b>Aksi</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $spendings as $index => $spending )
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $spending->date }}</td>
                <td>{{ $spending->officer }}</td>
                <td>@currency($spending->total_amount)</td>
                <td>
                    <a href="{{ route( 'spendings.show', $spending->id ) }}" class="btn btn-info">Detail</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan=10>
                
            </td>
        </tr>
    </tfoot>
</table>
@endsection
