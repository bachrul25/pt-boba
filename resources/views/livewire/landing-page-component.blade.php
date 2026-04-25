<div>
    {{-- HERO --}}
    <section id="home" class="hero py-5">
        <div class="container py-5 position-relative" style="z-index:2;">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill">
                        <i class="bi bi-stars me-1"></i> PT Bikin Orang Bahagia &mdash; PT BOBA
                    </span>
                    <h1 class="display-4 fw-bold mb-3">PT Bikin Orang Bahagia</h1>
                    <h2 class="h5 fw-light text-warning mb-3">
                        Industri Tekstil &middot; Produk Olahan &middot; Fashion Brand &middot; Green Technology
                    </h2>
                    <p class="lead opacity-90 mb-4">
                        PT BOBA menghadirkan produk fashion berkualitas melalui brand
                        <strong>tsoecha.co</strong> dan <strong>sokyuut</strong>,
                        serta layanan ramah lingkungan melalui <strong>Ponpin</strong>.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ url('/register') }}" class="btn btn-warning btn-lg fw-semibold">
                            <i class="bi bi-rocket-takeoff me-1"></i> Mulai Sekarang
                        </a>
                        <a href="#products" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-bag me-1"></i> Lihat Produk
                        </a>
                        <a href="#services" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-recycle me-1"></i> Lihat Layanan
                        </a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="bg-white text-dark rounded-4 shadow-lg p-4 p-lg-5">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="logo-pill" style="width:56px;height:56px;font-size:1.4rem;">B</span>
                            <div>
                                <div class="fw-bold text-boba">PT BOBA</div>
                                <small class="text-secondary">Industri Tekstil &amp; Green Tech</small>
                            </div>
                        </div>
                        <div class="row g-3 text-center">
                            <div class="col-6">
                                <div class="border rounded-3 p-3">
                                    <div class="stat-value">3</div>
                                    <small class="text-secondary">Brand Utama</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border rounded-3 p-3">
                                    <div class="stat-value">2</div>
                                    <small class="text-secondary">Sektor Bisnis</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="border rounded-3 p-3">
                                    <span class="esg-badge"><i class="bi bi-recycle"></i> ESG &amp; Green Technology Ready</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ABOUT --}}
    <section id="about" class="py-5">
        <div class="container py-4">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <span class="text-uppercase small fw-bold text-boba">Tentang Perusahaan</span>
                    <h2 class="section-title display-6 mb-3">Bikin Orang Bahagia Lewat Produk &amp; Lingkungan</h2>
                    <p class="section-subtitle">
                        PT Bikin Orang Bahagia (PT BOBA) adalah perusahaan yang bergerak di bidang
                        industri tekstil, produk olahan, fashion brand, dan layanan green technology.
                        PT BOBA menaungi brand fashion <strong>tsoecha.co</strong> dan <strong>sokyuut</strong>,
                        serta layanan keberlanjutan <strong>Ponpin</strong>.
                    </p>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="ecosystem-node h-100">
                                <i class="bi bi-eye text-boba fs-3"></i>
                                <h5 class="mt-2 mb-1 fw-bold">Visi</h5>
                                <p class="small text-secondary mb-0">
                                    Menjadi perusahaan terdepan di industri fashion dan green technology
                                    yang membahagiakan masyarakat dan menjaga keberlanjutan lingkungan.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ecosystem-node h-100">
                                <i class="bi bi-bullseye text-boba fs-3"></i>
                                <h5 class="mt-2 mb-1 fw-bold">Misi</h5>
                                <ul class="small text-secondary mb-0 ps-3">
                                    <li>Menghadirkan fashion berkualitas &amp; modern.</li>
                                    <li>Memberdayakan ekonomi kreatif lokal.</li>
                                    <li>Mengembangkan green technology berkelanjutan.</li>
                                    <li>Membangun ekosistem bisnis yang menguntungkan investor.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ecosystem-node h-100">
                                <i class="bi bi-heart text-boba fs-3"></i>
                                <h5 class="mt-2 mb-1 fw-bold">Nilai</h5>
                                <ul class="small text-secondary mb-0 ps-3">
                                    <li>Kualitas &amp; integritas.</li>
                                    <li>Keberlanjutan (sustainability).</li>
                                    <li>Inovasi berkelanjutan.</li>
                                    <li>Kebahagiaan pelanggan &amp; mitra.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- COMPANY HIGHLIGHT (Investor) --}}
    <section class="py-5 bg-boba-light">
        <div class="container py-3">
            <div class="text-center mb-4">
                <span class="text-uppercase small fw-bold text-boba">Company Highlight</span>
                <h2 class="section-title display-6 mb-2">Kekuatan PT BOBA</h2>
                <p class="section-subtitle mx-auto" style="max-width:720px">
                    Ringkasan kekuatan perusahaan dalam angka &mdash; potensi pertumbuhan jelas, ekosistem terintegrasi.
                </p>
            </div>
            <div class="row g-3">
                @foreach($metrics as $m)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="stat-card bg-white p-3 h-100 text-center">
                            <i class="bi {{ $m->icon ?: 'bi-graph-up' }} text-boba fs-3"></i>
                            <div class="stat-value mt-2">{{ $m->value }}</div>
                            <small class="text-secondary d-block">{{ $m->unit }}</small>
                            <div class="fw-semibold mt-1 small">{{ $m->name }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- BRANDS --}}
    <section id="brands" class="py-5">
        <div class="container py-3">
            <div class="text-center mb-4">
                <span class="text-uppercase small fw-bold text-boba">Brand Perusahaan</span>
                <h2 class="section-title display-6 mb-2">3 Brand Utama PT BOBA</h2>
                <p class="section-subtitle mx-auto" style="max-width:720px">
                    Fashion pria, fashion wanita, dan layanan green technology &mdash; dalam satu ekosistem.
                </p>
            </div>
            <div class="row g-4">
                @foreach($brands as $brand)
                    <div class="col-md-4">
                        <div class="brand-card card h-100 border-0 shadow-sm">
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="logo-pill" style="width:56px;height:56px;font-size:1.4rem;">
                                        @if(str_contains($brand->slug, 'tsoecha')) T
                                        @elseif(str_contains($brand->slug, 'sokyuut')) S
                                        @else P
                                        @endif
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-0">{{ $brand->name }}</h5>
                                        <small class="text-secondary">{{ $brand->category }}</small>
                                    </div>
                                </div>
                                <p class="text-secondary small flex-grow-1">{{ $brand->description }}</p>
                                @if($brand->type === 'service')
                                    <a href="#services" class="btn btn-outline-boba mt-2">
                                        <i class="bi bi-recycle me-1"></i> Pesan Layanan
                                    </a>
                                @else
                                    <a href="#products" class="btn btn-outline-boba mt-2">
                                        <i class="bi bi-bag me-1"></i> Lihat Produk
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PRODUCTS PREVIEW --}}
    <section id="products" class="py-5 bg-boba-light">
        <div class="container py-3">
            <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
                <div>
                    <span class="text-uppercase small fw-bold text-boba">Produk Fashion</span>
                    <h2 class="section-title h2 mb-0">Produk Pilihan tsoecha.co &amp; sokyuut</h2>
                </div>
                <a href="{{ url('/register') }}" class="btn btn-boba btn-sm"><i class="bi bi-bag me-1"></i> Belanja Sekarang</a>
            </div>
            <div class="row g-4">
                @forelse($fashionProducts as $p)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card product-card h-100 border-0 shadow-sm">
                            <div class="placeholder-img"><i class="bi bi-bag-heart"></i></div>
                            <div class="card-body p-3">
                                <small class="text-secondary text-uppercase">{{ $p->brand->name }}</small>
                                <div class="fw-semibold small mt-1" style="min-height:38px">{{ $p->name }}</div>
                                <div class="text-boba fw-bold mt-1">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12"><p class="text-center text-secondary">Belum ada produk.</p></div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- SERVICES (Ponpin) --}}
    <section id="services" class="py-5">
        <div class="container py-3">
            <div class="text-center mb-4">
                <span class="text-uppercase small fw-bold text-boba">Green Technology</span>
                <h2 class="section-title display-6 mb-2">Layanan Ponpin</h2>
                <p class="section-subtitle mx-auto" style="max-width:720px">
                    Holding company green technology PT BOBA &mdash; pengelolaan sampah &amp; konversi sampah organik menjadi bahan bakar kendaraan.
                </p>
            </div>
            <div class="row g-3">
                @foreach($services as $s)
                    <div class="col-md-6 col-lg-3">
                        <div class="ecosystem-node h-100">
                            <i class="bi bi-recycle text-success fs-3"></i>
                            <h6 class="fw-bold mt-2">{{ $s->name }}</h6>
                            <small class="esg-badge mb-2">{{ $s->category }}</small>
                            <p class="small text-secondary mt-2 mb-3">{{ $s->description }}</p>
                            <div class="fw-bold text-boba">Rp {{ number_format($s->price, 0, ',', '.') }} <small class="text-secondary fw-normal">/ {{ $s->unit }}</small></div>
                            <a href="{{ url('/register') }}" class="btn btn-sm btn-outline-boba mt-3 w-100">
                                <i class="bi bi-send me-1"></i> Pesan Layanan
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- STRUKTUR / FOUNDERS --}}
    <section id="struktur" class="py-5 bg-boba-light">
        <div class="container py-3">
            <div class="text-center mb-4">
                <span class="text-uppercase small fw-bold text-boba">Struktur Perusahaan</span>
                <h2 class="section-title display-6 mb-2">Pendiri PT BOBA</h2>
                <p class="section-subtitle">Tim profesional yang menggerakkan PT Bikin Orang Bahagia.</p>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($founders as $founder)
                    <div class="col-md-6 col-lg-4">
                        <div class="founder-card card h-100 border-0">
                            <div class="card-body p-4 text-center">
                                @if($founder->photo)
                                    <img src="{{ asset($founder->photo) }}" alt="{{ $founder->name }}" class="founder-photo mb-3">
                                @else
                                    <div class="founder-photo mx-auto mb-3 d-flex align-items-center justify-content-center" style="background:#e9eef5;color:#94a3b8;">
                                        <i class="bi bi-person-fill" style="font-size:3rem"></i>
                                    </div>
                                @endif
                                <h5 class="fw-bold mb-1">{{ $founder->name }}</h5>
                                <span class="badge badge-soft-primary mb-3">{{ $founder->position }}</span>
                                <p class="small text-secondary mb-0">{{ $founder->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- BUSINESS ECOSYSTEM --}}
    <section class="py-5">
        <div class="container py-3">
            <div class="text-center mb-4">
                <span class="text-uppercase small fw-bold text-boba">Business Ecosystem</span>
                <h2 class="section-title display-6 mb-2">Ekosistem Bisnis PT BOBA</h2>
            </div>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="ecosystem-node h-100 text-center">
                        <i class="bi bi-building text-boba fs-2"></i>
                        <h6 class="fw-bold mt-2">Holding</h6>
                        <p class="small text-secondary mb-0">PT Bikin Orang Bahagia</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ecosystem-node h-100 text-center">
                        <i class="bi bi-bag text-boba fs-2"></i>
                        <h6 class="fw-bold mt-2">tsoecha.co</h6>
                        <p class="small text-secondary mb-0">Fashion Pria — Tekstil &amp; Produk Olahan</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ecosystem-node h-100 text-center">
                        <i class="bi bi-handbag text-boba fs-2"></i>
                        <h6 class="fw-bold mt-2">sokyuut</h6>
                        <p class="small text-secondary mb-0">Fashion Wanita — Tekstil &amp; Aksesoris</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ecosystem-node h-100 text-center">
                        <i class="bi bi-recycle text-success fs-2"></i>
                        <h6 class="fw-bold mt-2">Ponpin</h6>
                        <p class="small text-secondary mb-0">Green Technology — Pengelolaan &amp; Konversi Sampah</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- INVESTMENT OPPORTUNITY --}}
    <section class="py-5 bg-boba text-white">
        <div class="container py-3">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge bg-warning text-dark mb-2">Investment Opportunity</span>
                    <h2 class="display-6 fw-bold">Peluang Investasi PT BOBA</h2>
                    <p class="opacity-90">
                        PT BOBA membuka peluang kerja sama strategis bagi investor nasional dan internasional.
                        Dengan ekosistem fashion + green technology yang terintegrasi, PT BOBA memiliki
                        potensi pertumbuhan tinggi di pasar lokal maupun ekspor.
                    </p>
                    <ul class="list-unstyled small">
                        <li><i class="bi bi-check-circle-fill text-warning me-2"></i> Diversifikasi pendapatan: fashion + jasa lingkungan.</li>
                        <li><i class="bi bi-check-circle-fill text-warning me-2"></i> Komitmen ESG &amp; ekonomi sirkular melalui Ponpin.</li>
                        <li><i class="bi bi-check-circle-fill text-warning me-2"></i> Skalabilitas tinggi melalui marketplace digital.</li>
                        <li><i class="bi bi-check-circle-fill text-warning me-2"></i> Tim pendiri berpengalaman lintas sektor.</li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <div class="bg-white text-dark p-4 rounded-4 shadow">
                        <h5 class="fw-bold text-boba mb-3"><i class="bi bi-briefcase me-1"></i> Tertarik Berinvestasi?</h5>
                        <p class="small text-secondary">Akses Investor Relations untuk profil lengkap, pitch deck, dan jadwal pertemuan.</p>
                        <a href="{{ url('/investor-relations') }}" class="btn btn-boba w-100">
                            <i class="bi bi-graph-up-arrow me-1"></i> Buka Investor Relations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SUSTAINABILITY / ESG --}}
    <section class="py-5">
        <div class="container py-3">
            <div class="text-center mb-4">
                <span class="esg-badge"><i class="bi bi-leaf"></i> Sustainability &amp; ESG</span>
                <h2 class="section-title display-6 mt-2">Komitmen Hijau Lewat Ponpin</h2>
                <p class="section-subtitle mx-auto" style="max-width:760px">
                    Ponpin adalah holding green technology PT BOBA yang berkomitmen pada ekonomi sirkular &mdash;
                    mengubah sampah menjadi nilai ekonomi sekaligus melindungi lingkungan.
                </p>
            </div>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="ecosystem-node h-100 text-center">
                        <i class="bi bi-trash text-success fs-2"></i>
                        <h6 class="fw-bold mt-2">Pengambilan Sampah</h6>
                        <p class="small text-secondary mb-0">Layanan jemput sampah rumah tangga &amp; korporat.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ecosystem-node h-100 text-center">
                        <i class="bi bi-gear text-success fs-2"></i>
                        <h6 class="fw-bold mt-2">Pengelolaan Sampah</h6>
                        <p class="small text-secondary mb-0">Pemilahan, pengelolaan, dan pendampingan zero waste.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ecosystem-node h-100 text-center">
                        <i class="bi bi-flower3 text-success fs-2"></i>
                        <h6 class="fw-bold mt-2">Pengolahan Organik</h6>
                        <p class="small text-secondary mb-0">Konversi sampah organik menjadi kompos &amp; pupuk.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ecosystem-node h-100 text-center">
                        <i class="bi bi-fuel-pump text-success fs-2"></i>
                        <h6 class="fw-bold mt-2">Bahan Bakar Hijau</h6>
                        <p class="small text-secondary mb-0">Sampah organik menjadi bahan bakar kendaraan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- VISION FOR GROWTH --}}
    <section class="py-5 bg-boba-light">
        <div class="container py-3">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <span class="text-uppercase small fw-bold text-boba">Vision for Growth</span>
                    <h2 class="section-title display-6">Visi Pertumbuhan Perusahaan</h2>
                    <p class="section-subtitle">
                        Roadmap PT BOBA: memperluas penetrasi marketplace, ekspansi brand fashion ke pasar
                        Asia Tenggara, dan memperbesar dampak ESG Ponpin di skala kota dan regional.
                    </p>
                    <a href="{{ url('/investor-relations') }}" class="btn btn-boba">
                        <i class="bi bi-rocket me-1"></i> Lihat Roadmap Investor
                    </a>
                </div>
                <div class="col-lg-7">
                    <div class="timeline ms-2">
                        @foreach($milestones as $m)
                            <div class="timeline-item">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span class="badge badge-soft-primary">{{ $m->year }}{{ $m->month ? ' · '.$m->month : '' }}</span>
                                    <h6 class="fw-bold mb-0">{{ $m->title }}</h6>
                                </div>
                                <p class="small text-secondary mb-0">{{ $m->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- PARTNER / SELLER --}}
    <section id="partner" class="py-5">
        <div class="container py-3">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <span class="text-uppercase small fw-bold text-boba">Partner / Seller</span>
                    <h2 class="section-title display-6">Bergabung sebagai Mitra Penjual</h2>
                    <p class="section-subtitle">
                        Daftarkan toko Anda sebagai seller resmi tsoecha.co, sokyuut, atau partner Ponpin.
                        Nikmati ekosistem marketplace PT BOBA, manajemen produk &amp; layanan terpusat,
                        serta dukungan branding profesional.
                    </p>
                    <a href="{{ url('/register/seller') }}" class="btn btn-boba">
                        <i class="bi bi-shop me-1"></i> Daftar sebagai Seller
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="ecosystem-node h-100 text-center">
                                <i class="bi bi-shield-check text-boba fs-3"></i>
                                <h6 class="fw-bold mt-2">Brand Resmi</h6>
                                <small class="text-secondary">Verifikasi internal PT BOBA</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="ecosystem-node h-100 text-center">
                                <i class="bi bi-graph-up text-boba fs-3"></i>
                                <h6 class="fw-bold mt-2">Akses Pasar</h6>
                                <small class="text-secondary">Marketplace + buyer terverifikasi</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="ecosystem-node h-100 text-center">
                                <i class="bi bi-headset text-boba fs-3"></i>
                                <h6 class="fw-bold mt-2">Support</h6>
                                <small class="text-secondary">Operasional &amp; logistik</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="ecosystem-node h-100 text-center">
                                <i class="bi bi-cash-coin text-boba fs-3"></i>
                                <h6 class="fw-bold mt-2">Pembayaran</h6>
                                <small class="text-secondary">Transparansi transaksi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CONTACT --}}
    <section id="contact" class="py-5 bg-boba-light">
        <div class="container py-3">
            <div class="row g-5 align-items-start">
                <div class="col-lg-5">
                    <span class="text-uppercase small fw-bold text-boba">Kontak</span>
                    <h2 class="section-title display-6">Hubungi PT BOBA</h2>
                    <p class="section-subtitle">
                        Untuk pertanyaan kerja sama, kemitraan, atau informasi umum,
                        silakan kirim pesan melalui form di samping atau kontak langsung.
                    </p>
                    <ul class="list-unstyled small">
                        <li class="mb-1"><i class="bi bi-geo-alt text-boba me-2"></i> Surabaya, Indonesia</li>
                        <li class="mb-1"><i class="bi bi-envelope text-boba me-2"></i> hello@ptboba.co.id</li>
                        <li class="mb-1"><i class="bi bi-telephone text-boba me-2"></i> +62 812-0000-0000</li>
                    </ul>
                </div>
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            @if($contactSent)
                                <div class="alert alert-success">
                                    <i class="bi bi-check-circle me-1"></i> Terima kasih! Pesan Anda telah kami terima.
                                </div>
                            @endif
                            <form wire:submit="submitContact" class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Nama</label>
                                    <input type="text" wire:model="contactName" class="form-control @error('contactName') is-invalid @enderror" placeholder="Nama lengkap">
                                    @error('contactName') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Email</label>
                                    <input type="email" wire:model="contactEmail" class="form-control @error('contactEmail') is-invalid @enderror" placeholder="email@domain.com">
                                    @error('contactEmail') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Pesan</label>
                                    <textarea wire:model="contactMessage" class="form-control @error('contactMessage') is-invalid @enderror" rows="5" placeholder="Tuliskan pesan Anda..."></textarea>
                                    @error('contactMessage') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-boba">
                                        <i class="bi bi-send me-1"></i> Kirim Pesan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
