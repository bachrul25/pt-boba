@section('page-title', 'My Service Requests')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger py-2">{{ session('error') }}</div>@endif

    <h5 class="fw-bold mb-3">Permintaan Green Services</h5>

    @forelse($requests as $r)
        <div class="card mb-3"><div class="card-body">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <code>{{ $r->request_number }}</code>
                    <span class="badge badge-soft-warning ms-1">{{ $r->status }}</span>
                    @if($r->payment_status)
                        @php $pay = strtoupper($r->payment_status); @endphp
                        <span class="badge ms-1 {{ $pay === 'PAID' ? 'bg-success' : ($pay === 'EXPIRED' || $pay === 'FAILED' ? 'bg-danger' : 'bg-warning text-dark') }}">
                            <i class="bi bi-credit-card-2-front me-1"></i>{{ $pay }}
                        </span>
                    @endif
                    <div class="fw-semibold mt-1">{{ $r->service->name ?? '-' }}</div>
                    <small class="text-secondary">Jadwal: {{ optional($r->scheduled_at)->format('d M Y') ?? 'belum ditentukan' }}</small>
                    @if($r->paid_at)
                        <div class="small text-success"><i class="bi bi-check-circle me-1"></i>Lunas {{ $r->paid_at->format('d M Y H:i') }}</div>
                    @endif
                </div>
                <div class="text-end">
                    <div class="fw-bold text-boba">Rp {{ number_format($r->estimated_price, 0, ',', '.') }}</div>
                    <div class="d-flex flex-wrap gap-1 justify-content-end mt-1">
                        @if($r->status !== 'cancelled' && (float) $r->estimated_price > 0 && strtoupper($r->payment_status ?? '') !== 'PAID')
                            <button wire:click="pay({{ $r->id }})" wire:loading.attr="disabled" class="btn btn-sm btn-success">
                                <i class="bi bi-credit-card-2-front me-1"></i>
                                <span wire:loading.remove wire:target="pay({{ $r->id }})">{{ $r->payment_url ? 'Lanjutkan Pembayaran' : 'Bayar Sekarang' }}</span>
                                <span wire:loading wire:target="pay({{ $r->id }})">Memuat…</span>
                            </button>
                        @endif
                        @if(in_array($r->status, ['pending','confirmed']))
                            <button wire:click="cancel({{ $r->id }})" wire:confirm="Batalkan permintaan?" class="btn btn-sm btn-outline-danger">Batalkan</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-light p-2 rounded small mt-2">
                <i class="bi bi-geo-alt text-boba"></i> {{ $r->address }} · {{ $r->contact_phone }}
                @if($r->notes)<br><i class="bi bi-chat-left-text text-boba"></i> {{ $r->notes }}@endif
            </div>
        </div></div>
    @empty
        <div class="text-center py-5 text-secondary">
            <i class="bi bi-clipboard-x display-3 d-block mb-2"></i>
            Belum ada permintaan. <a href="{{ url('/buyer/services') }}">Pesan Green Services</a>.
        </div>
    @endforelse
</div>
