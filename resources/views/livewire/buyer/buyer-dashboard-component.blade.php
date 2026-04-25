<div class="container py-4">
    <div class="d-flex align-items-center gap-3 mb-4">
        <span class="logo-pill logo-pill-lg">B</span>
        <div>
            <h3 class="fw-bold mb-1">Selamat datang, {{ auth()->user()->name }}</h3>
            <p class="text-muted mb-0">Belanja fashion &amp; pesan layanan tos2bro.</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        @php
            $cards = [
                ['label'=>'Item di Cart','val'=>$stats['cart'],'icon'=>'cart','color'=>'success','route'=>'buyer.cart'],
                ['label'=>'Total Order','val'=>$stats['orders'],'icon'=>'bag-check','color'=>'info','route'=>null],
                ['label'=>'Total Booking','val'=>$stats['bookings'],'icon'=>'calendar-check','color'=>'warning','route'=>'buyer.service.tracking'],
                ['label'=>'Total Belanja','val'=>'Rp '.number_format($stats['spent'],0,',','.'),'icon'=>'wallet','color'=>'primary','route'=>null],
            ];
        @endphp
        @foreach($cards as $c)
            <div class="col-md-6 col-lg-3">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small text-uppercase">{{ $c['label'] }}</div>
                            <div class="stat-num text-{{ $c['color'] }}">{{ is_numeric($c['val']) ? number_format($c['val']) : $c['val'] }}</div>
                        </div>
                        <i class="bi bi-{{ $c['icon'] }} fs-3 text-{{ $c['color'] }}"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('buyer.products') }}" class="card-boba p-4 text-decoration-none text-dark d-block h-100">
                <i class="bi bi-bag-fill fs-2 text-success"></i>
                <h6 class="fw-bold mt-2">View Products</h6>
                <p class="text-muted small mb-0">tsoecha.co &amp; sokyuut</p>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('buyer.services') }}" class="card-boba p-4 text-decoration-none text-dark d-block h-100">
                <i class="bi bi-recycle fs-2 text-warning"></i>
                <h6 class="fw-bold mt-2">View Services</h6>
                <p class="text-muted small mb-0">Layanan tos2bro</p>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('buyer.cart') }}" class="card-boba p-4 text-decoration-none text-dark d-block h-100">
                <i class="bi bi-cart fs-2 text-primary"></i>
                <h6 class="fw-bold mt-2">Cart</h6>
                <p class="text-muted small mb-0">Keranjang belanja</p>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('buyer.service.tracking') }}" class="card-boba p-4 text-decoration-none text-dark d-block h-100">
                <i class="bi bi-geo-alt fs-2 text-danger"></i>
                <h6 class="fw-bold mt-2">Tracking Service</h6>
                <p class="text-muted small mb-0">Pantau status booking</p>
            </a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card-boba p-3">
                <h6 class="fw-bold mb-3">Riwayat Order</h6>
                <div class="table-responsive"><table class="table table-sm align-middle">
                    <thead><tr><th>#</th><th>Total</th><th>Payment</th><th>Order</th></tr></thead>
                    <tbody>
                        @forelse($recentOrders as $o)
                            <tr>
                                <td>#{{ $o->id }}</td>
                                <td>Rp {{ number_format($o->total_price,0,',','.') }}</td>
                                <td><span class="badge badge-soft-{{ $o->payment_status === 'success' ? 'success' : ($o->payment_status === 'failed' ? 'danger' : 'warning') }}">{{ $o->payment_status }}</span></td>
                                <td><span class="badge badge-soft-info">{{ $o->order_status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted">Belum ada order.</td></tr>
                        @endforelse
                    </tbody>
                </table></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-boba p-3">
                <h6 class="fw-bold mb-3">Booking Layanan</h6>
                <div class="table-responsive"><table class="table table-sm align-middle">
                    <thead><tr><th>#</th><th>Service</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($recentBookings as $b)
                            <tr>
                                <td>#{{ $b->id }}</td>
                                <td>{{ $b->service?->name }}</td>
                                <td><span class="badge badge-soft-{{ $b->booking_status === 'completed' ? 'success' : 'warning' }}">{{ $b->booking_status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted">Belum ada booking.</td></tr>
                        @endforelse
                    </tbody>
                </table></div>
            </div>
        </div>
    </div>
</div>
