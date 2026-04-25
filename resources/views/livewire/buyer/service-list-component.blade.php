<div class="container py-4">
    <h3 class="fw-bold mb-1"><i class="bi bi-recycle text-success"></i> Layanan tos2bro</h3>
    <p class="text-muted mb-4">Green technology services untuk rumah, bisnis, dan industri.</p>

    <div class="card-boba p-3 mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input wire:model.live.debounce.400ms="search" class="form-control" placeholder="Cari layanan...">
            </div>
            <div class="col-md-4">
                <select wire:model.live="service_type" class="form-select">
                    <option value="">Semua Jenis</option>
                    <option value="pengambilan_sampah">Pengambilan Sampah</option>
                    <option value="pengelolaan_sampah">Pengelolaan Sampah</option>
                    <option value="pengolahan_sampah_organik">Pengolahan Sampah Organik</option>
                    <option value="bahan_bakar_kendaraan">Bahan Bakar Kendaraan</option>
                </select>
            </div>
            <div class="col-md-4">
                <input wire:model.live.debounce.400ms="category" class="form-control" placeholder="Kategori...">
            </div>
        </div>
    </div>

    <div class="row g-4">
        @forelse($services as $s)
            <div class="col-md-6 col-lg-4">
                <div class="card-boba h-100 p-3">
                    <div class="service-img mb-3 rounded-3">
                        @if($s->image)
                            <div style="background-image:url('{{ asset('storage/'.$s->image) }}'); background-size:cover; background-position:center; width:100%; height:100%; border-radius:12px;"></div>
                        @else
                            <i class="bi bi-recycle text-success" style="font-size:3rem;"></i>
                        @endif
                    </div>
                    <h6 class="fw-bold">{{ $s->name }}</h6>
                    <span class="badge badge-soft-success mb-2">{{ str_replace('_',' ', $s->service_type) }}</span>
                    <p class="small text-muted">{{ \Illuminate\Support\Str::limit($s->description, 90) }}</p>
                    <div class="small text-muted"><i class="bi bi-shop"></i> {{ $s->seller?->name }}</div>
                    <div class="fs-6 fw-bold text-success mt-auto">Mulai Rp {{ number_format($s->price,0,',','.') }}</div>
                    <a href="{{ route('buyer.service.booking', $s->id) }}" class="btn btn-boba btn-sm w-100 mt-2"><i class="bi bi-calendar-plus"></i> Booking</a>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">Belum ada layanan tersedia.</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $services->links() }}</div>
</div>
