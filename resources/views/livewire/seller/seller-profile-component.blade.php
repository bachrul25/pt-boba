<div class="container-fluid">
    <div class="row g-0">
        @include('partials.seller-sidebar')
        <main class="col-md-9 col-lg-10 p-4">
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Profil Toko</h3>
                <p class="text-muted">Lengkapi informasi toko Anda.</p>
            </div>

            @if($profile)
                <div class="mb-3">
                    Status seller:
                    <span class="badge badge-soft-{{ match($profile->status){'approved'=>'success','rejected'=>'danger',default=>'warning'} }}">{{ $profile->status ?? 'pending' }}</span>
                    @if($profile->is_completed)
                        <span class="badge badge-soft-success ms-1">Data toko lengkap</span>
                    @endif
                </div>
            @endif

            <div class="card-boba p-4" style="max-width: 720px;">
                <form wire:submit="save">
                    <div class="mb-3">
                        <label class="form-label small">Nama Toko</label>
                        <input wire:model="shop_name" class="form-control @error('shop_name') is-invalid @enderror">
                        @error('shop_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Deskripsi Toko</label>
                        <textarea wire:model="shop_description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Alamat Toko</label>
                        <textarea wire:model="shop_address" class="form-control" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-boba"><i class="bi bi-save"></i> Simpan Profil</button>
                </form>
            </div>
        </main>
    </div>
</div>
