@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<div class="login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>LOGIN</b>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

      <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="input-group mb-3">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="example@mail.com">
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
          <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>

        <p class="mb-1">
          @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}">
                  Forgot Your Password?
              </a>
          @endif
        </p>
        <p class="mb-0">
          <a href="{{ route('register') }}"" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</div>
@endsection
