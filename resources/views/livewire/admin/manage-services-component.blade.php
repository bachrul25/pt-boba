<div class="container-fluid">
    <div class="row g-0">
        @include('partials.admin-sidebar')
        <main class="col-md-9 col-lg-10 p-4">
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Kelola Layanan</h3>
                <p class="text-muted">Semua layanan green technology tos2bro.</p>
            </div>

            <div class="card-boba p-3 mb-3">
                <div class="row g-2">
                    <div class="col-md-4">
                        <input wire:model.live.debounce.400ms="search" class="form-control" placeholder="Cari layanan...">
                    </div>
                    <div class="col-md-4">
                        <select wire:model.live="service_type" class="form-select">
                            <option value="">Semua Jenis</option>
                            <option value="pengambilan_sampah">Pengambilan Sampah</option>
                            <option value="pengelolaan_sampah">Pengelolaan Sampah</option>
                            <option value="pengolahan_sampah_organik">Pengolahan Sampah Organik</option>
                            <option value="bahan_bakar_kendaraan">Bahan Bakar Kendaraan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
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
                    <thead><tr><th>#</th><th>Nama</th><th>Jenis</th><th>Brand</th><th>Harga</th><th>Seller</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        @forelse($services as $s)
                            <tr>
                                <td>{{ $s->id }}</td>
                                <td class="fw-semibold">{{ $s->name }}</td>
                                <td><span class="badge badge-soft-info">{{ str_replace('_',' ', $s->service_type) }}</span></td>
                                <td>{{ $s->brand }}</td>
                                <td>Rp {{ number_format($s->price,0,',','.') }}</td>
                                <td>{{ $s->seller?->name }}</td>
                                <td><span class="badge badge-soft-{{ $s->status === 'active' ? 'success' : 'secondary' }}">{{ $s->status }}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" wire:click="toggleStatus({{ $s->id }})">Toggle</button>
                                    <button class="btn btn-sm btn-danger" wire:click="destroy({{ $s->id }})" wire:confirm="Hapus layanan?"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center text-muted">Tidak ada layanan.</td></tr>
                        @endforelse
                    </tbody>
                </table></div>
                <div>{{ $services->links() }}</div>
            </div>
        </main>
    </div>
</div>
