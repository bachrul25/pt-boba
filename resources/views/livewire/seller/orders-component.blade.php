@section('page-title', 'Orders')
<div>
    <ul class="nav nav-pills mb-3">
        <li class="nav-item"><button class="nav-link @if($tab==='orders') active @endif" wire:click="setTab('orders')">Order Produk</button></li>
        <li class="nav-item"><button class="nav-link @if($tab==='requests') active @endif" wire:click="setTab('requests')">Service Request</button></li>
    </ul>

    @if($tab==='orders')
        <div class="card"><div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead><tr><th>#</th><th>Buyer</th><th>Item Saya</th><th>Subtotal</th><th>Status</th><th>Tanggal</th></tr></thead>
                <tbody>
                    @forelse($orders as $o)
                        <tr>
                            <td><code>{{ $o->order_number }}</code></td>
                            <td>{{ $o->buyer->name ?? '-' }}<br><small class="text-secondary">{{ $o->shipping_phone }}</small></td>
                            <td><small>
                                @foreach($o->items as $item)
                                    {{ $item->product_name }} × {{ $item->quantity }}<br>
                                @endforeach
                            </small></td>
                            <td>Rp {{ number_format($o->items->sum('subtotal'), 0, ',', '.') }}</td>
                            <td><span class="badge badge-soft-primary">{{ $o->status }}</span></td>
                            <td><small>{{ $o->created_at->diffForHumans() }}</small></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center small text-secondary py-3">Belum ada order untuk produk Anda.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div></div>
    @else
        <div class="card"><div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead><tr><th>#</th><th>Buyer</th><th>Layanan</th><th>Estimasi</th><th>Jadwal</th><th>Status</th></tr></thead>
                <tbody>
                    @forelse($requests as $r)
                        <tr>
                            <td><code>{{ $r->request_number }}</code></td>
                            <td>{{ $r->buyer->name ?? '-' }}<br><small>{{ $r->contact_phone }}</small></td>
                            <td>{{ $r->service->name ?? '-' }}</td>
                            <td>Rp {{ number_format($r->estimated_price, 0, ',', '.') }}</td>
                            <td>{{ optional($r->scheduled_at)->format('d M Y') ?? '-' }}</td>
                            <td><span class="badge badge-soft-warning">{{ $r->status }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center small text-secondary py-3">Belum ada permintaan layanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div></div>
    @endif
</div>
