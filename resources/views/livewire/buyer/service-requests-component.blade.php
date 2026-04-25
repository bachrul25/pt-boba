@section('page-title', 'My Service Requests')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif

    <h5 class="fw-bold mb-3">Permintaan Layanan Ponpin</h5>

    @forelse($requests as $r)
        <div class="card mb-3"><div class="card-body">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <code>{{ $r->request_number }}</code>
                    <span class="badge badge-soft-warning ms-1">{{ $r->status }}</span>
                    <div class="fw-semibold mt-1">{{ $r->service->name ?? '-' }}</div>
                    <small class="text-secondary">Jadwal: {{ optional($r->scheduled_at)->format('d M Y') ?? 'belum ditentukan' }}</small>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-boba">Rp {{ number_format($r->estimated_price, 0, ',', '.') }}</div>
                    @if(in_array($r->status, ['pending','confirmed']))
                        <button wire:click="cancel({{ $r->id }})" wire:confirm="Batalkan permintaan?" class="btn btn-sm btn-outline-danger mt-1">Batalkan</button>
                    @endif
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
            Belum ada permintaan. <a href="{{ url('/buyer/services') }}">Pesan layanan Ponpin</a>.
        </div>
    @endforelse
</div>
