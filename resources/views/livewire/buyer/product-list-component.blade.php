<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold mb-0">Katalog Produk</h3>
        <a href="{{ route('buyer.cart') }}" class="btn btn-outline-success"><i class="bi bi-cart"></i> Lihat Cart</a>
    </div>

    <div class="card-boba p-3 mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input wire:model.live.debounce.400ms="search" class="form-control" placeholder="Cari produk...">
            </div>
            <div class="col-md-3">
                <select wire:model.live="brand" class="form-select">
                    <option value="">Semua Brand</option>
                    <option value="tsoecha.co">tsoecha.co</option>
                    <option value="sokyuut">sokyuut</option>
                </select>
            </div>
            <div class="col-md-3">
                <select wire:model.live="gender" class="form-select">
                    <option value="">Semua Gender</option>
                    <option value="pria">Pria</option>
                    <option value="wanita">Wanita</option>
                </select>
            </div>
            <div class="col-md-2">
                <input wire:model.live.debounce.400ms="category" class="form-control" placeholder="Kategori...">
            </div>
        </div>
    </div>

    <div class="row g-4">
        @forelse($products as $p)
            <div class="col-md-6 col-lg-4">
                <div class="card-boba h-100">
                    <div class="product-img" @if($p->image) style="background-image:url('{{ asset('storage/'.$p->image) }}')" @endif>
                        @if(! $p->image) <i class="bi bi-image"></i> @endif
                    </div>
                    <div class="p-3">
                        <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                            <h6 class="fw-bold mb-0">{{ $p->name }}</h6>
                            <span class="badge badge-soft-info">{{ $p->brand }}</span>
                        </div>
                        <div class="small text-muted mb-2"><i class="bi bi-tag"></i> {{ $p->category }} · <span class="text-capitalize">{{ $p->gender_category }}</span></div>
                        <div class="small text-muted mb-2"><i class="bi bi-shop"></i> {{ $p->seller?->name }}</div>
                        <div class="fs-5 fw-bold text-success mb-3">Rp {{ number_format($p->price,0,',','.') }}</div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('buyer.product.detail', $p->id) }}" class="btn btn-outline-info btn-sm flex-grow-1"><i class="bi bi-eye"></i> Detail</a>
                            <button wire:click="addToCart({{ $p->id }})" class="btn btn-boba btn-sm flex-grow-1"><i class="bi bi-cart-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5"><i class="bi bi-search fs-1"></i><div class="mt-2">Tidak ada produk ditemukan.</div></div>
        @endforelse
    </div>

    <div class="mt-4">{{ $products->links() }}</div>
</div>
