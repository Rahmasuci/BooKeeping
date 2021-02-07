@extends('layouts.auth')
@section('title', 'Forgot Password')
@section('content')
<div class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>FORGOT </b>Password</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                </div>
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{route('login')}}">Login</a>
            </p>
            <p class="mb-0">
                <a href="{{route('register')}}" class="text-center">Register a new membership</a>
            </p>
            </div>
        </div>
    </div>
</div>
@endsection