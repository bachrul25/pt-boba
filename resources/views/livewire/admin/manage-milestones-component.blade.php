@section('page-title', 'Manage Milestones')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Milestones / Roadmap</h5>
        @if(! $showForm)<button class="btn btn-boba" wire:click="newItem"><i class="bi bi-plus-lg me-1"></i> Tambah Milestone</button>@endif
    </div>

    @if($showForm)
        <div class="card mb-3"><div class="card-body">
            <form wire:submit="save" class="row g-3">
                <div class="col-md-8"><label class="form-label small fw-semibold">Judul *</label>
                    <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror">
                    @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-md-2"><label class="form-label small fw-semibold">Tahun *</label>
                    <input type="number" wire:model="year" class="form-control @error('year') is-invalid @enderror">
                    @error('year')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-md-2"><label class="form-label small fw-semibold">Bulan</label>
                    <input type="text" wire:model="month" class="form-control" placeholder="Januari">
                </div>
                <div class="col-md-6"><label class="form-label small fw-semibold">Icon (bi-...)</label>
                    <input type="text" wire:model="icon" class="form-control" placeholder="bi-flag-fill">
                </div>
                <div class="col-md-6"><label class="form-label small fw-semibold">Urutan</label>
                    <input type="number" wire:model="order_index" class="form-control">
                </div>
                <div class="col-12"><label class="form-label small fw-semibold">Deskripsi *</label>
                    <textarea wire:model="description" rows="3" class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description')<small class="text-danger">{{ $message }}</small>@enderror
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
                <thead><tr><th>Tahun</th><th>Judul</th><th>Deskripsi</th><th></th></tr></thead>
                <tbody>
                    @forelse($items as $m)
                        <tr>
                            <td><span class="badge badge-soft-primary">{{ $m->year }}{{ $m->month ? ' · '.$m->month : '' }}</span></td>
                            <td class="fw-semibold">{{ $m->title }}</td>
                            <td class="small text-secondary">{{ \Illuminate\Support\Str::limit($m->description, 100) }}</td>
                            <td class="text-end">
                                <button wire:click="edit({{ $m->id }})" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $m->id }})" wire:confirm="Hapus milestone?" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center small text-secondary py-3">Belum ada milestone.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
