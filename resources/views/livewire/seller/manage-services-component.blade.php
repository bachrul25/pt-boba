<div class="container-fluid">
    <div class="row g-0">
        @include('partials.seller-sidebar')
        <main class="col-md-9 col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">Kelola Layanan tos2bro</h3>
                    <p class="text-muted">Semua layanan otomatis menggunakan brand <strong>tos2bro</strong>.</p>
                </div>
                <button class="btn btn-boba" wire:click="openCreate"><i class="bi bi-plus-lg"></i> Tambah Layanan</button>
            </div>

            @if($showForm)
                <div class="card-boba p-4 mb-4">
                    <h5 class="fw-bold mb-3">{{ $editingId ? 'Edit' : 'Tambah' }} Layanan</h5>
                    <form wire:submit="save">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small">Nama Layanan</label>
                                <input wire:model="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Jenis Layanan</label>
                                <select wire:model="service_type" class="form-select">
                                    <option value="pengambilan_sampah">Pengambilan Sampah</option>
                                    <option value="pengelolaan_sampah">Pengelolaan Sampah</option>
                                    <option value="pengolahan_sampah_organik">Pengolahan Sampah Organik</option>
                                    <option value="bahan_bakar_kendaraan">Bahan Bakar Kendaraan dari Sampah Organik</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Kategori</label>
                                <input wire:model="category" class="form-control" placeholder="Rumah tangga, Industri, dll">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Harga (Rp)</label>
                                <input type="number" wire:model="price" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Status</label>
                                <select wire:model="status" class="form-select">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small">Deskripsi</label>
                                <textarea wire:model="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Gambar</label>
                                <input type="file" wire:model="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                @if($existingImage && ! $image) <div class="small text-muted mt-1">Saat ini: {{ basename($existingImage) }}</div> @endif
                                <div wire:loading wire:target="image" class="small text-muted">Mengunggah...</div>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-boba"><i class="bi bi-check-lg"></i> Simpan</button>
                            <button type="button" class="btn btn-secondary" wire:click="$set('showForm', false)">Batal</button>
                        </div>
                    </form>
                </div>
            @endif

            <div class="card-boba p-3">
                <div class="table-responsive"><table class="table table-hover align-middle">
                    <thead><tr><th>#</th><th>Nama</th><th>Jenis</th><th>Harga</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        @forelse($services as $s)
                            <tr>
                                <td>{{ $s->id }}</td>
                                <td class="fw-semibold">{{ $s->name }}</td>
                                <td><span class="badge badge-soft-info">{{ str_replace('_',' ', $s->service_type) }}</span></td>
                                <td>Rp {{ number_format($s->price,0,',','.') }}</td>
                                <td><span class="badge badge-soft-{{ $s->status === 'active' ? 'success' : 'secondary' }}">{{ $s->status }}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-warning" wire:click="edit({{ $s->id }})"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary" wire:click="toggleStatus({{ $s->id }})">Toggle</button>
                                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $s->id }})" wire:confirm="Hapus layanan?"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">Belum ada layanan. Klik "Tambah Layanan".</td></tr>
                        @endforelse
                    </tbody>
                </table></div>
                <div>{{ $services->links() }}</div>
            </div>
        </main>
    </div>
</div>
