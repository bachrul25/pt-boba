<div>
    <section class="hero py-5">
        <div class="container py-4 position-relative" style="z-index:2">
            <span class="badge bg-warning text-dark mb-2">Investor Relations</span>
            <h1 class="display-5 fw-bold">Investor Relations PT BOBA</h1>
            <p class="lead opacity-90 mb-0" style="max-width:760px">
                Halaman khusus bagi investor nasional dan internasional yang ingin memahami profil bisnis,
                potensi pertumbuhan, dan komitmen ESG PT Bikin Orang Bahagia.
            </p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="ecosystem-node h-100">
                        <i class="bi bi-building text-boba fs-2"></i>
                        <h4 class="fw-bold mt-2">Profil Singkat</h4>
                        <p class="text-secondary small mb-0">
                            PT BOBA adalah perusahaan multi-sektor yang menggabungkan industri tekstil,
                            fashion brand, dan layanan green technology dalam satu ekosistem terintegrasi.
                            Strategi kami: <strong>diversifikasi pendapatan + dampak ESG</strong>.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ecosystem-node h-100">
                        <i class="bi bi-graph-up-arrow text-success fs-2"></i>
                        <h4 class="fw-bold mt-2">Mengapa PT BOBA?</h4>
                        <ul class="small text-secondary mb-0">
                            <li>Tiga brand kuat di sektor berbeda &mdash; risiko terdiversifikasi.</li>
                            <li>Skalabilitas tinggi via marketplace digital.</li>
                            <li>Kepatuhan ESG melalui Ponpin (green tech).</li>
                            <li>Tim pendiri profesional dan fokus pada pertumbuhan jangka panjang.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-boba-light">
        <div class="container">
            <h2 class="section-title h3 mb-4">Key Metrics</h2>
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

    <section class="py-5">
        <div class="container">
            <h2 class="section-title h3 mb-4">Roadmap &amp; Milestones</h2>
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
    </section>

    <section class="py-5 bg-boba-light">
        <div class="container">
            <h2 class="section-title h3 mb-4">Company Documents</h2>
            <div class="row g-3">
                @forelse($documents as $d)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <span class="badge badge-soft-primary mb-2">{{ $d->category ?: 'General' }}</span>
                                <h6 class="fw-bold">{{ $d->title }}</h6>
                                <p class="small text-secondary">{{ $d->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-secondary">{{ $d->year }}</small>
                                    @if($d->file_url)
                                        <a href="{{ $d->file_url }}" target="_blank" class="btn btn-sm btn-outline-boba">Download</a>
                                    @else
                                        <span class="badge bg-light text-secondary">Coming Soon</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-secondary">Belum ada dokumen publik.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <h2 class="section-title h3">Hubungi Tim Investor Relations</h2>
                    <p class="text-secondary">
                        Kami terbuka untuk diskusi serius tentang investasi, kemitraan strategis,
                        dan kerja sama jangka panjang. Tim Investor Relations PT BOBA akan menghubungi Anda kembali.
                    </p>
                    <ul class="list-unstyled small">
                        <li class="mb-1"><i class="bi bi-envelope text-boba me-2"></i> investor@ptboba.co.id</li>
                        <li class="mb-1"><i class="bi bi-telephone text-boba me-2"></i> +62 812-0000-0000</li>
                    </ul>
                </div>
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            @if($submitted)
                                <div class="alert alert-success">
                                    <i class="bi bi-check-circle me-1"></i> Inquiry Anda telah kami terima. Tim Investor Relations akan menghubungi Anda.
                                </div>
                            @endif
                            <form wire:submit="submit" class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Nama *</label>
                                    <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Email *</label>
                                    <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Telepon</label>
                                    <input type="text" wire:model="phone" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Perusahaan</label>
                                    <input type="text" wire:model="company" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Negara</label>
                                    <input type="text" wire:model="country" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Range Investasi</label>
                                    <select wire:model="investment_range" class="form-select">
                                        <option value="">Pilih...</option>
                                        <option>< Rp 1 M</option>
                                        <option>Rp 1 M - 5 M</option>
                                        <option>Rp 5 M - 25 M</option>
                                        <option>Rp 25 M - 100 M</option>
                                        <option>> Rp 100 M</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Bidang Minat</label>
                                    <select wire:model="interest_area" class="form-select">
                                        <option value="">Pilih...</option>
                                        <option>Fashion (tsoecha.co / sokyuut)</option>
                                        <option>Green Technology (Ponpin)</option>
                                        <option>Holding PT BOBA</option>
                                        <option>Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Pesan *</label>
                                    <textarea wire:model="message" rows="5" class="form-control @error('message') is-invalid @enderror" placeholder="Ceritakan rencana investasi atau pertanyaan Anda..."></textarea>
                                    @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-boba"><i class="bi bi-send me-1"></i> Kirim Inquiry</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
