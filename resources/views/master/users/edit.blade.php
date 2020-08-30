@extends( "layouts.global" )

@section( 'pageTitle' ) Master Petugas - Ubah Petugas @endsection

@section( "title" ) Ubah Petugas @endsection

@section( "content" )

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            @if( session( 'status' ) )
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif

            <div class="card-header text-right">
                <h3 class="card-title">Ubah Petugas</h3>
                <a href="{{ route( 'users.index' ) }}" class="btn btn-danger">Kembali</a>
            </div>

            <form enctype="multipart/form-data" action="{{ route( 'users.update', [$user->id] ) }}" method="POST">
                <div class="card-body">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input class="form-control" placeholder="Nama Lengkap" value="{{ $user->name }}" type="text" name="name" id="name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" placeholder="username" value="{{ $user->username }}" type="text" name="username" id="username" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Nomor Handphone</label>
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" placeholder="Nomor Handphone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Roles</label><br>
                                <input type="checkbox" {{ in_array( "ADMIN", json_decode( $user->roles ) ) ? "checked" : "" }} name="roles[]" id="ADMIN" value="ADMIN">
                                <label for="ADMIN">Administrator</label>
                                <input type="checkbox" {{ in_array( "STAFF", json_decode( $user->roles ) ) ? "checked" : "" }} name="roles[]" id="STAFF" value="STAFF">
                                <label for="STAFF">Staff</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" class="form-control" placeholder="Alamat">{{ $user->address }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="avatar">Gambar Avatar</label><br/>
                        Avatar saat ini: <br>
                        @if($user->avatar)
                            <img src="{{ asset( 'storage/'.$user->avatar ) }}" width="120px" />
                            <br>
                        @else
                            Tidak ada avatar
                        @endif
                        <br><br/>
                        <input id="avatar" name="avatar" type="file" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" disabled placeholder="user@mail.com" value="{{ $user->email }}" type="text" name="email" id="email" />
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

