@extends("layouts.global")

@section('pageTitle') Master Petugas - Detail Petugas @endsection

@section("title") Detail Petugas @endsection

@section( "content" )

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            <div class="card-header text-right">
                <h3 class="card-title">Detail Petugas</h3>
                <a href="{{ route( 'users.index' ) }}" class="btn btn-danger">Kembali</a>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nama</label><br/>
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username</label><br/>
                            {{ $user->username }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Nomor Handphone</label><br/>
                            {{ $user->phone }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Roles</label><br>
                            @foreach (json_decode($user->roles) as $role)
                                &middot; {{$role}} <br>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Alamat</label><br/>
                    {{ $user->address }}
                </div>

                <div class="form-group">
                    <label for="avatar">Gambar Avatar</label><br/>
                    @if($user->avatar)
                        <img src="{{asset('storage/'. $user->avatar)}}" width="128px" />
                    @else
                        No avatar
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">Email</label><br/>
                    {{ $user->email }}
                </div> 
            </div>
        </div>
    </div>
</div>

@endsection