<div class="py-5 bg-boba-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <img src="{{ asset('images/logo-boba.png') }}" alt="PT BOBA" class="logo-pill" style="width:64px;height:64px;border-radius:14px;">
                            <h3 class="fw-bold text-boba mt-3 mb-1">Login PT BOBA</h3>
                            <small class="text-secondary">Masuk ke dashboard Anda.</small>
                        </div>
                        <form wire:submit="login" class="d-flex flex-column gap-3">
                            <div>
                                <label class="form-label small fw-semibold">Email</label>
                                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@domain.com">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div>
                                <label class="form-label small fw-semibold">Password</label>
                                <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model="remember" id="remember">
                                <label class="form-check-label small" for="remember">Ingat saya</label>
                            </div>
                            <button class="btn btn-boba">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </button>
                            <div class="text-center small">
                                Belum punya akun? <a href="{{ url('/register') }}" class="fw-semibold">Daftar di sini</a>
                            </div>
                        </form>
                        <hr class="my-4">
                        <div class="small text-secondary">
                            <strong>Demo accounts:</strong><br>
                            Admin: <code>admin@ptboba.test</code> / <code>password</code><br>
                            Seller: <code>seller.tsoecha@ptboba.test</code> / <code>password</code><br>
                            Buyer: <code>buyer@ptboba.test</code> / <code>password</code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
