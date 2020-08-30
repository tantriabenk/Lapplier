@extends('layouts.app')

@section('content')

@if( session( 'error' ) )
    <div class="alert alert-danger">
        {{ session( 'error' ) }}
    </div>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf

    <div class="input-group mb-3">
        <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ @old('username') }}" placeholder="Usename" name="username">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @error('username')
            <span class="invalid-feedback block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="input-group mb-3">
        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password')
            <span class="invalid-feedback block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="row">
        <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
        </div>
        <!-- /.col -->
    </div>
</form>
@endsection
