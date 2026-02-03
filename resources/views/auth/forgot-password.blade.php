@extends('layouts.auth')

@section('subtitle', 'Reset your password')

@section('content')
<div class="mb-3 text-muted">
  Forgot your password? No problem. Enter your email and we’ll send you a password reset link.
</div>

@if (session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('password.email') }}" class="vstack gap-3">
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

  <button class="btn btn-primary w-100" type="submit">
    Email Password Reset Link
  </button>

  <div class="text-center small">
    <a href="{{ route('login') }}">Back to login</a>
  </div>
</form>
@endsection
