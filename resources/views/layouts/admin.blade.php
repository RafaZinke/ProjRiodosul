{{-- File: resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin | ProjRioDoSul')</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
  >
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"
    defer
  ></script>
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <nav
      class="flex-shrink-0 p-3 bg-light"
      style="width: 250px; height: 100vh;"
    >
      {{-- Logo / Dashboard link --}}
      <a
        href="{{ route('admin.dashboard') }}"
        class="d-flex align-items-center mb-3 link-dark text-decoration-none"
      >
        <span class="fs-4">Admin</span>
      </a>

      {{-- Back to public site --}}
      <div class="mb-3">
        <a
          href="{{ route('home') }}"
          class="btn btn-sm btn-outline-primary w-100"
        >
          ← Voltar ao site
        </a>
      </div>

      <hr>

      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a
            href="{{ route('admin.landmarks.index') }}"
            class="nav-link {{ request()->routeIs('admin.landmarks.*') ? 'active' : '' }}"
          >
            Marcos
          </a>
        </li>
        <li class="nav-item">
          <a
            href="{{ route('admin.events.index') }}"
            class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}"
          >
            Eventos
          </a>
        </li>
        <li class="nav-item">
          <a
            href="{{ route('admin.comments.index') }}"
            class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}"
          >
            Comentários
          </a>
        </li>
        <li class="nav-item">
          <a
            href="{{ route('admin.users.index') }}"
            class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
          >
            Usuários
          </a>
        </li>
      </ul>
    </nav>

    <!-- Main content area -->
    <div class="flex-grow-1 d-flex flex-column">
      {{-- Top header with user menu --}}
      <header class="d-flex justify-content-end align-items-center p-3 bg-white border-bottom">
        <div class="dropdown">
          <a
            href="#"
            class="text-dark text-decoration-none dropdown-toggle"
            id="userMenu"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
            <li>
              <a
                class="dropdown-item"
                href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
              >
                Logout
              </a>
              <form
                id="logout-form"
                action="{{ route('logout') }}"
                method="POST"
                class="d-none"
              >
                @csrf
              </form>
            </li>
          </ul>
        </div>
      </header>

      {{-- Page content --}}
      <main class="p-4">
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
      </main>
    </div>
  </div>
</body>
</html>
