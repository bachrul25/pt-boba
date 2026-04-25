<div class="container">
    <div class="auth-card">
        <div class="text-center mb-4">
            <span class="logo-pill logo-pill-lg" style="background: linear-gradient(135deg,#0f172a,#334155);">B</span>
            <h3 class="fw-bold mt-3 mb-0">Admin Login</h3>
            <p class="text-muted small">Dashboard administrator PT BOBA</p>
        </div>
        <form wire:submit="login">
            <div class="mb-3">
                <label class="form-label small">Email</label>
                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label small">Password</label>
                <input type="password" wire:model="password" class="form-control">
            </div>
            <button class="btn btn-dark w-100"><i class="bi bi-shield-lock"></i> Login Admin</button>
        </form>
        <div class="text-center small mt-3">
            <a href="{{ route('login') }}" class="text-muted">Login sebagai Buyer/Seller</a>
        </div>
    </div>
</div>
