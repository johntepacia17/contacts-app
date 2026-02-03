@extends('layouts.auth')

@section('subtitle', 'Login to continue')

@section('content')
@if (session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('login') }}" class="vstack gap-3">
  @csrf

  <div>
    <label class="form-label">Email</label>
    <input
      type="email"
      name="email"
      value="{{ old('email') }}"
      required
      autofocus
      class="form-control @error('email') is-invalid @enderror"
      placeholder="you@example.com"
    >
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div>
    <label class="form-label">Password</label>
    <input
      type="password"
      name="password"
      required
      class="form-control @error('password') is-invalid @enderror"
      placeholder="••••••••"
    >
    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="d-flex justify-content-between align-items-center">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="remember" id="remember">
      <label class="form-check-label" for="remember">Remember me</label>
    </div>

    @if (Route::has('password.request'))
      <a class="small" href="{{ route('password.request') }}">Forgot password?</a>
    @endif
  </div>

  <button class="btn btn-primary w-100" type="submit">Login</button>

  @if (Route::has('register'))
    <div class="text-center small">
      No account yet?
      <a href="{{ route('register') }}">Create one</a>
    </div>
  @endif
</form>
@endsection
