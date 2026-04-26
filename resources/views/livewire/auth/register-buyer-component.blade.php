<div class="py-5 bg-boba-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <img src="{{ asset('images/logo-boba.png') }}" alt="PT BOBA" class="logo-pill" style="width:64px;height:64px;border-radius:14px;">
                            <h3 class="fw-bold text-boba mt-3 mb-1">Daftar Buyer</h3>
                            <small class="text-secondary">Belanja produk fashion &amp; pesan layanan green tech.</small>
                        </div>
                        <form wire:submit="register" class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Nama Lengkap *</label>
                                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Email *</label>
                                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Telepon</label>
                                <input type="text" wire:model="phone" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Alamat</label>
                                <textarea wire:model="address" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Password *</label>
                                <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Konfirmasi Password *</label>
                                <input type="password" wire:model="password_confirmation" class="form-control">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-boba w-100"><i class="bi bi-person-plus me-1"></i> Daftar sebagai Buyer</button>
                            </div>
                            <div class="col-12 text-center small">
                                Sudah punya akun? <a href="{{ url('/login') }}" class="fw-semibold">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
