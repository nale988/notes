@extends('layouts.app')
@section('content')
<h2 class="content-title">
    Login
  </h2>
  <p class="d-flex justify-content-center">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-inline w-400 mw-full">
            <div class="form-group ">
                <label class="required w-100" for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="required w-100" for="password">Password</label>
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            </div>

            <div class="form-group form-inline mb-0 w-400 mw-full">
                <div class="custom-control">
                  <div class="custom-checkbox">
                    <input type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember me</label>
                  </div>
                </div>
                <input type="submit" class="btn btn-primary ml-auto" value="Sign in"> <!-- ml-auto = margin-left: auto -->
            </div>
        </div>
        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            <span class="d-flex justify-content-center">
            {{ __('Forgot Your Password?') }}
            </span>
        </a>
        @endif
    </form>
  </p>
@endsection
