@section('page-title', 'Manage Founders')
<div>
    @if(session('msg'))
        <div class="alert alert-success py-2"><i class="bi bi-check-circle me-1"></i> {{ session('msg') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Pendiri PT BOBA</h5>
        @if(! $showForm)
            <button class="btn btn-boba" wire:click="newFounder"><i class="bi bi-plus-lg me-1"></i> Tambah Founder</button>
        @endif
    </div>

    @if($showForm)
        <div class="card mb-3">
            <div class="card-body">
                <form wire:submit="save" class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Nama *</label>
                        <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Jabatan *</label>
                        <input type="text" wire:model="position" class="form-control @error('position') is-invalid @enderror">
                        @error('position') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-semibold">Deskripsi *</label>
                        <textarea wire:model="description" rows="3" class="form-control @error('description') is-invalid @enderror"></textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-8">
                        <label class="form-label small fw-semibold">Foto (URL/path)</label>
                        <input type="text" wire:model="photo" class="form-control" placeholder="images/founders/file.jpg">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Urutan</label>
                        <input type="number" wire:model="order_index" class="form-control">
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button class="btn btn-boba"><i class="bi bi-save me-1"></i> Simpan</button>
                        <button type="button" wire:click="cancel" class="btn btn-outline-secondary">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead><tr><th>#</th><th>Nama</th><th>Jabatan</th><th>Deskripsi</th><th></th></tr></thead>
                <tbody>
                    @forelse($founders as $f)
                        <tr>
                            <td>{{ $f->order_index }}</td>
                            <td class="fw-semibold">{{ $f->name }}</td>
                            <td><span class="badge badge-soft-primary">{{ $f->position }}</span></td>
                            <td class="small text-secondary">{{ \Illuminate\Support\Str::limit($f->description, 120) }}</td>
                            <td class="text-end">
                                <button wire:click="edit({{ $f->id }})" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $f->id }})" wire:confirm="Hapus founder ini?" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center small text-secondary py-3">Belum ada founder.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
