<div class="container py-5">
    <div class="text-center mb-5">
        <span class="logo-pill logo-pill-lg mb-3">B</span>
        <h1 class="section-title mt-3">Selamat Datang di PT BOBA</h1>
        <p class="text-muted">Pilih peran Anda untuk melanjutkan ke marketplace &amp; layanan green technology.</p>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card-boba h-100 p-4 p-md-5 text-center">
                <div class="mb-3">
                    <i class="bi bi-cart-check-fill text-success" style="font-size:3rem;"></i>
                </div>
                <h3 class="fw-bold">Buyer</h3>
                <p class="text-muted">Beli produk fashion dari <strong>tsoecha.co</strong> &amp; <strong>sokyuut</strong>, atau pesan layanan green technology dari <strong>tos2bro</strong>.</p>
                <div class="d-grid gap-2 mt-3">
                    <a href="{{ route('login') }}" class="btn btn-boba btn-lg"><i class="bi bi-box-arrow-in-right me-1"></i> Login Buyer</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg"><i class="bi bi-person-plus me-1"></i> Register Buyer</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-5">
            <div class="card-boba h-100 p-4 p-md-5 text-center">
                <div class="mb-3">
                    <i class="bi bi-shop text-warning" style="font-size:3rem;"></i>
                </div>
                <h3 class="fw-bold">Seller</h3>
                <p class="text-muted">Kelola produk fashion atau layanan green technology Anda sebagai mitra PT BOBA. Jangkau lebih banyak pelanggan hari ini.</p>
                <div class="d-grid gap-2 mt-3">
                    <a href="{{ route('login') }}" class="btn btn-boba-accent btn-lg"><i class="bi bi-box-arrow-in-right me-1"></i> Login Seller</a>
                    <a href="{{ route('seller.register') }}" class="btn btn-outline-warning btn-lg"><i class="bi bi-shop-window me-1"></i> Register Seller</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('landing') }}" class="text-muted small"><i class="bi bi-arrow-left"></i> Kembali ke Company Profile</a>
    </div>
</div>
