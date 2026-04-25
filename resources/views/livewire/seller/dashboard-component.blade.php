@section('page-title', 'Seller Dashboard')
<div>
    <div class="row g-3 mb-4">
        @php
            $cards = [
                ['Produk Saya', $totalProducts, 'bi-bag', 'badge-soft-primary', '/seller/products'],
                ['Layanan Saya', $totalServices, 'bi-tools', 'badge-soft-success', '/seller/services'],
                ['Order Masuk', $totalOrders, 'bi-receipt', 'badge-soft-warning', '/seller/orders'],
                ['Service Request', $totalRequests, 'bi-clipboard-check', 'badge-soft-primary', '/seller/orders'],
            ];
        @endphp
        @foreach($cards as [$label,$value,$icon,$badge,$url])
            <div class="col-md-3">
                <div class="card stat-mini h-100"><div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <small class="text-secondary text-uppercase">{{ $label }}</small>
                        <span class="badge {{ $badge }}"><i class="bi {{ $icon }}"></i></span>
                    </div>
                    <div class="stat-value mt-2">{{ $value }}</div>
                    <a href="{{ url($url) }}" class="small">Kelola</a>
                </div></div>
            </div>
        @endforeach
    </div>

    <div class="card"><div class="card-body">
        <h6 class="fw-bold mb-3">Order Terbaru (produk Anda)</h6>
        <div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead><tr><th>#</th><th>Buyer</th><th>Item</th><th>Status</th><th>Tanggal</th></tr></thead>
                <tbody>
                    @forelse($recentOrders as $o)
                        <tr>
                            <td><code>{{ $o->order_number }}</code></td>
                            <td>{{ $o->buyer->name ?? '-' }}</td>
                            <td><small>{{ $o->items->pluck('product_name')->implode(', ') }}</small></td>
                            <td><span class="badge badge-soft-primary">{{ $o->status }}</span></td>
                            <td><small>{{ $o->created_at->diffForHumans() }}</small></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-secondary small py-3">Belum ada order.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div></div>
</div>
