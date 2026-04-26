<footer class="pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <img src="{{ asset('images/logo-boba.png') }}" alt="PT BOBA" class="logo-pill">
                    <span class="fw-bold text-white">PT Bikin Orang Bahagia</span>
                </div>
                <p class="small">PT BOBA — industri tekstil, fashion brand, dan layanan green technology yang menghadirkan kebahagiaan dan keberlanjutan.</p>
                <div class="d-flex gap-2 mt-3">
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin fs-5"></i></a>
                    <a href="#" aria-label="X"><i class="bi bi-twitter-x fs-5"></i></a>
                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube fs-5"></i></a>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <h6 class="text-white text-uppercase small fw-bold">Perusahaan</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ url('/') }}#about">Tentang</a></li>
                    <li><a href="{{ url('/') }}#struktur">Struktur</a></li>
                    <li><a href="{{ url('/investor-relations') }}">Investor Relations</a></li>
                    <li><a href="{{ url('/') }}#contact">Kontak</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2">
                <h6 class="text-white text-uppercase small fw-bold">Brand</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ url('/') }}#brands">tsoecha.co</a></li>
                    <li><a href="{{ url('/') }}#brands">sokyuut</a></li>
                    <li><a href="{{ url('/') }}#brands">Ponpin</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="text-white text-uppercase small fw-bold">Kontak</h6>
                <ul class="list-unstyled small">
                    <li><i class="bi bi-geo-alt me-1"></i> Surabaya, Indonesia</li>
                    <li><i class="bi bi-envelope me-1"></i> hello@ptboba.co.id</li>
                    <li><i class="bi bi-telephone me-1"></i> +62 812-0000-0000</li>
                </ul>
            </div>
        </div>
        <hr class="border-secondary mt-4">
        <div class="d-flex flex-column flex-md-row justify-content-between small">
            <span>&copy; {{ date('Y') }} PT Bikin Orang Bahagia. All rights reserved.</span>
            <span>Dibuat untuk masyarakat dan investor — Bikin Orang Bahagia.</span>
        </div>
    </div>
</footer>
