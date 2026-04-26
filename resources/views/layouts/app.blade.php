<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PT Bikin Orang Bahagia (PT BOBA)')</title>
    <meta name="description" content="PT Bikin Orang Bahagia (PT BOBA) — Industri Tekstil, Produk Olahan, Fashion Brand (tsoecha.co, sokyuut), dan Layanan Green Technology (Ponpin).">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --boba-primary: #166152;
            --boba-secondary: #f5b400;
            --boba-accent: #2dbf95;
            --boba-dark: #0c3f36;
            --boba-light: #f1f8f5;
        }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            color: #1f2937;
            background: #ffffff;
        }
        .text-boba { color: var(--boba-primary) !important; }
        .bg-boba { background: var(--boba-primary) !important; color: #fff; }
        .bg-boba-dark { background: var(--boba-dark) !important; color: #fff; }
        .bg-boba-light { background: var(--boba-light) !important; }
        .btn-boba { background: var(--boba-primary); color: #fff; border: none; }
        .btn-boba:hover { background: var(--boba-dark); color: #fff; }
        .btn-outline-boba { border: 1px solid var(--boba-primary); color: var(--boba-primary); background: transparent; }
        .btn-outline-boba:hover { background: var(--boba-primary); color: #fff; }
        .btn-accent { background: var(--boba-secondary); color: #fff; border: none; }
        .btn-accent:hover { background: #d98b08; color: #fff; }
        .navbar-boba { background: rgba(255,255,255,0.95); backdrop-filter: saturate(180%) blur(8px); border-bottom: 1px solid rgba(22,97,82,.12); }
        .navbar-boba .nav-link { color: #1f2937; font-weight: 500; }
        .navbar-boba .nav-link:hover, .navbar-boba .nav-link.active { color: var(--boba-primary); }
        .hero {
            background: linear-gradient(135deg, var(--boba-dark) 0%, var(--boba-primary) 55%, #2dbf95 100%);
            color: #fff; position: relative; overflow: hidden;
        }
        .hero::before {
            content: ""; position: absolute; right: -120px; top: -120px; width: 380px; height: 380px;
            background: radial-gradient(circle, rgba(245,180,0,.40), transparent 70%); border-radius: 50%;
        }
        .hero::after {
            content: ""; position: absolute; left: -100px; bottom: -120px; width: 320px; height: 320px;
            background: radial-gradient(circle, rgba(45,191,149,.40), transparent 70%); border-radius: 50%;
        }
        .logo-pill {
            display: inline-flex; align-items: center; justify-content: center;
            width: 44px; height: 44px; border-radius: 12px;
            background: linear-gradient(135deg, var(--boba-primary), var(--boba-accent));
            color: #fff; font-weight: 700; letter-spacing: .5px;
            object-fit: cover; overflow: hidden;
        }
        img.logo-pill { padding: 0; }
        .brand-logo {
            width: 100%; aspect-ratio: 4 / 3; object-fit: contain;
            background: #fff; border-radius: 12px; padding: .75rem;
            border: 1px solid #eef2f7;
        }
        .brand-logo-sm {
            width: 56px; height: 56px; object-fit: contain;
            background: #fff; border-radius: 12px; padding: .35rem;
            border: 1px solid #eef2f7;
        }
        .brand-card { transition: transform .25s ease, box-shadow .25s ease; }
        .brand-card:hover { transform: translateY(-4px); box-shadow: 0 14px 30px rgba(2,12,27,.10); }
        .founder-card { transition: transform .25s ease, box-shadow .25s ease; border: 1px solid #eef2f7; }
        .founder-card:hover { transform: translateY(-4px); box-shadow: 0 16px 36px rgba(2,12,27,.12); }
        .founder-photo {
            width: 140px; height: 140px; object-fit: cover; border-radius: 50%;
            border: 4px solid #fff; box-shadow: 0 8px 22px rgba(2,12,27,.12);
            background: #e9eef5;
        }
        .stat-card { border: 1px solid #e9ecef; border-radius: 16px; }
        .stat-value { font-size: 2.2rem; font-weight: 800; color: var(--boba-primary); line-height: 1; }
        .section-title { font-weight: 800; color: var(--boba-dark); }
        .section-subtitle { color: #5b6b80; }
        .ecosystem-node {
            border-radius: 14px; padding: 1.25rem; background: #fff;
            border: 1px solid #e9ecef; height: 100%;
        }
        .timeline { position: relative; padding-left: 2rem; }
        .timeline::before {
            content: ""; position: absolute; left: .65rem; top: 0; bottom: 0;
            width: 2px; background: linear-gradient(var(--boba-primary), var(--boba-accent));
        }
        .timeline-item { position: relative; padding-bottom: 1.5rem; }
        .timeline-item::before {
            content: ""; position: absolute; left: -1.55rem; top: .35rem;
            width: 14px; height: 14px; border-radius: 50%;
            background: var(--boba-secondary); box-shadow: 0 0 0 4px rgba(245,180,0,.18);
        }
        footer {
            background: var(--boba-dark); color: #cbd5e1;
        }
        footer a { color: #cbd5e1; text-decoration: none; }
        footer a:hover { color: #fff; }
        .product-card img { height: 180px; object-fit: cover; }
        .placeholder-img {
            width: 100%; height: 180px; display:flex; align-items:center; justify-content:center;
            background: linear-gradient(135deg,#f1f5f9,#e2e8f0); color:#94a3b8; font-size:2rem;
        }
        .esg-badge {
            display: inline-flex; align-items: center; gap: .35rem;
            background: rgba(52,211,153,.18); color:#065f46; padding: .35rem .65rem;
            border-radius: 999px; font-weight: 600; font-size: .85rem;
        }
    </style>
    @livewireStyles
    @stack('head')
</head>
<body>
    @include('partials.navbar')

    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
    @stack('scripts')
</body>
</html>
