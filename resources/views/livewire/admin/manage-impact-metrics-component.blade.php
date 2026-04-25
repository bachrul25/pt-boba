@section('page-title', 'Manage Impact Metrics')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Impact Metrics</h5>
        @if(! $showForm)<button class="btn btn-boba" wire:click="newItem"><i class="bi bi-plus-lg me-1"></i> Tambah Metric</button>@endif
    </div>

    @if($showForm)
        <div class="card mb-3"><div class="card-body">
            <form wire:submit="save" class="row g-3">
                <div class="col-md-6"><label class="form-label small fw-semibold">Nama *</label>
                    <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-md-3"><label class="form-label small fw-semibold">Nilai *</label>
                    <input type="text" wire:model="value" class="form-control" placeholder="3 / 500+ / 120">
                </div>
                <div class="col-md-3"><label class="form-label small fw-semibold">Unit</label>
                    <input type="text" wire:model="unit" class="form-control" placeholder="Brand / Ton / Sektor">
                </div>
                <div class="col-md-4"><label class="form-label small fw-semibold">Kategori</label>
                    <input type="text" wire:model="category" class="form-control" placeholder="company / esg / market">
                </div>
                <div class="col-md-4"><label class="form-label small fw-semibold">Icon (bi-...)</label>
                    <input type="text" wire:model="icon" class="form-control" placeholder="bi-stars">
                </div>
                <div class="col-md-4"><label class="form-label small fw-semibold">Urutan</label>
                    <input type="number" wire:model="order_index" class="form-control">
                </div>
                <div class="col-12"><label class="form-label small fw-semibold">Deskripsi</label>
                    <textarea wire:model="description" rows="2" class="form-control"></textarea>
                </div>
                <div class="col-12 d-flex gap-2">
                    <button class="btn btn-boba">Simpan</button>
                    <button type="button" wire:click="cancel" class="btn btn-outline-secondary">Batal</button>
                </div>
            </form>
        </div></div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead><tr><th>Metric</th><th>Nilai</th><th>Unit</th><th>Kategori</th><th></th></tr></thead>
                <tbody>
                    @forelse($items as $m)
                        <tr>
                            <td class="fw-semibold"><i class="bi {{ $m->icon ?: 'bi-graph-up' }} text-boba me-1"></i> {{ $m->name }}<br><small class="text-secondary">{{ \Illuminate\Support\Str::limit($m->description, 80) }}</small></td>
                            <td class="fw-bold text-boba">{{ $m->value }}</td>
                            <td>{{ $m->unit }}</td>
                            <td><span class="badge badge-soft-primary">{{ $m->category }}</span></td>
                            <td class="text-end">
                                <button wire:click="edit({{ $m->id }})" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $m->id }})" wire:confirm="Hapus metric?" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-secondary small py-3">Belum ada metric.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
