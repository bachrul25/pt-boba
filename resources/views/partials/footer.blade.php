@php
    $logoPath = 'images/logo-boba.png';
    $hasLogo = file_exists(public_path($logoPath));
@endphp
<footer class="boba-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    @if($hasLogo)
                        <img src="{{ asset($logoPath) }}" alt="PT BOBA" style="height:40px;">
                    @else
                        <span class="logo-pill">B</span>
                    @endif
                    <div>
                        <div class="fw-bold text-white">PT Bikin Orang Bahagia</div>
                        <div class="small text-secondary">PT BOBA</div>
                    </div>
                </div>
                <p class="small text-secondary">Industri tekstil, produk olahan, fashion brand (tsoecha.co & sokyuut), dan layanan green technology (tos2bro) dalam satu ekosistem.</p>
            </div>
            <div class="col-md-2">
                <h6 class="text-white mb-3">Navigasi</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ url('/') }}#about">About</a></li>
                    <li><a href="{{ url('/') }}#brands">Brand</a></li>
                    <li><a href="{{ url('/') }}#products">Products</a></li>
                    <li><a href="{{ url('/') }}#services">Services</a></li>
                    <li><a href="{{ url('/') }}#contact">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="text-white mb-3">Struktur Perusahaan</h6>
                <ul class="list-unstyled small text-secondary">
                    <li><span class="fw-semibold text-light">Direktur:</span> Bachrul Ullum Assrori</li>
                    <li><span class="fw-semibold text-light">Komisaris Utama:</span> Ario Putra Bakti</li>
                    <li><span class="fw-semibold text-light">Komisaris:</span> Ellen Sinta Budirahayu</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="text-white mb-3">Sosial Media</h6>
                <div class="d-flex gap-2">
                    <a href="#"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#"><i class="bi bi-tiktok fs-5"></i></a>
                    <a href="#"><i class="bi bi-linkedin fs-5"></i></a>
                    <a href="#"><i class="bi bi-whatsapp fs-5"></i></a>
                </div>
                <p class="small text-secondary mt-3">Email: hello@ptboba.co.id<br>WA: +62 812-0000-0000</p>
            </div>
        </div>
        <hr class="border-secondary my-4">
        <div class="d-flex justify-content-between small text-secondary flex-column flex-md-row gap-2">
            <span>&copy; {{ date('Y') }} PT Bikin Orang Bahagia. Semua hak cipta dilindungi.</span>
            <span>Made with <i class="bi bi-heart-fill text-danger"></i> for a greener future.</span>
        </div>
    </div>
</footer>
