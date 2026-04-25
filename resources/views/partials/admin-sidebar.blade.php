<aside class="col-md-3 col-lg-2 sidebar-boba">
    <div class="small text-uppercase text-muted px-3 mb-2" style="letter-spacing:.1em; font-size:.7rem;">Admin Menu</div>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="bi bi-grid"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.company-structure') ? 'active' : '' }}" href="{{ route('admin.company-structure') }}"><i class="bi bi-diagram-3"></i> Struktur</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.sellers') ? 'active' : '' }}" href="{{ route('admin.sellers') }}"><i class="bi bi-shop"></i> Sellers</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.products') ? 'active' : '' }}" href="{{ route('admin.products') }}"><i class="bi bi-bag"></i> Produk</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.services') ? 'active' : '' }}" href="{{ route('admin.services') }}"><i class="bi bi-recycle"></i> Layanan</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}" href="{{ route('admin.reports') }}"><i class="bi bi-bar-chart"></i> Laporan</a></li>
    </ul>
</aside>
