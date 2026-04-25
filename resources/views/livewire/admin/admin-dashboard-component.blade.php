<div class="container-fluid">
    <div class="row g-0">
        @include('partials.admin-sidebar')
        <main class="col-md-9 col-lg-10 p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h3 class="fw-bold mb-1">Admin Dashboard</h3>
                    <p class="text-muted mb-0">Halo {{ auth()->user()->name }}, berikut ringkasan operasional PT BOBA.</p>
                </div>
                <span class="badge bg-dark fs-6"><i class="bi bi-shield-check"></i> Admin</span>
            </div>

            <div class="row g-3 mb-4">
                @php
                    $cards = [
                        ['label'=>'Total Seller','val'=>$stats['sellers'],'icon'=>'shop','color'=>'warning'],
                        ['label'=>'Total Buyer','val'=>$stats['buyers'],'icon'=>'people','color'=>'success'],
                        ['label'=>'Total Produk','val'=>$stats['products'],'icon'=>'bag','color'=>'info'],
                        ['label'=>'Total Layanan','val'=>$stats['services'],'icon'=>'recycle','color'=>'primary'],
                        ['label'=>'Struktur Aktif','val'=>$stats['founders'],'icon'=>'diagram-3','color'=>'secondary'],
                        ['label'=>'Order Produk','val'=>$stats['orders'],'icon'=>'cart-check','color'=>'info'],
                        ['label'=>'Booking Layanan','val'=>$stats['bookings'],'icon'=>'calendar-check','color'=>'warning'],
                        ['label'=>'Pembayaran Sukses','val'=>$stats['payments_success'],'icon'=>'credit-card','color'=>'success'],
                    ];
                @endphp
                @foreach($cards as $c)
                    <div class="col-md-6 col-lg-3">
                        <div class="stat-card h-100">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-muted small text-uppercase" style="letter-spacing:.05em;">{{ $c['label'] }}</div>
                                    <div class="stat-num text-{{ $c['color'] }}">{{ number_format($c['val']) }}</div>
                                </div>
                                <i class="bi bi-{{ $c['icon'] }} fs-3 text-{{ $c['color'] }}"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small text-uppercase">Total Pendapatan</div>
                                <div class="stat-num text-success">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</div>
                            </div>
                            <i class="bi bi-coin fs-1 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-lg-6">
                    <div class="card-boba p-3 h-100">
                        <h6 class="fw-bold mb-3"><i class="bi bi-cart-check"></i> Order Produk Terbaru</h6>
                        <div class="table-responsive"><table class="table table-sm align-middle">
                            <thead><tr><th>#</th><th>Buyer</th><th>Total</th><th>Status</th></tr></thead>
                            <tbody>
                                @forelse($recentOrders as $o)
                                    <tr>
                                        <td>#{{ $o->id }}</td>
                                        <td>{{ $o->buyer?->name }}</td>
                                        <td>Rp {{ number_format($o->total_price,0,',','.') }}</td>
                                        <td><span class="badge badge-soft-{{ match($o->order_status){'completed'=>'success','processing'=>'info','cancelled'=>'danger',default=>'warning'} }}">{{ $o->order_status }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted small">Belum ada order.</td></tr>
                                @endforelse
                            </tbody>
                        </table></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-boba p-3 h-100">
                        <h6 class="fw-bold mb-3"><i class="bi bi-calendar-check"></i> Booking Layanan Terbaru</h6>
                        <div class="table-responsive"><table class="table table-sm align-middle">
                            <thead><tr><th>#</th><th>Buyer</th><th>Service</th><th>Status</th></tr></thead>
                            <tbody>
                                @forelse($recentBookings as $b)
                                    <tr>
                                        <td>#{{ $b->id }}</td>
                                        <td>{{ $b->buyer?->name }}</td>
                                        <td>{{ $b->service?->name }}</td>
                                        <td><span class="badge badge-soft-{{ match($b->booking_status){'completed'=>'success','processing'=>'info','cancelled'=>'danger',default=>'warning'} }}">{{ $b->booking_status }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted small">Belum ada booking.</td></tr>
                                @endforelse
                            </tbody>
                        </table></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
