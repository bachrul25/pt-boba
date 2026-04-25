<div class="container">
    <div class="auth-card" style="max-width: 640px;">
        <div class="text-center mb-4">
            <span class="logo-pill logo-pill-lg" style="background: linear-gradient(135deg,#f97316,#eab308);">B</span>
            <h3 class="fw-bold mt-3 mb-0">Register Seller</h3>
            <p class="text-muted small">Jadi mitra PT BOBA untuk brand fashion atau layanan tos2bro</p>
        </div>
        <form wire:submit="register">
            <h6 class="fw-bold mb-3 text-uppercase small text-success">Data Akun</h6>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small">Nama Lengkap</label>
                    <input wire:model="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Email</label>
                    <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label small">No. Telepon</label>
                    <input wire:model="phone" class="form-control @error('phone') is-invalid @enderror">
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Alamat</label>
                    <input wire:model="address" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Password</label>
                    <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Konfirmasi Password</label>
                    <input type="password" wire:model="password_confirmation" class="form-control">
                </div>
            </div>

            <h6 class="fw-bold mb-3 text-uppercase small text-warning">Data Toko</h6>
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label small">Nama Toko</label>
                    <input wire:model="shop_name" class="form-control @error('shop_name') is-invalid @enderror">
                    @error('shop_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label small">Deskripsi Toko</label>
                    <textarea wire:model="shop_description" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label small">Alamat Toko</label>
                    <textarea wire:model="shop_address" class="form-control" rows="2"></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-boba-accent w-100 mt-4"><i class="bi bi-shop"></i> Register Seller</button>
        </form>
        <hr class="my-4">
        <div class="text-center small">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-success fw-semibold">Login</a>
        </div>
    </div>
</div>
