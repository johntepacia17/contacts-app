@extends('layouts.auth')

@section('subtitle', 'Choose a new password')

@section('content')
<form method="POST" action="{{ route('password.store') }}" class="vstack gap-3">
  @csrf

  <input type="hidden" name="token" value="{{ $request->route('token') }}">

  <div>
    <label class="form-label">Email</label>
    <input
      type="email"
      name="email"
      value="{{ old('email', $request->email) }}"
      required
      autofocus
      class="form-control @error('email') is-invalid @enderror"
      placeholder="you@example.com"
    >
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div>
    <label class="form-label">New Password</label>
    <input
      type="password"
      name="password"
      required
      class="form-control @error('password') is-invalid @enderror"
      placeholder="Min 8 characters"
    >
    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div>
    <label class="form-label">Confirm Password</label>
    <input
      type="password"
      name="password_confirmation"
      required
      class="form-control"
      placeholder="Repeat password"
    >
  </div>

  <button class="btn btn-primary w-100" type="submit">Reset Password</button>

  <div class="text-center small">
    <a href="{{ route('login') }}">Back to login</a>
  </div>
</form>
@endsection
