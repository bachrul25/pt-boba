@section('page-title', 'Company Documents')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Dokumen Perusahaan</h5>
        @if(! $showForm)<button class="btn btn-boba" wire:click="newDoc"><i class="bi bi-plus-lg me-1"></i> Tambah Dokumen</button>@endif
    </div>

    @if($showForm)
        <div class="card mb-3"><div class="card-body">
            <form wire:submit="save" class="row g-3">
                <div class="col-md-8"><label class="form-label small fw-semibold">Judul *</label>
                    <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror">
                    @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-md-4"><label class="form-label small fw-semibold">Kategori</label>
                    <input type="text" wire:model="category" class="form-control" placeholder="Profile / Investor / ESG">
                </div>
                <div class="col-md-8"><label class="form-label small fw-semibold">URL File</label>
                    <input type="text" wire:model="file_url" class="form-control" placeholder="https://...">
                </div>
                <div class="col-md-2"><label class="form-label small fw-semibold">Tahun</label>
                    <input type="number" wire:model="year" class="form-control">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <div class="form-check"><input class="form-check-input" type="checkbox" wire:model="is_public" id="dp"><label class="form-check-label small" for="dp">Public</label></div>
                </div>
                <div class="col-12"><label class="form-label small fw-semibold">Deskripsi</label>
                    <textarea wire:model="description" rows="3" class="form-control"></textarea>
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
                <thead><tr><th>Judul</th><th>Kategori</th><th>Tahun</th><th>Public</th><th></th></tr></thead>
                <tbody>
                    @forelse($documents as $d)
                        <tr>
                            <td class="fw-semibold">{{ $d->title }}<br><small class="text-secondary">{{ \Illuminate\Support\Str::limit($d->description, 80) }}</small></td>
                            <td>{{ $d->category }}</td>
                            <td>{{ $d->year }}</td>
                            <td>@if($d->is_public)<span class="badge badge-soft-success">Yes</span>@else<span class="badge badge-soft-danger">No</span>@endif</td>
                            <td class="text-end">
                                <button wire:click="edit({{ $d->id }})" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $d->id }})" wire:confirm="Hapus?" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-secondary small py-3">Belum ada dokumen.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
