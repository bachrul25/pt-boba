@section('page-title', 'Buyer Dashboard')
<div>
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card stat-mini h-100"><div class="card-body">
                <small class="text-secondary text-uppercase">Total Order</small>
                <div class="stat-value">{{ $totalOrders }}</div>
                <a href="{{ url('/buyer/orders') }}" class="small">Lihat order saya</a>
            </div></div>
        </div>
        <div class="col-md-4">
            <div class="card stat-mini h-100"><div class="card-body">
                <small class="text-secondary text-uppercase">Service Request</small>
                <div class="stat-value">{{ $totalRequests }}</div>
                <a href="{{ url('/buyer/service-requests') }}" class="small">Lihat permintaan</a>
            </div></div>
        </div>
        <div class="col-md-4">
            <div class="card stat-mini h-100"><div class="card-body bg-boba text-white rounded">
                <small class="text-uppercase opacity-75">Aksi Cepat</small>
                <div class="d-flex flex-column gap-2 mt-2">
                    <a href="{{ url('/buyer/browse') }}" class="btn btn-warning btn-sm"><i class="bi bi-bag me-1"></i> Belanja Fashion</a>
                    <a href="{{ url('/buyer/services') }}" class="btn btn-outline-light btn-sm"><i class="bi bi-recycle me-1"></i> Pesan Layanan Ponpin</a>
                </div>
            </div></div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card h-100"><div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">Produk Pilihan</h6>
                    <a href="{{ url('/buyer/browse') }}" class="small">Lihat semua</a>
                </div>
                <div class="row g-3">
                    @foreach($featuredProducts as $p)
                        <div class="col-md-4 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="placeholder-img"><i class="bi bi-bag-heart"></i></div>
                                <div class="card-body p-3">
                                    <small class="text-secondary">{{ $p->brand->name }}</small>
                                    <div class="fw-semibold small">{{ $p->name }}</div>
                                    <div class="text-boba fw-bold mt-1">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div></div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100"><div class="card-body">
                <h6 class="fw-bold mb-3">Layanan Ponpin</h6>
                @foreach($featuredServices as $s)
                    <div class="border rounded p-2 mb-2">
                        <div class="fw-semibold small"><i class="bi bi-recycle text-success me-1"></i> {{ $s->name }}</div>
                        <small class="text-secondary">{{ $s->category }}</small>
                        <div class="fw-bold text-boba small mt-1">Rp {{ number_format($s->price, 0, ',', '.') }}/{{ $s->unit }}</div>
                    </div>
                @endforeach
                <a href="{{ url('/buyer/services') }}" class="btn btn-outline-boba btn-sm w-100"><i class="bi bi-send me-1"></i> Pesan Layanan</a>
            </div></div>
        </div>
    </div>
</div>
