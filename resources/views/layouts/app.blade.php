<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Contacts') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ route('contacts.index') }}">Contacts</a>

      <div class="ms-auto d-flex align-items-center gap-2">
        @auth
          <span class="text-white-50 small">{{ auth()->user()->email }}</span>

          @if(auth()->user()->role === 'superadmin')
            <a class="btn btn-sm btn-outline-warning" href="{{ route('admin.users.index') }}">Admin</a>
          @endif

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-outline-light" type="submit">Logout</button>
          </form>
        @endauth

        @guest
          <a class="btn btn-sm btn-outline-light" href="{{ route('login') }}">Login</a>
          <a class="btn btn-sm btn-warning" href="{{ route('register') }}">Register</a>
        @endguest
      </div>
    </div>
  </nav>

  <main class="container py-4">
    @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @yield('content')
  </main>
</body>
</html>
