@section('page-title', 'My Orders')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif

    <h5 class="fw-bold mb-3">Riwayat Order Produk</h5>

    @forelse($orders as $o)
        <div class="card mb-3"><div class="card-body">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <code>{{ $o->order_number }}</code>
                    <span class="badge badge-soft-primary ms-1">{{ $o->status }}</span>
                    <div class="small text-secondary mt-1">{{ $o->created_at->format('d M Y H:i') }}</div>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-boba">Rp {{ number_format($o->total, 0, ',', '.') }}</div>
                    @if(in_array($o->status, ['pending','paid']))
                        <button wire:click="cancel({{ $o->id }})" wire:confirm="Batalkan order?" class="btn btn-sm btn-outline-danger mt-1">Batalkan</button>
                    @endif
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
