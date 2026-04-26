@section('page-title', 'My Orders')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger py-2">{{ session('error') }}</div>@endif

    <h5 class="fw-bold mb-3">Riwayat Order Produk</h5>

    @forelse($orders as $o)
        <div class="card mb-3"><div class="card-body">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <code>{{ $o->order_number }}</code>
                    <span class="badge badge-soft-primary ms-1">{{ $o->status }}</span>
                    @if($o->payment_status)
                        @php $pay = strtoupper($o->payment_status); @endphp
                        <span class="badge ms-1 {{ $pay === 'PAID' ? 'bg-success' : ($pay === 'EXPIRED' || $pay === 'FAILED' ? 'bg-danger' : 'bg-warning text-dark') }}">
                            <i class="bi bi-credit-card-2-front me-1"></i>{{ $pay }}
                        </span>
                    @endif
                    <div class="small text-secondary mt-1">{{ $o->created_at->format('d M Y H:i') }}</div>
                    @if($o->paid_at)
                        <div class="small text-success"><i class="bi bi-check-circle me-1"></i>Lunas {{ $o->paid_at->format('d M Y H:i') }}</div>
                    @endif
                </div>
                <div class="text-end">
                    <div class="fw-bold text-boba">Rp {{ number_format($o->total, 0, ',', '.') }}</div>
                    <div class="d-flex flex-wrap gap-1 justify-content-end mt-1">
                        @if($o->status !== 'cancelled' && strtoupper($o->payment_status ?? '') !== 'PAID')
                            <button wire:click="pay({{ $o->id }})" wire:loading.attr="disabled" class="btn btn-sm btn-success">
                                <i class="bi bi-credit-card-2-front me-1"></i>
                                <span wire:loading.remove wire:target="pay({{ $o->id }})">{{ $o->payment_url ? 'Lanjutkan Pembayaran' : 'Bayar Sekarang' }}</span>
                                <span wire:loading wire:target="pay({{ $o->id }})">Memuat…</span>
                            </button>
                        @endif
                        @if(in_array($o->status, ['pending','paid']))
                            <button wire:click="cancel({{ $o->id }})" wire:confirm="Batalkan order?" class="btn btn-sm btn-outline-danger">Batalkan</button>
                        @endif
                    </div>
                </div>
            </div>
            <hr class="my-2">
            <ul class="list-unstyled small mb-0">
                @foreach($o->items as $item)
                    <li class="d-flex justify-content-between">
                        <span>{{ $item->product_name }} × {{ $item->quantity }}</span>
                        <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
            @if($o->shipping_address)
                <div class="bg-light p-2 rounded small mt-2">
                    <i class="bi bi-geo-alt text-boba"></i> {{ $o->shipping_address }} · {{ $o->shipping_phone }}
                </div>
            @endif
        </div></div>
    @empty
        <div class="text-center py-5 text-secondary">
            <i class="bi bi-bag display-3 d-block mb-2"></i>
            Belum ada order. <a href="{{ url('/buyer/browse') }}">Mulai belanja</a>.
        </div>
    @endforelse
</div>
