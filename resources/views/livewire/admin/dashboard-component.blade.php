@section('page-title', 'Admin Dashboard')
<div>
    <div class="row g-3 mb-4">
        @php
            $cards = [
                ['Buyer', $totalBuyers, 'bi-people', 'badge-soft-primary'],
                ['Seller', $totalSellers, 'bi-shop', 'badge-soft-success'],
                ['Brand', $totalBrands, 'bi-stars', 'badge-soft-warning'],
                ['Produk', $totalProducts, 'bi-bag', 'badge-soft-primary'],
                ['Layanan', $totalServices, 'bi-tools', 'badge-soft-success'],
                ['Order', $totalOrders, 'bi-receipt', 'badge-soft-warning'],
                ['Service Request', $totalServiceRequests, 'bi-clipboard-check', 'badge-soft-primary'],
                ['Investor Inquiry', $totalInvestorInquiries, 'bi-envelope-paper', 'badge-soft-success'],
            ];
        @endphp
        @foreach($cards as [$label,$value,$icon,$badge])
            <div class="col-6 col-md-3 col-xl-3">
                <div class="card stat-mini h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <small class="text-secondary text-uppercase">{{ $label }}</small>
                            <span class="badge {{ $badge }}"><i class="bi {{ $icon }}"></i></span>
                        </div>
                        <div class="stat-value mt-2">{{ $value }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-3">
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">Order Terbaru</h6>
                        <a href="{{ url('/admin/orders') }}" class="small">Lihat semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead><tr><th>#</th><th>Buyer</th><th>Total</th><th>Status</th><th>Tanggal</th></tr></thead>
                            <tbody>
                                @forelse($recentOrders as $o)
                                    <tr>
                                        <td><code>{{ $o->order_number }}</code></td>
                                        <td>{{ $o->buyer->name ?? '-' }}</td>
                                        <td>Rp {{ number_format($o->total, 0, ',', '.') }}</td>
                                        <td><span class="badge badge-soft-primary">{{ $o->status }}</span></td>
                                        <td>{{ $o->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-secondary small">Belum ada order.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">Investor Inquiry Terbaru</h6>
                        <a href="{{ url('/admin/investor-inquiries') }}" class="small">Lihat semua</a>
                    </div>
                    @forelse($recentInquiries as $i)
                        <div class="border rounded-3 p-2 mb-2">
                            <div class="d-flex justify-content-between">
                                <strong class="small">{{ $i->name }}</strong>
                                <span class="badge badge-soft-warning">{{ $i->status }}</span>
                            </div>
                            <small class="text-secondary">{{ $i->email }} · {{ $i->interest_area ?: 'General' }}</small>
                            <p class="small mb-0 mt-1">{{ \Illuminate\Support\Str::limit($i->message, 90) }}</p>
                        </div>
                    @empty
                        <p class="text-secondary small">Belum ada inquiry.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
