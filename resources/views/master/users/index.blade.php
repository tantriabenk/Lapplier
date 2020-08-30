@extends("layouts.global")

@section('pageTitle') Master Petugas @endsection

@section( 'css' )
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section("title") Users list @endsection
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
                <a href="{{ route( 'users.create' ) }}" class="btn btn-primary">Tambah Petugas</a>
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
                            <td>
                                @if( $user->status == "ACTIVE" )
                                    <span class="badge badge-success">
                                        {{ $user->status }}
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        {{ $user->status }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info text-white btn-sm" href="{{ route( 'users.edit', [$user->id] ) }}">Edit</a>
                                <form onsubmit="return confirm('Hapus user secara permanent?')" class="d-inline"
                                    action="{{ route( 'users.destroy', [$user->id] ) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                                </form>
                                <a href="{{ route( 'users.show', [$user->id] ) }}" class="btn btn-primary btn-sm">Detail</a>
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

@section( 'script' )
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
$('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
});
</script>
@endsection
