@section('page-title', 'Manage Sellers')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h5 class="fw-bold mb-0">Mitra Seller PT BOBA</h5>
        <input wire:model.live.debounce.300ms="search" class="form-control form-control-sm" style="max-width:280px" placeholder="Cari seller...">
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead><tr><th>Nama Toko</th><th>Pemilik</th><th>Email</th><th>Telepon</th><th>Produk</th><th>Layanan</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @forelse($sellers as $s)
                        <tr>
                            <td class="fw-semibold">{{ $s->store_name ?: '—' }}</td>
                            <td>{{ $s->name }}</td>
                            <td><small>{{ $s->email }}</small></td>
                            <td><small>{{ $s->phone ?: '-' }}</small></td>
                            <td>{{ $s->products_count }}</td>
                            <td>{{ $s->services_count }}</td>
                            <td>
                                @if($s->is_active)<span class="badge badge-soft-success">Aktif</span>
                                @else <span class="badge badge-soft-danger">Nonaktif</span>@endif
                            </td>
                            <td class="text-end">
                                <button wire:click="toggleActive({{ $s->id }})" class="btn btn-sm btn-outline-secondary"><i class="bi bi-toggle2-on"></i></button>
                                <button wire:click="delete({{ $s->id }})" wire:confirm="Hapus seller?" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center small text-secondary py-3">Belum ada seller.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
