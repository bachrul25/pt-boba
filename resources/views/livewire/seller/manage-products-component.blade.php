<div class="container-fluid">
    <div class="row g-0">
        @include('partials.seller-sidebar')
        <main class="col-md-9 col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">Kelola Produk</h3>
                    <p class="text-muted">Produk fashion brand tsoecha.co atau sokyuut milik Anda.</p>
                </div>
                <button class="btn btn-boba" wire:click="openCreate"><i class="bi bi-plus-lg"></i> Tambah Produk</button>
            </div>

            @if($showForm)
                <div class="card-boba p-4 mb-4">
                    <h5 class="fw-bold mb-3">{{ $editingId ? 'Edit' : 'Tambah' }} Produk</h5>
                    <form wire:submit="save">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small">Nama Produk</label>
                                <input wire:model="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Brand</label>
                                <select wire:model="brand" class="form-select">
                                    <option value="tsoecha.co">tsoecha.co (Pria)</option>
                                    <option value="sokyuut">sokyuut (Wanita)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Gender</label>
                                <select wire:model="gender_category" class="form-select">
                                    <option value="pria">Pria</option>
                                    <option value="wanita">Wanita</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Kategori</label>
                                <input wire:model="category" class="form-control" placeholder="Kaos, Dress, ...">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Harga (Rp)</label>
                                <input type="number" wire:model="price" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Stok</label>
                                <input type="number" wire:model="stock" class="form-control">
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
                            <div class="col-md-6">
                                <label class="form-label small">Status</label>
                                <select wire:model="status" class="form-select">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
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
                    <thead><tr><th>#</th><th>Gambar</th><th>Nama</th><th>Brand</th><th>Gender</th><th>Harga</th><th>Stok</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        @forelse($products as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>
                                    @if($p->image)
                                        <img src="{{ asset('storage/'.$p->image) }}" class="rounded" style="width:50px;height:50px;object-fit:cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:50px;height:50px;"><i class="bi bi-image text-muted"></i></div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $p->name }}</td>
                                <td><span class="badge badge-soft-info">{{ $p->brand }}</span></td>
                                <td class="text-capitalize">{{ $p->gender_category }}</td>
                                <td>Rp {{ number_format($p->price,0,',','.') }}</td>
                                <td>{{ $p->stock }}</td>
                                <td><span class="badge badge-soft-{{ $p->status === 'active' ? 'success' : 'secondary' }}">{{ $p->status }}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-warning" wire:click="edit({{ $p->id }})"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary" wire:click="toggleStatus({{ $p->id }})">Toggle</button>
                                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $p->id }})" wire:confirm="Hapus produk?"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center text-muted">Belum ada produk. Klik "Tambah Produk".</td></tr>
                        @endforelse
                    </tbody>
                </table></div>
                <div>{{ $products->links() }}</div>
            </div>
        </main>
    </div>
</div>
