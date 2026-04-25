@section('page-title', 'Manage Services - Ponpin')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Layanan Green Technology</h5>
        @if(! $showForm)<button class="btn btn-boba" wire:click="newService"><i class="bi bi-plus-lg me-1"></i> Tambah Layanan</button>@endif
    </div>

    @if($showForm)
        <div class="card mb-3"><div class="card-body">
            <form wire:submit="save" class="row g-3">
                <div class="col-md-6"><label class="form-label small fw-semibold">Brand *</label>
                    <select wire:model="brand_id" class="form-select @error('brand_id') is-invalid @enderror">
                        <option value="">Pilih brand</option>
                        @foreach($brands as $b)<option value="{{ $b->id }}">{{ $b->name }}</option>@endforeach
                    </select>
                    @error('brand_id')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-md-6"><label class="form-label small fw-semibold">Seller</label>
                    <select wire:model="seller_id" class="form-select">
                        <option value="">— PT BOBA Pusat —</option>
                        @foreach($sellers as $s)<option value="{{ $s->id }}">{{ $s->store_name ?: $s->name }}</option>@endforeach
                    </select>
                </div>
                <div class="col-md-6"><label class="form-label small fw-semibold">Nama Layanan *</label>
                    <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="col-md-3"><label class="form-label small fw-semibold">Kategori</label>
                    <input type="text" wire:model="category" class="form-control">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check"><input class="form-check-input" type="checkbox" wire:model="is_active" id="sa"><label class="form-check-label small" for="sa">Aktif</label></div>
                </div>
                <div class="col-md-6"><label class="form-label small fw-semibold">Harga *</label>
                    <input type="number" step="0.01" wire:model="price" class="form-control">
                </div>
                <div class="col-md-6"><label class="form-label small fw-semibold">Unit</label>
                    <input type="text" wire:model="unit" class="form-control" placeholder="bulan / ton / project">
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
                <thead><tr><th>Nama</th><th>Brand</th><th>Kategori</th><th>Harga</th><th>Unit</th><th></th></tr></thead>
                <tbody>
                    @forelse($services as $s)
                        <tr>
                            <td class="fw-semibold">{{ $s->name }}<br><small class="text-secondary">{{ \Illuminate\Support\Str::limit($s->description, 80) }}</small></td>
                            <td>{{ $s->brand->name ?? '-' }}</td>
                            <td>{{ $s->category }}</td>
                            <td>Rp {{ number_format($s->price, 0, ',', '.') }}</td>
                            <td><small>/ {{ $s->unit }}</small></td>
                            <td class="text-end">
                                <button wire:click="edit({{ $s->id }})" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $s->id }})" wire:confirm="Hapus layanan?" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-secondary small py-3">Belum ada layanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
