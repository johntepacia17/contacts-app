@extends('layouts.app')

@section('content')
<h3 class="mb-3">Edit Contact</h3>

<form method="POST" action="{{ route('contacts.update', $contact) }}" class="card p-3">
  @csrf
  @method('PUT')

  @include('contacts.partials.form', ['contact' => $contact])

  <div class="mt-3 d-flex gap-2">
    <button class="btn btn-primary">Update</button>
    <a class="btn btn-outline-secondary" href="{{ route('contacts.index') }}">Cancel</a>
  </div>
</form>
@endsection
