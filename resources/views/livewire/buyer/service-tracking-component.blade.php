<div class="container py-4">
    <h3 class="fw-bold mb-4"><i class="bi bi-geo-alt"></i> Tracking Layanan</h3>

    <div class="row g-3">
        @forelse($bookings as $b)
            <div class="col-md-6 col-lg-4">
                <div class="card-boba p-4 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <div class="small text-muted">#{{ $b->id }} · {{ $b->created_at->format('d M Y') }}</div>
                            <h6 class="fw-bold">{{ $b->service?->name }}</h6>
                        </div>
                        <span class="badge badge-soft-{{ match($b->booking_status){'completed'=>'success','processing'=>'info','cancelled'=>'danger',default=>'warning'} }}">{{ $b->booking_status }}</span>
                    </div>
                    <span class="badge badge-soft-success mb-2">{{ str_replace('_',' ', $b->service?->service_type) }}</span>
                    <p class="small text-muted">{{ \Illuminate\Support\Str::limit($b->requirement, 100) }}</p>
                    <div class="small mb-2"><i class="bi bi-shop"></i> Seller: <strong>{{ $b->seller?->name }}</strong></div>
                    <div class="small mb-3"><i class="bi bi-credit-card"></i> Payment: <span class="badge badge-soft-{{ $b->payment_status === 'success' ? 'success' : ($b->payment_status === 'failed' ? 'danger' : 'warning') }}">{{ $b->payment_status }}</span></div>

                    <div class="d-flex gap-2 mt-auto">
                        @if($b->booking_status === 'processing')
                            <button class="btn btn-sm btn-success" wire:click="complete({{ $b->id }})"><i class="bi bi-check-lg"></i> Selesai</button>
                            <button class="btn btn-sm btn-outline-danger" wire:click="cancel({{ $b->id }})" wire:confirm="Batalkan booking?">Batal</button>
                        @elseif($b->booking_status === 'completed')
                            <span class="badge bg-success w-100 py-2"><i class="bi bi-check-circle"></i> Layanan selesai</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <i class="bi bi-clipboard-x fs-1"></i>
                <p class="mt-2">Belum ada booking layanan.</p>
                <a href="{{ route('buyer.services') }}" class="btn btn-boba">Lihat Layanan</a>
            </div>
        @endforelse
    </div>
</div>
