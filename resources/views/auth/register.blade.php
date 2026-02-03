@extends('layouts.auth')

@section('subtitle', 'Create your account')

@section('content')
<form method="POST" action="{{ route('register') }}" class="vstack gap-3">
  @csrf

  <div>
    <label class="form-label">Name</label>
    <input
      type="text"
      name="name"
      value="{{ old('name') }}"
      required
      autofocus
      class="form-control @error('name') is-invalid @enderror"
      placeholder="John Doe"
    >
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div>
    <label class="form-label">Email</label>
    <input
      type="email"
      name="email"
      value="{{ old('email') }}"
      required
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

  <button class="btn btn-primary w-100" type="submit">Create account</button>

  <div class="text-center small">
    Already have an account?
    <a href="{{ route('login') }}">Login</a>
  </div>
</form>
@endsection
