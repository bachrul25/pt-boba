@section('page-title', 'Manage Brands')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Brand Perusahaan</h5>
        @if(! $showForm)
            <button class="btn btn-boba" wire:click="newBrand"><i class="bi bi-plus-lg me-1"></i> Tambah Brand</button>
        @endif
    </div>

    @if($showForm)
        <div class="card mb-3">
            <div class="card-body">
                <form wire:submit="save" class="row g-3">
                    <div class="col-md-6"><label class="form-label small fw-semibold">Nama *</label>
                        <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6"><label class="form-label small fw-semibold">Slug</label>
                        <input type="text" wire:model="slug" class="form-control" placeholder="auto dari nama">
                    </div>
                    <div class="col-md-4"><label class="form-label small fw-semibold">Tipe *</label>
                        <select wire:model="type" class="form-select">
                            <option value="fashion">Fashion</option>
                            <option value="service">Service / Green Tech</option>
                        </select>
                    </div>
                    <div class="col-md-4"><label class="form-label small fw-semibold">Kategori</label>
                        <input type="text" wire:model="category" class="form-control">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check">
                            <input type="checkbox" wire:model="is_active" class="form-check-input" id="active">
                            <label class="form-check-label small" for="active">Aktif</label>
                        </div>
                    </div>
                    <div class="col-12"><label class="form-label small fw-semibold">Deskripsi</label>
                        <textarea wire:model="description" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button class="btn btn-boba">Simpan</button>
                        <button type="button" wire:click="cancel" class="btn btn-outline-secondary">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead><tr><th>Nama</th><th>Slug</th><th>Tipe</th><th>Kategori</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @forelse($brands as $b)
                        <tr>
                            <td class="fw-semibold">{{ $b->name }}</td>
                            <td><code>{{ $b->slug }}</code></td>
                            <td><span class="badge badge-soft-primary">{{ $b->type }}</span></td>
                            <td>{{ $b->category }}</td>
                            <td>
                                @if($b->is_active)
                                    <span class="badge badge-soft-success">Aktif</span>
                                @else
                                    <span class="badge badge-soft-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <button wire:click="edit({{ $b->id }})" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $b->id }})" wire:confirm="Hapus brand?" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-secondary small py-3">Belum ada brand.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
