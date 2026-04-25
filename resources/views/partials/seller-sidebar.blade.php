<aside class="col-md-3 col-lg-2 sidebar-boba">
    <div class="small text-uppercase text-muted px-3 mb-2" style="letter-spacing:.1em; font-size:.7rem;">Seller Menu</div>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}" href="{{ route('seller.dashboard') }}"><i class="bi bi-grid"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('seller.profile') ? 'active' : '' }}" href="{{ route('seller.profile') }}"><i class="bi bi-shop-window"></i> Profil Toko</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('seller.products') ? 'active' : '' }}" href="{{ route('seller.products') }}"><i class="bi bi-bag"></i> Produk</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('seller.services') ? 'active' : '' }}" href="{{ route('seller.services') }}"><i class="bi bi-recycle"></i> Layanan</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('seller.reports') ? 'active' : '' }}" href="{{ route('seller.reports') }}"><i class="bi bi-bar-chart"></i> Laporan</a></li>
    </ul>
</aside>
