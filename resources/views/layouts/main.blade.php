<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('albums.index') }}">Albums</a>
                    </li>
                    @can('viewAny', App\Models\Invoice::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('invoices.index') }}">Invoices</a>
                        </li>
                    @endcan
                    @if (Auth::check())
                        <li class="nav-item">
                            <a href="{{ route('profile.index') }}" class="nav-link">Profile</a>
                        </li>
                        <li>
                            <form method="post" action="{{ route('auth.logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('registration.index') }}" class="nav-link">Register</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('auth.loginForm') }}" class="nav-link">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-9">
                <header>
                    <h2>@yield('title')</h2>
                </header>
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>
