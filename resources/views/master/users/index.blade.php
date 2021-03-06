@extends("layouts.global")
@section('pageTitle') Master Petugas @endsection
@section("title") Master Petugas @endsection
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
                <h3 class="card-title">Data Petugas</h3>
                <a href="{{ route( 'users.create' ) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Petugas</a>
                <a href="{{ route( 'users.trash' ) }}" class="btn btn-danger"><i class="fas fa-trash"></i> Data Sampah</a>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="60px"><b>No</b></th>
                            <th><b>Nama</b></th>
                            <th><b>Username</b></th>
                            <th><b>Email</b></th>
                            <th><b>Avatar</b></th>
                            <th><b>Status</b></th>
                            <th><b>Tindakan</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $users as $index => $user )
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if( $user->avatar )
                                    <img src="{{ asset( 'storage/'.$user->avatar ) }}" width="70px" />
                                @else
                                    Tidak Ada Foto
                                @endif
                            </td>
                            <td> {{ status_indonesia( $user->status ) }}</td>
                            <td>
                                <a class="btn btn-info text-white btn-sm" href="{{ route( 'users.edit', [$user->id] ) }}"><i class="fas fa-pen-square"></i> Ubah</a>

                                @if( $user->status == "Inactive" )
                                <form onsubmit="return confirm('Hapus user secara permanent?')" class="d-inline"
                                    action="{{ route( 'users.destroy', [$user->id] ) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                                @endif

                                <a href="{{ route( 'users.show', [$user->id] ) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Detail</a>
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
