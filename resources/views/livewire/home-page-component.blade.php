<div>
    <section class="hero py-5">
        <div class="container py-4 position-relative" style="z-index:2">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill">PT BOBA Marketplace</span>
                    <h1 class="display-5 fw-bold">Selamat Datang di Marketplace PT BOBA</h1>
                    <p class="lead opacity-90">
                        Temukan produk fashion <strong>tsoecha.co</strong> &amp; <strong>sokyuut</strong>,
                        atau pesan layanan green technology dari <strong>Ponpin</strong>.
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white text-dark rounded-4 shadow p-4">
                        <h6 class="fw-bold text-boba mb-3"><i class="bi bi-person-circle me-1"></i> Pilih Peran Anda</h6>
                        <div class="d-grid gap-2">
                            <a href="{{ url('/register/buyer') }}" class="btn btn-boba">
                                <i class="bi bi-bag-heart me-1"></i> Daftar sebagai Buyer
                            </a>
                            <a href="{{ url('/register/seller') }}" class="btn btn-outline-boba">
                                <i class="bi bi-shop me-1"></i> Daftar sebagai Seller
                            </a>
                            <a href="{{ url('/login') }}" class="btn btn-link text-decoration-none">
                                Sudah punya akun? Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-title h2">Brand Resmi PT BOBA</h2>
            </div>
            <div class="row g-3">
                @foreach($brands as $brand)
                    <div class="col-md-4">
                        <div class="brand-card card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <h5 class="fw-bold">{{ $brand->name }}</h5>
                                <small class="badge badge-soft-primary">{{ $brand->category }}</small>
                                <p class="small text-secondary mt-2">{{ $brand->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5 bg-boba-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-3 flex-wrap gap-2">
                <h2 class="section-title h3 mb-0">Produk Pilihan</h2>
                <a href="{{ url('/register/buyer') }}" class="btn btn-sm btn-boba">Belanja Sekarang</a>
            </div>
            <div class="row g-3">
                @foreach($products as $p)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card h-100 border-0 shadow-sm">
                            <div class="placeholder-img"><i class="bi bi-bag-heart"></i></div>
                            <div class="card-body p-3">
                                <small class="text-secondary text-uppercase">{{ $p->brand->name }}</small>
                                <div class="fw-semibold small mt-1">{{ $p->name }}</div>
                                <div class="text-boba fw-bold mt-1">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="section-title h3 mb-3">Layanan Green Technology Ponpin</h2>
            <div class="row g-3">
                @foreach($services as $s)
                    <div class="col-md-6 col-lg-3">
                        <div class="ecosystem-node h-100">
                            <i class="bi bi-recycle text-success fs-3"></i>
                            <h6 class="fw-bold mt-2">{{ $s->name }}</h6>
                            <p class="small text-secondary">{{ $s->description }}</p>
                            <div class="fw-bold text-boba">Rp {{ number_format($s->price, 0, ',', '.') }} <small class="text-secondary fw-normal">/ {{ $s->unit }}</small></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
