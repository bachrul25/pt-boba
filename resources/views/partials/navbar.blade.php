<nav class="navbar navbar-expand-lg navbar-boba sticky-top py-2">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-boba.png') }}" alt="PT BOBA" class="logo-pill">
            <span class="text-boba">PT BOBA</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#brands">Brand</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#products">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#struktur">Struktur</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#partner">Partner</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#contact">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/investor-relations') }}">Investor</a></li>
                @auth
                    <li class="nav-item ms-lg-2">
                        @php $u = auth()->user(); @endphp
                        <a class="btn btn-outline-boba btn-sm" href="{{ url('/dashboard') }}">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item ms-lg-1">
                        <form method="POST" action="{{ url('/logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link text-decoration-none nav-link p-0 px-2">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-outline-boba btn-sm" href="{{ url('/login') }}">Login</a>
                    </li>
                    <li class="nav-item ms-lg-1">
                        <a class="btn btn-boba btn-sm" href="{{ url('/register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
