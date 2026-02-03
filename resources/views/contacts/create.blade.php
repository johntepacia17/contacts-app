@extends('layouts.app')

@section('content')
<h3 class="mb-3">Add Contact</h3>

<form method="POST" action="{{ route('contacts.store') }}" class="card p-3">
  @csrf

  @include('contacts.partials.form', ['contact' => null])

  <div class="mt-3 d-flex gap-2">
    <button class="btn btn-primary">Save</button>
    <a class="btn btn-outline-secondary" href="{{ route('contacts.index') }}">Cancel</a>
  </div>
</form>
@endsection
