@section('page-title', 'Investor Inquiries')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif

    <div class="row g-3">
        <div class="col-lg-{{ $current ? 7 : 12 }}">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                        <thead><tr><th>Nama</th><th>Email</th><th>Bidang</th><th>Status</th><th>Tanggal</th><th></th></tr></thead>
                        <tbody>
                            @forelse($inquiries as $i)
                                <tr @class(['table-active' => $current && $current->id === $i->id])>
                                    <td class="fw-semibold">{{ $i->name }}<br><small class="text-secondary">{{ $i->company }}</small></td>
                                    <td><small>{{ $i->email }}</small></td>
                                    <td><small>{{ $i->interest_area }}</small></td>
                                    <td>
                                        <span class="badge @if($i->status==='new')badge-soft-warning @elseif($i->status==='closed')badge-soft-danger @else badge-soft-primary @endif">{{ $i->status }}</span>
                                    </td>
                                    <td><small>{{ $i->created_at->diffForHumans() }}</small></td>
                                    <td class="text-end">
                                        <button wire:click="open({{ $i->id }})" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                                        <button wire:click="delete({{ $i->id }})" wire:confirm="Hapus?" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center text-secondary small py-3">Belum ada inquiry.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if($current)
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="fw-bold">{{ $current->name }}</h5>
                            <button wire:click="close" class="btn btn-sm btn-link text-secondary">×</button>
                        </div>
                        <div class="small text-secondary mb-2">
                            <div>{{ $current->email }} · {{ $current->phone }}</div>
                            <div>{{ $current->company }} · {{ $current->country }}</div>
                            <div>Range: {{ $current->investment_range ?: '-' }} · Bidang: {{ $current->interest_area ?: '-' }}</div>
                        </div>
                        <div class="bg-light p-2 rounded small mb-3">{{ $current->message }}</div>

                        <form wire:submit="save" class="d-flex flex-column gap-2">
                            <div>
                                <label class="form-label small fw-semibold">Status</label>
                                <select wire:model="status" class="form-select">
                                    @foreach(['new','contacted','in_review','closed'] as $st)
                                        <option value="{{ $st }}">{{ $st }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label small fw-semibold">Catatan Admin</label>
                                <textarea wire:model="admin_notes" rows="4" class="form-control"></textarea>
                            </div>
                            <button class="btn btn-boba"><i class="bi bi-save me-1"></i> Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
