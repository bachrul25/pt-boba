@section('page-title', 'Transactions')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif

    <ul class="nav nav-pills mb-3">
        <li class="nav-item"><button class="nav-link @if($tab==='orders') active @endif" wire:click="setTab('orders')">Order Produk</button></li>
        <li class="nav-item"><button class="nav-link @if($tab==='requests') active @endif" wire:click="setTab('requests')">Green Services Request</button></li>
    </ul>

    @if($tab==='orders')
        <div class="card"><div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead><tr><th>#</th><th>Buyer</th><th>Item</th><th>Total</th><th>Status</th><th>Pembayaran</th><th>Tanggal</th><th></th></tr></thead>
                <tbody>
                    @forelse($orders as $o)
                        <tr>
                            <td><code>{{ $o->order_number }}</code></td>
                            <td>{{ $o->buyer->name ?? '-' }}</td>
                            <td><small>{{ $o->items->count() }} produk</small></td>
                            <td>Rp {{ number_format($o->total, 0, ',', '.') }}</td>
                            <td><span class="badge badge-soft-primary">{{ $o->status }}</span></td>
                            <td>
                                @if($o->payment_status)
                                    @php $pay = strtoupper($o->payment_status); @endphp
                                    <span class="badge {{ $pay === 'PAID' ? 'bg-success' : ($pay === 'EXPIRED' || $pay === 'FAILED' ? 'bg-danger' : 'bg-warning text-dark') }}">{{ $pay }}</span>
                                    @if($o->payment_invoice_id)
                                        <div class="small text-secondary mt-1" style="font-family:monospace;font-size:.7rem;">{{ Str::limit($o->payment_invoice_id, 12, '…') }}</div>
                                    @endif
                                    @if($o->paid_at)
                                        <div class="small text-success">{{ $o->paid_at->format('d M H:i') }}</div>
                                    @endif
                                @else
                                    <span class="text-secondary small">—</span>
                                @endif
                            </td>
                            <td><small>{{ $o->created_at->diffForHumans() }}</small></td>
                            <td class="text-end">
                                <select onchange="$wire.updateOrderStatus({{ $o->id }}, this.value)" class="form-select form-select-sm">
                                    <option>Ubah status</option>
                                    @foreach(['pending','paid','processing','shipped','completed','cancelled'] as $st)
                                        <option value="{{ $st }}">{{ $st }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-secondary small py-3">Belum ada order.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div></div>
    @else
        <div class="card"><div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead><tr><th>#</th><th>Buyer</th><th>Layanan</th><th>Estimasi</th><th>Jadwal</th><th>Status</th><th>Pembayaran</th><th></th></tr></thead>
                <tbody>
                    @forelse($requests as $r)
                        <tr>
                            <td><code>{{ $r->request_number }}</code></td>
                            <td>{{ $r->buyer->name ?? '-' }}<br><small>{{ $r->contact_phone }}</small></td>
                            <td>{{ $r->service->name ?? '-' }}</td>
                            <td>Rp {{ number_format($r->estimated_price, 0, ',', '.') }}</td>
                            <td>{{ optional($r->scheduled_at)->format('d M Y') ?? '—' }}</td>
                            <td><span class="badge badge-soft-warning">{{ $r->status }}</span></td>
                            <td>
                                @if($r->payment_status)
                                    @php $pay = strtoupper($r->payment_status); @endphp
                                    <span class="badge {{ $pay === 'PAID' ? 'bg-success' : ($pay === 'EXPIRED' || $pay === 'FAILED' ? 'bg-danger' : 'bg-warning text-dark') }}">{{ $pay }}</span>
                                    @if($r->payment_invoice_id)
                                        <div class="small text-secondary mt-1" style="font-family:monospace;font-size:.7rem;">{{ Str::limit($r->payment_invoice_id, 12, '…') }}</div>
                                    @endif
                                    @if($r->paid_at)
                                        <div class="small text-success">{{ $r->paid_at->format('d M H:i') }}</div>
                                    @endif
                                @else
                                    <span class="text-secondary small">—</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <select onchange="$wire.updateRequestStatus({{ $r->id }}, this.value)" class="form-select form-select-sm">
                                    <option>Ubah status</option>
                                    @foreach(['pending','confirmed','in_progress','completed','cancelled'] as $st)
                                        <option value="{{ $st }}">{{ $st }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-secondary small py-3">Belum ada service request.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div></div>
    @endif
</div>
