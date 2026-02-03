@extends('layouts.app')

@section('content')
<h3 class="mb-3">Add User</h3>

<form method="POST" action="{{ route('admin.users.store') }}" class="card p-3">
  @csrf

  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Name</label>
      <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
      @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
      @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
      @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Role</label>
      <select name="role" class="form-select @error('role') is-invalid @enderror" required>
        <option value="user" @selected(old('role')==='user')>user</option>
        <option value="superadmin" @selected(old('role')==='superadmin')>superadmin</option>
      </select>
      @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
  </div>

  <div class="mt-3 d-flex gap-2">
    <button class="btn btn-primary">Create</button>
    <a class="btn btn-outline-secondary" href="{{ route('admin.users.index') }}">Back</a>
  </div>
</form>
@endsection
