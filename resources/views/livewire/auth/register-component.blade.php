<div class="container">
    <div class="auth-card" style="max-width: 560px;">
        <div class="text-center mb-4">
            <span class="logo-pill logo-pill-lg">B</span>
            <h3 class="fw-bold mt-3 mb-0">Register Buyer</h3>
            <p class="text-muted small">Belanja fashion &amp; pesan jasa tos2bro</p>
        </div>
        <form wire:submit="register">
            <div class="row g-3">
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
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Alamat</label>
                    <input wire:model="address" class="form-control @error('address') is-invalid @enderror">
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
            <button type="submit" class="btn btn-boba w-100 mt-4"><i class="bi bi-person-plus"></i> Register Buyer</button>
        </form>
        <hr class="my-4">
        <div class="text-center small">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-success fw-semibold">Login</a>
        </div>
    </div>
</div>
