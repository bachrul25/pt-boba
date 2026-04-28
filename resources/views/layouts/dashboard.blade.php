<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard PT BOBA')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --boba-primary: #166152;
            --boba-secondary: #f5b400;
            --boba-accent: #2dbf95;
            --boba-dark: #0c3f36;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f5f7fb; }
        .sidebar {
            min-height: 100vh; width: 260px; background: var(--boba-dark); color: #cbd5e1;
            position: sticky; top: 0;
        }
        .sidebar a { color: #cbd5e1; text-decoration: none; }
        .sidebar a:hover, .sidebar a.active {
            background: rgba(255,255,255,.06); color: #fff;
        }
        .sidebar .nav-link { padding: .65rem 1rem; border-radius: 8px; }
        .sidebar .brand { color: #fff; }
        .topbar { background: #fff; border-bottom: 1px solid #e5e7eb; }
        .card { border: 1px solid #eef2f7; border-radius: 12px; }
        .stat-mini { border-radius: 12px; }
        .table thead th { background: #f8fafc; font-weight: 600; }
        .badge-soft-primary { background: rgba(22,97,82,.14); color: #0c3f36; }
        .badge-soft-success { background: rgba(34,197,94,.1); color: #16a34a; }
        .badge-soft-warning { background: rgba(245,180,0,.18); color: #92400e; }
        .badge-soft-danger { background: rgba(239,68,68,.1); color: #dc2626; }
        .btn-boba { background: var(--boba-primary); color:#fff; border:none; }
        .btn-boba:hover { background: var(--boba-dark); color:#fff; }
        .logo-pill {
            display: inline-flex; align-items: center; justify-content: center;
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(135deg, var(--boba-primary), var(--boba-accent));
            color:#fff; font-weight:700;
        }
    </style>
    @livewireStyles
    @stack('head')
</head>
<body>
    @php $u = auth()->user(); @endphp
    <div class="d-flex">
        <aside class="sidebar p-3 d-none d-lg-flex flex-column">
            <div class="d-flex align-items-center gap-2 mb-4 px-1">
                <img src="{{ asset('images/logo-boba.png') }}" alt="PT BOBA" class="logo-pill">
                <div>
                    <div class="brand fw-bold">PT BOBA</div>
                    <small class="text-secondary">{{ ucfirst($u->role) }} Panel</small>
                </div>
            </div>

            <nav class="nav flex-column gap-1 small">
                @if($u->isAdmin())
                    <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ url('/admin') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                    <a class="nav-link {{ request()->is('admin/founders*') ? 'active' : '' }}" href="{{ url('/admin/founders') }}"><i class="bi bi-people me-2"></i>Founders</a>
                    <a class="nav-link {{ request()->is('admin/brands*') ? 'active' : '' }}" href="{{ url('/admin/brands') }}"><i class="bi bi-stars me-2"></i>Brands</a>
                    <a class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}" href="{{ url('/admin/products') }}"><i class="bi bi-bag me-2"></i>Products</a>
                    <a class="nav-link {{ request()->is('admin/services*') ? 'active' : '' }}" href="{{ url('/admin/services') }}"><i class="bi bi-tools me-2"></i>Services (Ponpin)</a>
                    <a class="nav-link {{ request()->is('admin/sellers*') ? 'active' : '' }}" href="{{ url('/admin/sellers') }}"><i class="bi bi-shop me-2"></i>Sellers</a>
                    <a class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}" href="{{ url('/admin/orders') }}"><i class="bi bi-receipt me-2"></i>Transactions</a>
                    <hr class="border-secondary">
                    <small class="text-secondary px-2 mb-1">INVESTOR</small>
                    <a class="nav-link {{ request()->is('admin/investor-inquiries*') ? 'active' : '' }}" href="{{ url('/admin/investor-inquiries') }}"><i class="bi bi-envelope-paper me-2"></i>Investor Inquiries</a>
                    <a class="nav-link {{ request()->is('admin/documents*') ? 'active' : '' }}" href="{{ url('/admin/documents') }}"><i class="bi bi-folder me-2"></i>Company Documents</a>
                    <a class="nav-link {{ request()->is('admin/milestones*') ? 'active' : '' }}" href="{{ url('/admin/milestones') }}"><i class="bi bi-flag me-2"></i>Milestones</a>
                    <a class="nav-link {{ request()->is('admin/impact-metrics*') ? 'active' : '' }}" href="{{ url('/admin/impact-metrics') }}"><i class="bi bi-bar-chart me-2"></i>Impact Metrics</a>
                    <hr class="border-secondary">
                    <small class="text-secondary px-2 mb-1">STRATEGI</small>
                    <a class="nav-link {{ request()->is('admin/bmc*') ? 'active' : '' }}" href="{{ url('/admin/bmc') }}"><i class="bi bi-grid-3x3-gap me-2"></i>Business Model Canvas</a>
                @elseif($u->isSeller())
                    <a class="nav-link {{ request()->is('seller') ? 'active' : '' }}" href="{{ url('/seller') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                    <a class="nav-link {{ request()->is('seller/products*') ? 'active' : '' }}" href="{{ url('/seller/products') }}"><i class="bi bi-bag me-2"></i>My Products</a>
                    <a class="nav-link {{ request()->is('seller/services*') ? 'active' : '' }}" href="{{ url('/seller/services') }}"><i class="bi bi-tools me-2"></i>My Services</a>
                    <a class="nav-link {{ request()->is('seller/orders*') ? 'active' : '' }}" href="{{ url('/seller/orders') }}"><i class="bi bi-receipt me-2"></i>Orders</a>
                @else
                    <a class="nav-link {{ request()->is('buyer') ? 'active' : '' }}" href="{{ url('/buyer') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                    <a class="nav-link {{ request()->is('buyer/browse*') ? 'active' : '' }}" href="{{ url('/buyer/browse') }}"><i class="bi bi-shop me-2"></i>Browse Products</a>
                    <a class="nav-link {{ request()->is('buyer/services*') ? 'active' : '' }}" href="{{ url('/buyer/services') }}"><i class="bi bi-recycle me-2"></i>Pesan Layanan</a>
                    <a class="nav-link {{ request()->is('buyer/orders*') ? 'active' : '' }}" href="{{ url('/buyer/orders') }}"><i class="bi bi-receipt me-2"></i>My Orders</a>
                    <a class="nav-link {{ request()->is('buyer/service-requests*') ? 'active' : '' }}" href="{{ url('/buyer/service-requests') }}"><i class="bi bi-clipboard-check me-2"></i>My Service Requests</a>
                @endif
                <hr class="border-secondary">
                <a class="nav-link" href="{{ url('/') }}"><i class="bi bi-house me-2"></i>Public Site</a>
            </nav>
        </aside>

        <div class="flex-grow-1 d-flex flex-column">
            <header class="topbar px-4 py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 fw-bold text-boba">@yield('page-title', 'Dashboard')</h6>
                    <small class="text-secondary">Selamat datang, {{ $u->name }}</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge badge-soft-primary text-uppercase">{{ $u->role }}</span>
                    <form method="POST" action="{{ url('/logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </form>
                </div>
            </header>

            <div class="p-4 flex-grow-1">
                {{ $slot ?? '' }}
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
    @stack('scripts')
</body>
</html>
