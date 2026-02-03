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
  <div class="min-vh-100 d-flex align-items-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-7 col-lg-5">
          <div class="text-center mb-3">
            <div class="fw-bold fs-4">FDCI Contacts</div>
            <div class="text-muted small">@yield('subtitle')</div>
          </div>

          <div class="card shadow-sm border-0" style="border-radius: 14px;">
            <div class="card-body p-4">
              @yield('content')
            </div>
          </div>

          <div class="text-center text-muted small mt-3">
            © {{ date('Y') }} {{ config('app.name', 'Contacts') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
