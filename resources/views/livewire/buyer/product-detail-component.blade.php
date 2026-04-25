<div class="container py-4">
    <a href="{{ route('buyer.products') }}" class="text-muted small mb-3 d-inline-block"><i class="bi bi-arrow-left"></i> Kembali ke katalog</a>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card-boba p-3">
                <div class="product-img" style="height:400px; border-radius: 12px; @if($product->image) background-image:url('{{ asset('storage/'.$product->image) }}'); @endif">
                    @if(! $product->image) <i class="bi bi-image" style="font-size:5rem;"></i> @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-boba p-4 h-100">
                <div class="d-flex gap-2 mb-2">
                    <span class="badge badge-soft-info">{{ $product->brand }}</span>
                    <span class="badge badge-soft-secondary text-capitalize">{{ $product->gender_category }}</span>
                    <span class="badge badge-soft-success">{{ $product->category }}</span>
                </div>
                <h2 class="fw-bold">{{ $product->name }}</h2>
                <div class="fs-3 fw-bold text-success mb-3">Rp {{ number_format($product->price,0,',','.') }}</div>
                <p class="text-muted">{{ $product->description }}</p>
                <hr>
                <div class="d-flex gap-3 mb-3">
                    <div><span class="text-muted small">Stok</span><div class="fw-bold">{{ $product->stock }}</div></div>
                    <div><span class="text-muted small">Seller</span><div class="fw-bold">{{ $product->seller?->name }}</div></div>
                </div>
                <div class="d-flex gap-2 align-items-end">
                    <div style="max-width:120px;">
                        <label class="form-label small">Qty</label>
                        <input type="number" min="1" max="{{ $product->stock }}" wire:model="quantity" class="form-control">
                    </div>
                    <button wire:click="addToCart" class="btn btn-boba btn-lg flex-grow-1"><i class="bi bi-cart-plus"></i> Tambah ke Cart</button>
                </div>
                <a href="{{ route('buyer.cart') }}" class="btn btn-outline-success mt-2"><i class="bi bi-cart"></i> Lihat Cart</a>
            </div>
        </div>
    </div>
</div>
