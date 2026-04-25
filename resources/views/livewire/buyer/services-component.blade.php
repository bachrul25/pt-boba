@section('page-title', 'Pesan Layanan Ponpin')
<div>
    @if(session('msg'))<div class="alert alert-success py-2">{{ session('msg') }}</div>@endif

    <div class="row g-3">
        <div class="col-lg-{{ $selectedService ? 7 : 12 }}">
            <div class="row g-3">
                @forelse($services as $s)
                    <div class="col-md-6 col-lg-{{ $selectedService ? 6 : 4 }}">
                        <div class="ecosystem-node h-100 d-flex flex-column">
                            <i class="bi bi-recycle text-success fs-3"></i>
                            <h6 class="fw-bold mt-2">{{ $s->name }}</h6>
                            <small class="esg-badge align-self-start">{{ $s->category }}</small>
                            <p class="small text-secondary mt-2">{{ $s->description }}</p>
                            <div class="fw-bold text-boba mt-auto">Rp {{ number_format($s->price, 0, ',', '.') }} <small class="fw-normal text-secondary">/ {{ $s->unit }}</small></div>
                            <button wire:click="selectService({{ $s->id }})" class="btn btn-sm btn-boba mt-2"><i class="bi bi-send me-1"></i> Pesan Sekarang</button>
                        </div>
                    </div>
                @empty
                    <div class="col-12"><p class="text-secondary text-center py-4">Belum ada layanan.</p></div>
                @endforelse
            </div>
        </div>

        @if($selectedService)
            <div class="col-lg-5">
                <div class="card position-sticky" style="top:90px"><div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-bold mb-0">Form Pemesanan</h6>
                        <button wire:click="cancel" class="btn btn-sm btn-link text-secondary py-0">×</button>
                    </div>
                    <div class="bg-light p-2 rounded mb-3">
                        <strong class="small">{{ $selectedService->name }}</strong><br>
                        <small class="text-boba fw-bold">Rp {{ number_format($selectedService->price, 0, ',', '.') }} / {{ $selectedService->unit }}</small>
                    </div>
                    <form wire:submit="placeRequest" class="d-flex flex-column gap-2">
                        <div><label class="form-label small fw-semibold">Nama Kontak *</label>
                            <input wire:model="contact_name" class="form-control form-control-sm @error('contact_name') is-invalid @enderror">
                            @error('contact_name')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div><label class="form-label small fw-semibold">Telepon *</label>
                            <input wire:model="contact_phone" class="form-control form-control-sm @error('contact_phone') is-invalid @enderror">
                            @error('contact_phone')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div><label class="form-label small fw-semibold">Alamat *</label>
                            <textarea wire:model="address" rows="2" class="form-control form-control-sm @error('address') is-invalid @enderror"></textarea>
                            @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div><label class="form-label small fw-semibold">Tanggal Jadwal</label>
                            <input type="date" wire:model="scheduled_at" class="form-control form-control-sm">
                        </div>
                        <div><label class="form-label small fw-semibold">Catatan</label>
                            <textarea wire:model="notes" rows="2" class="form-control form-control-sm"></textarea>
                        </div>
                        <button class="btn btn-boba"><i class="bi bi-check2-circle me-1"></i> Kirim Permintaan</button>
                    </form>
                </div></div>
            </div>
        @endif
    </div>
</div>
