<div class="container-fluid">
    <div class="row g-0">
        @include('partials.admin-sidebar')
        <main class="col-md-9 col-lg-10 p-4">
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Kelola Produk</h3>
                <p class="text-muted">Semua produk fashion dari seller PT BOBA (tsoecha.co & sokyuut).</p>
            </div>

            <div class="card-boba p-3 mb-3">
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
                        <select wire:model.live="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-boba p-3">
                <div class="table-responsive"><table class="table table-hover align-middle">
                    <thead><tr><th>#</th><th>Nama</th><th>Brand</th><th>Gender</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Seller</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        @forelse($products as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td class="fw-semibold">{{ $p->name }}</td>
                                <td><span class="badge badge-soft-info">{{ $p->brand }}</span></td>
                                <td class="text-capitalize">{{ $p->gender_category }}</td>
                                <td>{{ $p->category }}</td>
                                <td>Rp {{ number_format($p->price,0,',','.') }}</td>
                                <td>{{ $p->stock }}</td>
                                <td>{{ $p->seller?->name }}</td>
                                <td><span class="badge badge-soft-{{ $p->status === 'active' ? 'success' : 'secondary' }}">{{ $p->status }}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" wire:click="toggleStatus({{ $p->id }})">Toggle</button>
                                    <button class="btn btn-sm btn-danger" wire:click="destroy({{ $p->id }})" wire:confirm="Hapus produk?"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="10" class="text-center text-muted">Tidak ada produk.</td></tr>
                        @endforelse
                    </tbody>
                </table></div>
                <div>{{ $products->links() }}</div>
            </div>
        </main>
    </div>
</div>
