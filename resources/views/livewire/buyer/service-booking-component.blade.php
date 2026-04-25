<div class="container py-4">
    <a href="{{ route('buyer.services') }}" class="text-muted small mb-3 d-inline-block"><i class="bi bi-arrow-left"></i> Kembali ke layanan</a>
    <h3 class="fw-bold mb-4"><i class="bi bi-calendar-plus"></i> Booking Layanan</h3>

    @if($lastBookingId && $lastPaymentStatus === 'success')
        <div class="alert alert-success">Booking #{{ $lastBookingId }} berhasil! Status: processing. <a href="{{ route('buyer.service.tracking') }}">Lihat tracking</a></div>
    @endif
    @if($lastBookingId && $lastPaymentStatus === 'failed')
        <div class="alert alert-danger d-flex justify-content-between align-items-center">
            <div>Pembayaran Booking #{{ $lastBookingId }} gagal.</div>
            <button class="btn btn-sm btn-warning" wire:click="retryPayment"><i class="bi bi-arrow-repeat"></i> Retry Payment</button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card-boba p-4">
                <span class="badge badge-soft-success mb-2">{{ str_replace('_',' ', $service->service_type) }}</span>
                <h4 class="fw-bold">{{ $service->name }}</h4>
                <p class="text-muted">{{ $service->description }}</p>
                <div class="d-flex gap-3 mb-2">
                    <div><span class="text-muted small">Seller</span><div class="fw-bold">{{ $service->seller?->name }}</div></div>
                    <div><span class="text-muted small">Brand</span><div class="fw-bold">{{ $service->brand }}</div></div>
                </div>
                <div class="fs-3 fw-bold text-success">Rp {{ number_format($service->price,0,',','.') }}</div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-boba p-4">
                <h5 class="fw-bold mb-3">Form Booking</h5>
                <form wire:submit="book">
                    <div class="mb-3">
                        <label class="form-label small">Kebutuhan / Requirement</label>
                        <textarea wire:model="requirement" class="form-control @error('requirement') is-invalid @enderror" rows="4" placeholder="Jelaskan kebutuhan layanan Anda (lokasi, volume, jadwal, dll)"></textarea>
                        @error('requirement') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Metode Pembayaran</label>
                        <select wire:model="payment_method" class="form-select">
                            <option>Transfer Bank</option>
                            <option>E-Wallet</option>
                            <option>COD</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Simulasi Pembayaran</label>
                        <select wire:model="payment_outcome" class="form-select">
                            <option value="success">Success</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-boba w-100 btn-lg"><i class="bi bi-check-lg"></i> Book &amp; Bayar Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>
