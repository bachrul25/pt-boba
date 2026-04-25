<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PT Bikin Orang Bahagia (PT BOBA)')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --boba-primary: #16a34a;
            --boba-primary-dark: #15803d;
            --boba-accent: #f97316;
            --boba-dark: #0f172a;
            --boba-muted: #64748b;
        }
        body { font-family: 'Inter', system-ui, sans-serif; background: #f8fafc; color: #0f172a; }
        .navbar-boba { background: #ffffff; border-bottom: 1px solid #e2e8f0; }
        .navbar-boba .nav-link { font-weight: 500; color: #334155; }
        .navbar-boba .nav-link:hover, .navbar-boba .nav-link.active { color: var(--boba-primary); }
        .logo-pill {
            display: inline-flex; align-items: center; justify-content: center;
            width: 40px; height: 40px; border-radius: 12px;
            background: linear-gradient(135deg, var(--boba-primary), var(--boba-accent));
            color: #fff; font-weight: 800; font-size: 1.1rem;
            box-shadow: 0 4px 14px rgba(22,163,74,.35);
        }
        .logo-pill-lg { width: 64px; height: 64px; border-radius: 20px; font-size: 1.8rem; }
        .btn-boba { background: var(--boba-primary); color: #fff; border: none; }
        .btn-boba:hover { background: var(--boba-primary-dark); color: #fff; }
        .btn-boba-accent { background: var(--boba-accent); color: #fff; border: none; }
        .btn-boba-accent:hover { background: #ea580c; color: #fff; }
        .hero-boba {
            background: linear-gradient(135deg, rgba(22,163,74,.08), rgba(249,115,22,.08)), #ffffff;
            padding: 4.5rem 0;
        }
        .section-title { font-weight: 800; letter-spacing: -.02em; }
        .section-eyebrow { color: var(--boba-primary); font-weight: 600; text-transform: uppercase; letter-spacing: .08em; font-size: .8rem; }
        .card-boba { border: 1px solid #e2e8f0; border-radius: 18px; transition: transform .2s, box-shadow .2s; }
        .card-boba:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(15,23,42,.08); }
        .brand-card { border-radius: 18px; overflow: hidden; border: 1px solid #e2e8f0; background: #fff; }
        .founder-photo {
            width: 140px; height: 140px; border-radius: 50%;
            background: linear-gradient(135deg, #e0f2fe, #fef3c7);
            display: flex; align-items: center; justify-content: center;
            font-size: 3rem; color: #0f172a; font-weight: 700;
            margin: 0 auto 1rem;
            background-size: cover; background-position: center;
        }
        .sidebar-boba { min-height: calc(100vh - 62px); background: #ffffff; border-right: 1px solid #e2e8f0; padding: 1.5rem 0; }
        .sidebar-boba .nav-link { color: #475569; border-radius: 10px; margin: 2px 10px; padding: .55rem .9rem; }
        .sidebar-boba .nav-link:hover { background: #f1f5f9; color: var(--boba-primary); }
        .sidebar-boba .nav-link.active { background: var(--boba-primary); color: #fff; }
        .stat-card { border-radius: 16px; padding: 1.2rem 1.4rem; background: #fff; border: 1px solid #e2e8f0; }
        .stat-card .stat-num { font-size: 1.8rem; font-weight: 800; }
        footer.boba-footer { background: #0f172a; color: #cbd5e1; padding: 3rem 0 1.5rem; }
        footer.boba-footer a { color: #e2e8f0; text-decoration: none; }
        footer.boba-footer a:hover { color: #fff; }
        .badge-soft-success { background: #dcfce7; color: #166534; }
        .badge-soft-warning { background: #fef3c7; color: #92400e; }
        .badge-soft-danger { background: #fee2e2; color: #991b1b; }
        .badge-soft-info { background: #dbeafe; color: #1e40af; }
        .badge-soft-secondary { background: #e2e8f0; color: #334155; }
        .product-img, .service-img { height: 190px; background: #f1f5f9; background-size: cover; background-position: center; border-radius: 12px 12px 0 0; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 2.2rem; }
        .auth-card { max-width: 460px; margin: 3rem auto; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; padding: 2.2rem; box-shadow: 0 10px 40px rgba(15,23,42,.06); }
    </style>
    @livewireStyles
</head>
<body>
    @php
        $user = auth()->user();
        $role = $user?->role;
    @endphp

    @if(! ($hideNavbar ?? false))
        @include('partials.navbar', ['role' => $role])
    @endif

    <main>
        {{ $slot }}
    </main>

    @if(! ($hideFooter ?? false))
        @include('partials.footer')
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts

    @if (session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
            <div class="toast show align-items-center text-bg-success border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">{{ session('success') }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
            <div class="toast show align-items-center text-bg-danger border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">{{ session('error') }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    @endif
</body>
</html>
