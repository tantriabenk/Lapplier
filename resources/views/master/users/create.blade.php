@extends("layouts.global")
@section('pageTitle') Master Petugas - Tambah Petugas @endsection
@section("title") Tambah Petugas @endsection
@section( "content" )

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            @if( session( 'status' ) )
                <div class="alert alert-success">
                    {{ session( 'status' ) }}
                </div>
            @endif

            <div class="card-header text-right">
                <h3 class="card-title">Tambah Petugas</h3>
                <a href="{{ route( 'users.index' ) }}" class="btn btn-danger">Kembali</a>
            </div>

            <form enctype="multipart/form-data" action="{{ route( 'users.store' ) }}" method="POST">
                <div class="card-body">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input class="form-control" placeholder="Nama Lengkap" type="text" name="name" id="name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" placeholder="username" type="text" name="username" id="username" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Nomor Handphone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Nomor Handphone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Roles</label><br>
                                <input type="checkbox" name="roles[]" id="ADMIN" value="ADMIN">
                                <label for="ADMIN">Administrator</label>
                                <input type="checkbox" name="roles[]" id="STAFF" value="STAFF">
                                <label for="STAFF">Staff</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" class="form-control" placeholder="Alamat"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="avatar">Gambar Avatar</label>
                        <input id="avatar" name="avatar" type="file" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" placeholder="user@mail.com" type="text" name="email" id="email" />
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" placeholder="password" type="password" name="password" id="password" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input class="form-control" placeholder="konfirmasi password" type="password" name="password_confirmation" id="password_confirmation" />
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer">
                    <input class="btn btn-primary" type="submit" value="Simpan" />
                </div>
            </form>

        </div>
    </div>
</div>

@endsection