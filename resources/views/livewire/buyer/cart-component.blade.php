<div class="container py-4">
    <h3 class="fw-bold mb-4"><i class="bi bi-cart"></i> Keranjang Belanja</h3>
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card-boba p-3">
                @forelse($items as $item)
                    <div class="d-flex gap-3 align-items-center py-3 border-bottom">
                        <div style="width:80px;height:80px;background:#f1f5f9;border-radius:12px;display:flex;align-items:center;justify-content:center; @if($item->product->image) background-image:url('{{ asset('storage/'.$item->product->image) }}'); background-size:cover; background-position:center; @endif">
                            @if(! $item->product->image) <i class="bi bi-image text-muted"></i> @endif
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold">{{ $item->product->name }}</div>
                            <div class="small text-muted">{{ $item->product->brand }} · {{ $item->product->seller?->name }}</div>
                            <div class="small">Rp {{ number_format($item->product->price,0,',','.') }}</div>
                        </div>
                        <div style="width:100px;">
                            <div class="input-group input-group-sm">
                                <input type="number" min="1" wire:model="quantities.{{ $item->id }}" wire:change="updateQty({{ $item->id }})" class="form-control">
                            </div>
                        </div>
                        <div class="text-end" style="min-width:130px;">
                            <div class="fw-bold text-success">Rp {{ number_format($item->subtotal,0,',','.') }}</div>
                            <button wire:click="remove({{ $item->id }})" class="btn btn-sm btn-outline-danger mt-1"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-cart-x fs-1"></i>
                        <p class="mt-2">Keranjang Anda kosong.</p>
                        <a href="{{ route('buyer.products') }}" class="btn btn-boba">Belanja Sekarang</a>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-boba p-4 sticky-top" style="top:80px;">
                <h5 class="fw-bold mb-3">Ringkasan</h5>
                <div class="d-flex justify-content-between mb-2 small"><span>Subtotal ({{ $items->count() }} item)</span><span>Rp {{ number_format($total,0,',','.') }}</span></div>
                <hr>
                <div class="d-flex justify-content-between mb-3"><span class="fw-bold">Total</span><span class="fw-bold text-success fs-5">Rp {{ number_format($total,0,',','.') }}</span></div>
                <a href="{{ route('buyer.checkout') }}" class="btn btn-boba w-100 btn-lg @if($items->isEmpty()) disabled @endif"><i class="bi bi-bag-check"></i> Checkout</a>
            </div>
        </div>
    </div>
</div>
