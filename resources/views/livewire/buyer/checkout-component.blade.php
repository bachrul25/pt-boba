<div class="container py-4">
    <h3 class="fw-bold mb-4"><i class="bi bi-bag-check"></i> Checkout</h3>

    @if($lastOrderId && $lastPaymentStatus === 'success')
        <div class="alert alert-success">Order #{{ $lastOrderId }} berhasil dibuat dan sedang diproses. <a href="{{ route('buyer.dashboard') }}">Kembali ke Dashboard</a></div>
    @endif

    @if($lastOrderId && $lastPaymentStatus === 'failed')
        <div class="alert alert-danger d-flex justify-content-between align-items-center">
            <div>Pembayaran Order #{{ $lastOrderId }} gagal. Silakan coba lagi.</div>
            <button class="btn btn-sm btn-warning" wire:click="retryPayment"><i class="bi bi-arrow-repeat"></i> Retry Payment</button>
        </div>
    @endif

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card-boba p-4 mb-3">
                <h5 class="fw-bold mb-3">Alamat Pengiriman</h5>
                <textarea wire:model="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" rows="3" placeholder="Alamat lengkap untuk pengiriman"></textarea>
                @error('shipping_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="card-boba p-4 mb-3">
                <h5 class="fw-bold mb-3">Metode Pembayaran</h5>
                @foreach(['Transfer Bank','E-Wallet','COD'] as $m)
                    <label class="form-check d-flex align-items-center gap-2 mb-2 p-3 border rounded-3">
                        <input type="radio" wire:model="payment_method" value="{{ $m }}" class="form-check-input m-0">
                        <span class="ms-2">{{ $m }}</span>
                    </label>
                @endforeach
            </div>

            <div class="card-boba p-4">
                <h5 class="fw-bold mb-3">Simulasi Pembayaran</h5>
                <p class="small text-muted">Pilih hasil simulasi pembayaran. Di production ini terhubung ke payment gateway.</p>
                <select wire:model="payment_outcome" class="form-select">
                    <option value="success">Success</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-boba p-4 sticky-top" style="top:80px;">
                <h5 class="fw-bold mb-3">Ringkasan Order</h5>
                @foreach($items as $item)
                    <div class="d-flex justify-content-between small py-1">
                        <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                        <span>Rp {{ number_format($item->subtotal,0,',','.') }}</span>
                    </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between mb-3"><span class="fw-bold">Total</span><span class="fw-bold text-success fs-5">Rp {{ number_format($total,0,',','.') }}</span></div>
                <button wire:click="placeOrder" class="btn btn-boba w-100 btn-lg @if($items->isEmpty()) disabled @endif"><i class="bi bi-credit-card"></i> Bayar Sekarang</button>
            </div>
        </div>
    </div>
</div>
