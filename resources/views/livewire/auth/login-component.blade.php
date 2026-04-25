<div class="container">
    <div class="auth-card">
        <div class="text-center mb-4">
            <span class="logo-pill logo-pill-lg">B</span>
            <h3 class="fw-bold mt-3 mb-0">Login PT BOBA</h3>
            <p class="text-muted small">Masuk ke akun Anda</p>
        </div>

        <form wire:submit="login">
            <div class="mb-3">
                <label class="form-label small">Email</label>
                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label small">Password</label>
                <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" wire:model="remember" id="rememberMe" class="form-check-input">
                <label for="rememberMe" class="form-check-label small">Ingat saya</label>
            </div>
            <button type="submit" class="btn btn-boba w-100" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="login"><i class="bi bi-box-arrow-in-right"></i> Login</span>
                <span wire:loading wire:target="login">Loading...</span>
            </button>
        </form>

        <hr class="my-4">
        <div class="text-center small">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-success fw-semibold">Register Buyer</a>
            ·
            <a href="{{ route('seller.register') }}" class="text-warning fw-semibold">Register Seller</a>
        </div>
        <div class="text-center small mt-2">
            <a href="{{ route('landing') }}" class="text-muted">&larr; Kembali ke Home</a>
        </div>
    </div>
</div>
