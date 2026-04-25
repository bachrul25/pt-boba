@php
    $user = auth()->user();
    $logoPath = 'images/logo-boba.png';
    $hasLogo = file_exists(public_path($logoPath));
@endphp
<nav class="navbar navbar-expand-lg navbar-boba sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            @if($hasLogo)
                <img src="{{ asset($logoPath) }}" alt="PT BOBA" style="height:40px;">
            @else
                <span class="logo-pill">B</span>
            @endif
            <span class="fw-bold">PT BOBA</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            @if(! $user)
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#brands">Brand</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#products">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#struktur">Struktur</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#partner">Partner</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#contact">Contact</a></li>
                </ul>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-success">Login</a>
                    <a href="{{ route('home') }}" class="btn btn-boba">Register</a>
                </div>
            @else
                <ul class="navbar-nav me-auto">
                    @if($user->role === 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.company-structure') }}">Struktur</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.sellers') }}">Sellers</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.products') }}">Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.services') }}">Layanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.reports') }}">Laporan</a></li>
                    @elseif($user->role === 'buyer')
                        <li class="nav-item"><a class="nav-link" href="{{ route('buyer.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('buyer.products') }}">Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('buyer.services') }}">Layanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('buyer.cart') }}"><i class="bi bi-cart"></i> Cart</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('buyer.service.tracking') }}">Tracking</a></li>
                    @elseif($user->role === 'seller')
                        <li class="nav-item"><a class="nav-link" href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('seller.profile') }}">Profil Toko</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('seller.products') }}">Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('seller.services') }}">Layanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('seller.reports') }}">Laporan</a></li>
                    @endif
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small"><i class="bi bi-person-circle"></i> {{ $user->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">@csrf
                        <button class="btn btn-outline-danger btn-sm" type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</nav>
