<div class="container-fluid">
    <div class="row g-0">
        @include('partials.seller-sidebar')
        <main class="col-md-9 col-lg-10 p-4">
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Laporan</h3>
                <p class="text-muted">Ringkasan penjualan dan pendapatan Anda.</p>
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
                        <button class="btn btn-secondary" wire:click="resetFilter">Reset</button>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="small text-muted text-uppercase">Revenue Produk</div>
                        <div class="stat-num text-info">Rp {{ number_format($productRevenue,0,',','.') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="small text-muted text-uppercase">Revenue Layanan</div>
                        <div class="stat-num text-warning">Rp {{ number_format($serviceRevenue,0,',','.') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="small text-muted text-uppercase">Total Pendapatan</div>
                        <div class="stat-num text-success">Rp {{ number_format($totalRevenue,0,',','.') }}</div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-lg-6">
                    <div class="card-boba p-3 h-100">
                        <h6 class="fw-bold mb-3">Order Produk</h6>
                        <div class="table-responsive"><table class="table table-sm align-middle">
                            <thead><tr><th>#</th><th>Produk</th><th>Buyer</th><th>Qty</th><th>Subtotal</th></tr></thead>
                            <tbody>
                                @forelse($orderItems as $oi)
                                    <tr>
                                        <td>#{{ $oi->order_id }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($oi->product?->name, 22) }}</td>
                                        <td>{{ $oi->order?->buyer?->name }}</td>
                                        <td>{{ $oi->quantity }}</td>
                                        <td>Rp {{ number_format($oi->subtotal,0,',','.') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-muted small">Kosong</td></tr>
                                @endforelse
                            </tbody>
                        </table></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-boba p-3 h-100">
                        <h6 class="fw-bold mb-3">Booking Layanan</h6>
                        <div class="table-responsive"><table class="table table-sm align-middle">
                            <thead><tr><th>#</th><th>Service</th><th>Buyer</th><th>Status</th></tr></thead>
                            <tbody>
                                @forelse($bookings as $b)
                                    <tr>
                                        <td>#{{ $b->id }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($b->service?->name, 22) }}</td>
                                        <td>{{ $b->buyer?->name }}</td>
                                        <td><span class="badge badge-soft-{{ $b->booking_status === 'completed' ? 'success' : 'warning' }}">{{ $b->booking_status }}</span></td>
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
