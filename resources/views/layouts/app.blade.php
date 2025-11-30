<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="bg-light">

@auth
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar bg-primary text-white p-3" style="min-height: 100vh; width: 230px;">
            <h4 class="mb-4 text-center">EMS</h4>
            <div class="mb-3 text-center">
                <div class="rounded-circle bg-white text-primary d-inline-flex justify-content-center align-items-center" style="width:60px;height:60px;">
                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                </div>
                <div class="mt-2">
                    <strong>{{ Auth::user()->name }}</strong><br>
                    <small>{{ Auth::user()->is_admin ? 'Admin' : 'Employee' }}</small>
                </div>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item mb-1">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white">Dashboard</a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('profile.show') }}" class="nav-link text-white">My Profile</a>
                </li>
                @if(Auth::user()->is_admin)
                    <li class="nav-item mb-1">
                        <a href="{{ route('admin.employees.index') }}" class="nav-link text-white">Employees</a>
                    </li>
                @endif
                <li class="nav-item mt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-light w-100">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Main content -->
        <main class="flex-grow-1 p-4">
            @include('partials.flash')
            @yield('content')
        </main>
    </div>
@else
    <!-- Guest (login/register) layout -->
    <div class="d-flex align-items-center justify-content-center" style="min-height:100vh;">
        <div class="w-100" style="max-width: 420px;">
            @include('partials.flash')
            @yield('content')
        </div>
    </div>
@endauth

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
