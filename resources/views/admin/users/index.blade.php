@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="m-0">Users</h3>
  <a class="btn btn-primary" href="{{ route('admin.users.create') }}">Add User</a>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table table-striped m-0">
      <thead>
        <tr>
          <th>Name</th><th>Email</th><th>Role</th><th>Created</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $u)
          <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td><span class="badge bg-{{ $u->role === 'superadmin' ? 'warning' : 'secondary' }}">{{ $u->role }}</span></td>
            <td>{{ $u->created_at->format('Y-m-d') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-body">{{ $users->links() }}</div>
</div>
@endsection
