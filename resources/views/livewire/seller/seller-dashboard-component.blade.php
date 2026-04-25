<div class="container-fluid">
    <div class="row g-0">
        @include('partials.seller-sidebar')
        <main class="col-md-9 col-lg-10 p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h3 class="fw-bold mb-1">Seller Dashboard</h3>
                    <p class="text-muted mb-0">Halo {{ auth()->user()->name }}, selamat datang di mitra PT BOBA.</p>
                </div>
                <span class="badge bg-warning text-dark fs-6"><i class="bi bi-shop"></i> Seller</span>
            </div>

            @if(! $profile || ! $profile->is_completed)
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i> Profil toko Anda belum lengkap.
                    <a href="{{ route('seller.profile') }}" class="alert-link">Lengkapi profil</a> agar bisa mulai berjualan.
                </div>
            @endif
            @if($profile && $profile->status === 'pending')
                <div class="alert alert-info">
                    <i class="bi bi-hourglass-split"></i> Toko Anda <strong>menunggu approval admin</strong>. Anda masih bisa mengelola produk/layanan, namun akan terlihat sebagai seller pending.
                </div>
            @elseif($profile && $profile->status === 'rejected')
                <div class="alert alert-danger">
                    <i class="bi bi-x-circle"></i> Registrasi seller Anda ditolak. Silakan hubungi admin.
                </div>
            @endif

            <div class="row g-3 mb-4">
                @php
                    $cards = [
                        ['label'=>'Total Produk','val'=>$stats['products'],'icon'=>'bag','color'=>'info'],
                        ['label'=>'Total Layanan','val'=>$stats['services'],'icon'=>'recycle','color'=>'success'],
                        ['label'=>'Order Produk','val'=>$stats['orders'],'icon'=>'cart','color'=>'warning'],
                        ['label'=>'Booking Layanan','val'=>$stats['bookings'],'icon'=>'calendar','color'=>'primary'],
                    ];
                @endphp
                @foreach($cards as $c)
                    <div class="col-md-6 col-lg-3">
                        <div class="stat-card h-100">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-muted small text-uppercase">{{ $c['label'] }}</div>
                                    <div class="stat-num text-{{ $c['color'] }}">{{ number_format($c['val']) }}</div>
                                </div>
                                <i class="bi bi-{{ $c['icon'] }} fs-3 text-{{ $c['color'] }}"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small text-uppercase">Total Pendapatan</div>
                        <div class="stat-num text-success">Rp {{ number_format($stats['revenue'],0,',','.') }}</div>
                    </div>
                    <i class="bi bi-coin fs-1 text-success"></i>
                </div>
            </div>
        </main>
    </div>
</div>
