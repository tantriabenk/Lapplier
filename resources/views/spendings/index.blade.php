@extends("layouts.global")
@section('pageTitle') Pengeluaran @endsection
@section("title") Pengeluaran @endsection
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
                <h3 class="card-title">Pengeluaran</h3>
                <a href="{{ route( 'spendings.create' ) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pengeluaran</a>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
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
                                    <a href="{{ route( 'spendings.show', $spending->id ) }}" class="btn btn-info"><i class="fas fa-eye"></i> Detail</a>
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
