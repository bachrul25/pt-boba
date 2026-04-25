<div class="container-fluid">
    <div class="row g-0">
        @include('partials.admin-sidebar')
        <main class="col-md-9 col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">Kelola Struktur Perusahaan</h3>
                    <p class="text-muted mb-0">Tambah / edit / hapus data pendiri PT BOBA.</p>
                </div>
                <button class="btn btn-boba" wire:click="openCreate"><i class="bi bi-plus-lg"></i> Tambah Pendiri</button>
            </div>

            @if($showForm)
                <div class="card-boba p-4 mb-4">
                    <h5 class="fw-bold mb-3">{{ $editingId ? 'Edit' : 'Tambah' }} Data Pendiri</h5>
                    <form wire:submit="save">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small">Nama</label>
                                <input wire:model="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Jabatan</label>
                                <input wire:model="position" class="form-control @error('position') is-invalid @enderror">
                                @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small">Deskripsi</label>
                                <textarea wire:model="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Sort Order</label>
                                <input type="number" wire:model="sort_order" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Status</label>
                                <select wire:model="status" class="form-select">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Foto</label>
                                <input type="file" wire:model="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                                @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                @if($existingPhoto && ! $photo)
                                    <div class="small text-muted mt-1">Foto saat ini: {{ basename($existingPhoto) }}</div>
                                @endif
                                <div wire:loading wire:target="photo" class="small text-muted">Mengunggah...</div>
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
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead><tr><th>#</th><th>Foto</th><th>Nama</th><th>Jabatan</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr></thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @if($item->photo)
                                            <img src="{{ asset('storage/'.$item->photo) }}" class="rounded-circle" style="width:50px;height:50px;object-fit:cover;">
                                        @else
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:50px;height:50px;"><i class="bi bi-person text-muted"></i></div>
                                        @endif
                                    </td>
                                    <td class="fw-semibold">{{ $item->name }}</td>
                                    <td>{{ $item->position }}</td>
                                    <td>{{ $item->sort_order }}</td>
                                    <td><span class="badge badge-soft-{{ $item->status === 'active' ? 'success' : 'secondary' }}">{{ $item->status }}</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" wire:click="edit({{ $item->id }})"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary" wire:click="toggleStatus({{ $item->id }})">
                                            <i class="bi bi-toggle-on"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $item->id }})" wire:confirm="Hapus data pendiri ini?"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center text-muted">Belum ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div>{{ $items->links() }}</div>
            </div>
        </main>
    </div>
</div>
