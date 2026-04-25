<div class="container-fluid">
    <div class="row g-0">
        @include('partials.admin-sidebar')
        <main class="col-md-9 col-lg-10 p-4">
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Laporan</h3>
                <p class="text-muted">Laporan order, booking, dan pembayaran.</p>
            </div>

            <div class="card-boba p-3 mb-3">
                <div class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small">Dari Tanggal</label>
                        <input type="date" wire:model.live="start_date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Sampai Tanggal</label>
                        <input type="date" wire:model.live="end_date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-secondary" wire:click="resetFilter"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded-3 text-end">
                            <div class="small text-muted">Total Pendapatan</div>
                            <div class="fs-4 fw-bold text-success">Rp {{ number_format($totalRevenue,0,',','.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-lg-4">
                    <div class="card-boba p-3 h-100">
                        <h6 class="fw-bold mb-3"><i class="bi bi-cart"></i> Order Produk</h6>
                        <div class="table-responsive"><table class="table table-sm align-middle">
                            <thead><tr><th>#</th><th>Buyer</th><th>Total</th><th>Status</th></tr></thead>
                            <tbody>
                                @forelse($orders as $o)
                                    <tr>
                                        <td>#{{ $o->id }}</td>
                                        <td>{{ $o->buyer?->name }}</td>
                                        <td>Rp {{ number_format($o->total_price,0,',','.') }}</td>
                                        <td><span class="badge badge-soft-{{ $o->payment_status === 'success' ? 'success' : ($o->payment_status === 'failed' ? 'danger' : 'warning') }}">{{ $o->payment_status }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted small">Kosong</td></tr>
                                @endforelse
                            </tbody>
                        </table></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-boba p-3 h-100">
                        <h6 class="fw-bold mb-3"><i class="bi bi-calendar"></i> Booking Layanan</h6>
                        <div class="table-responsive"><table class="table table-sm align-middle">
                            <thead><tr><th>#</th><th>Buyer</th><th>Service</th><th>Status</th></tr></thead>
                            <tbody>
                                @forelse($bookings as $b)
                                    <tr>
                                        <td>#{{ $b->id }}</td>
                                        <td>{{ $b->buyer?->name }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($b->service?->name, 20) }}</td>
                                        <td><span class="badge badge-soft-{{ $b->booking_status === 'completed' ? 'success' : 'warning' }}">{{ $b->booking_status }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted small">Kosong</td></tr>
                                @endforelse
                            </tbody>
                        </table></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-boba p-3 h-100">
                        <h6 class="fw-bold mb-3"><i class="bi bi-credit-card"></i> Pembayaran</h6>
                        <div class="table-responsive"><table class="table table-sm align-middle">
                            <thead><tr><th>#</th><th>User</th><th>Amount</th><th>Status</th></tr></thead>
                            <tbody>
                                @forelse($payments as $p)
                                    <tr>
                                        <td>#{{ $p->id }}</td>
                                        <td>{{ $p->user?->name }}</td>
                                        <td>Rp {{ number_format($p->amount,0,',','.') }}</td>
                                        <td><span class="badge badge-soft-{{ $p->status === 'success' ? 'success' : ($p->status === 'failed' ? 'danger' : 'warning') }}">{{ $p->status }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted small">Kosong</td></tr>
                                @endforelse
                            </tbody>
                        </table></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
