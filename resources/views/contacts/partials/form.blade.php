@php
  $v = fn($k) => old($k, $contact?->{$k} ?? '');
@endphp

<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Name *</label>
    <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $v('name') }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Company</label>
    <input name="company" class="form-control @error('company') is-invalid @enderror" value="{{ $v('company') }}">
    @error('company') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $v('email') }}">
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Phone</label>
    <input name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $v('phone') }}">
    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>
