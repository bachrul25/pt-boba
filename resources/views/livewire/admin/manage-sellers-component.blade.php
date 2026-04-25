<div class="container-fluid">
    <div class="row g-0">
        @include('partials.admin-sidebar')
        <main class="col-md-9 col-lg-10 p-4">
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Kelola Seller</h3>
                <p class="text-muted">Approve, reject, atau hapus data seller.</p>
            </div>

            <div class="card-boba p-3 mb-3">
                <div class="row g-2">
                    <div class="col-md-6">
                        <input wire:model.live.debounce.400ms="search" class="form-control" placeholder="Cari nama atau email seller...">
                    </div>
                    <div class="col-md-3">
                        <select wire:model.live="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-boba p-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Toko</th><th>Status</th><th>Aksi</th></tr></thead>
                        <tbody>
                            @forelse($sellers as $s)
                                <tr>
                                    <td>{{ $s->id }}</td>
                                    <td class="fw-semibold">{{ $s->name }}</td>
                                    <td>{{ $s->email }}</td>
                                    <td>
                                        <div>{{ $s->sellerProfile?->shop_name ?? '-' }}</div>
                                        <div class="small text-muted">{{ \Illuminate\Support\Str::limit($s->sellerProfile?->shop_description, 50) }}</div>
                                    </td>
                                    <td>
                                        @php $status = $s->sellerProfile?->status ?? 'pending'; @endphp
                                        <span class="badge badge-soft-{{ match($status){'approved'=>'success','rejected'=>'danger',default=>'warning'} }}">{{ $status }}</span>
                                    </td>
                                    <td>
                                        @if($status !== 'approved')
                                            <button class="btn btn-sm btn-success" wire:click="approve({{ $s->id }})"><i class="bi bi-check-lg"></i> Approve</button>
                                        @endif
                                        @if($status !== 'rejected')
                                            <button class="btn btn-sm btn-warning" wire:click="reject({{ $s->id }})"><i class="bi bi-x-lg"></i> Reject</button>
                                        @endif
                                        <button class="btn btn-sm btn-danger" wire:click="destroy({{ $s->id }})" wire:confirm="Hapus seller ini?"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center text-muted">Belum ada seller.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div>{{ $sellers->links() }}</div>
            </div>
        </main>
    </div>
</div>
