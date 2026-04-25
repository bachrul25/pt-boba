<div class="py-5 bg-boba-light">
    <div class="container py-4">
        <div class="text-center mb-4">
            <h2 class="section-title">Daftar di PT BOBA</h2>
            <p class="text-secondary">Pilih peran Anda untuk melanjutkan registrasi.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-5">
                <div class="card brand-card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <i class="bi bi-bag-heart text-boba" style="font-size:3rem"></i>
                        <h4 class="fw-bold mt-2">Buyer</h4>
                        <p class="text-secondary small">Belanja produk fashion tsoecha.co &amp; sokyuut, atau pesan layanan green technology Ponpin.</p>
                        <a href="{{ url('/register/buyer') }}" class="btn btn-boba w-100"><i class="bi bi-person-plus me-1"></i> Daftar sebagai Buyer</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card brand-card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <i class="bi bi-shop text-boba" style="font-size:3rem"></i>
                        <h4 class="fw-bold mt-2">Seller</h4>
                        <p class="text-secondary small">Jadi mitra penjual resmi PT BOBA dan kelola produk fashion atau layanan green tech Anda.</p>
                        <a href="{{ url('/register/seller') }}" class="btn btn-outline-boba w-100"><i class="bi bi-shop-window me-1"></i> Daftar sebagai Seller</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4 small">
            Sudah punya akun? <a href="{{ url('/login') }}" class="fw-semibold">Login di sini</a>
        </div>
    </div>
</div>
