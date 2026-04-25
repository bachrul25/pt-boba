@section('page-title', 'Browse Products')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif
    @error('cart')<div class="alert alert-warning py-2">{{ $message }}</div>@enderror

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card mb-3"><div class="card-body py-3">
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <input wire:model.live.debounce.300ms="search" class="form-control form-control-sm" style="max-width:280px" placeholder="Cari produk...">
                    <select wire:model.live="brand_id" class="form-select form-select-sm" style="max-width:200px">
                        <option value="">Semua Brand</option>
                        @foreach($brands as $b)<option value="{{ $b->id }}">{{ $b->name }}</option>@endforeach
                    </select>
                </div>
            </div></div>

            <div class="row g-3">
                @forelse($products as $p)
                    <div class="col-md-4 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm product-card">
                            <div class="placeholder-img"><i class="bi bi-bag-heart"></i></div>
                            <div class="card-body p-3 d-flex flex-column">
                                <small class="text-secondary">{{ $p->brand->name }}</small>
                                <div class="fw-semibold small" style="min-height:38px">{{ $p->name }}</div>
                                <div class="text-boba fw-bold mt-1">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                                <button wire:click="addToCart({{ $p->id }})" class="btn btn-sm btn-boba mt-2">
                                    <i class="bi bi-cart-plus me-1"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12"><p class="text-secondary text-center py-4">Tidak ada produk.</p></div>
                @endforelse
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card position-sticky" style="top:90px">
                <div class="card-body">
                    <h6 class="fw-bold"><i class="bi bi-cart3 me-1"></i> Keranjang Belanja</h6>
                    @if(empty($cart))
                        <p class="text-secondary small mb-0">Keranjang masih kosong.</p>
                    @else
                        @foreach($cart as $item)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div>
                                    <div class="small fw-semibold">{{ $item['name'] }}</div>
                                    <small class="text-secondary">Rp {{ number_format($item['price'], 0, ',', '.') }} × {{ $item['qty'] }}</small>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <button wire:click="decrement({{ $item['product_id'] }})" class="btn btn-sm btn-outline-secondary py-0">-</button>
                                    <span class="small">{{ $item['qty'] }}</span>
                                    <button wire:click="increment({{ $item['product_id'] }})" class="btn btn-sm btn-outline-secondary py-0">+</button>
                                    <button wire:click="removeFromCart({{ $item['product_id'] }})" class="btn btn-sm btn-link text-danger py-0">×</button>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <strong>Total</strong>
                            <strong class="text-boba">Rp {{ number_format($this->cartTotal, 0, ',', '.') }}</strong>
                        </div>
                        @if(! $checkoutOpen)
                            <button wire:click="startCheckout" class="btn btn-boba w-100 mt-3"><i class="bi bi-bag-check me-1"></i> Checkout</button>
                        @endif
                    @endif

                    @if($checkoutOpen)
                        <hr>
                        <form wire:submit="placeOrder" class="d-flex flex-column gap-2">
                            <div>
                                <label class="form-label small fw-semibold">Alamat Pengiriman *</label>
                                <textarea wire:model="shipping_address" rows="2" class="form-control form-control-sm @error('shipping_address') is-invalid @enderror"></textarea>
                                @error('shipping_address')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div>
                                <label class="form-label small fw-semibold">Telepon *</label>
                                <input wire:model="shipping_phone" class="form-control form-control-sm @error('shipping_phone') is-invalid @enderror">
                                @error('shipping_phone')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div>
                                <label class="form-label small fw-semibold">Catatan</label>
                                <textarea wire:model="notes" rows="2" class="form-control form-control-sm"></textarea>
                            </div>
                            <button class="btn btn-boba"><i class="bi bi-check2-circle me-1"></i> Konfirmasi Order</button>
                            <button type="button" wire:click="$set('checkoutOpen', false)" class="btn btn-outline-secondary btn-sm">Batal</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
