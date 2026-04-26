# PT BOBA — Test Plan (PR #1)

**App**: Laravel 12 + Livewire 3 web application for PT Bikin Orang Bahagia
**URL under test**: http://127.0.0.1:8001 (local `php artisan serve` with seeded SQLite DB)
**PR**: https://github.com/bachrul25/pt-boba/pull/1

## What changed (user-visible)
Brand-new application — landing page (company profile + investor sections), Livewire-based auth, marketplace with cart/checkout, Ponpin service-request flow, admin/buyer/seller dashboards. Routing 100% via `routes/web.php` directly to Livewire components (no Controllers).

## Primary flow & assertions

### Test 1 — It should render the landing page with all required sections
- Navigate to `/`
- **Pass criteria** (visible in screenshot):
  - Hero heading contains text **"PT Bikin Orang Bahagia"**
  - Brand cards display **"tsoecha.co"**, **"sokyuut"**, and **"Ponpin"** (3 brand pills/cards)
  - "Struktur Perusahaan" / "Pendiri" section shows the names **"Bachrul Ullum Assrori"**, **"Ario Putra Bakti"**, **"Ellen Sinta Budirahayu"**
  - At least one investor-oriented section heading visible (e.g. "Investment Opportunity" / "Sustainability" / "Vision for Growth")
  - Navbar contains **Login** and **Register** links

### Test 2 — It should accept a buyer registration via Livewire and auto-login
- Click **Register** in navbar → click **Buyer** card on `/register` → fill new buyer form (unique email, password, confirmation), submit
- **Pass criteria**:
  - After submit, URL is `/buyer` (buyer dashboard)
  - Topbar shows new buyer name + role badge "buyer"
  - Sidebar shows **Browse Products**, **Pesan Layanan**, **My Orders**, **My Service Requests**

### Test 3 — It should let a buyer browse, add to cart, and create an order via Livewire
- From buyer dashboard, click **Browse Products**
- Click "Tambah ke Cart" on at least one product → cart panel updates (qty/total > 0)
- Fill shipping address + phone, click **Checkout**
- **Pass criteria**:
  - Cart shows the product with quantity ≥ 1 and a non-zero total before checkout
  - After checkout, redirected to `/buyer/orders`
  - Orders list shows a new order with `BOBA-` prefixed order_number and status badge

### Test 4 — It should authenticate the seeded admin and load admin dashboard with all menus
- Logout buyer (top-right) → go to `/login` → login `admin@ptboba.test` / `password`
- **Pass criteria**:
  - Redirected to `/admin`
  - Stats cards show non-zero counts: Buyers, Sellers, Products, Services
  - Sidebar contains **Founders**, **Brands**, **Products**, **Services (Ponpin)**, **Sellers**, **Transactions**, **Investor Inquiries**, **Company Documents**, **Milestones**, **Impact Metrics**

### Test 5 — Regression: It should reject unauthenticated access to /admin
- Logout admin → directly navigate to `/admin`
- **Pass criteria**: Redirected to `/login` (302 → /login form visible)

### Test 6 — Regression: It should accept investor inquiry submission on /investor-relations
- Navigate to `/investor-relations` → fill inquiry form (name/email/message minimum) → submit
- **Pass criteria**: Success flash/message visible; (back-end side-effect verified later via admin → Investor Inquiries menu shows the new entry)

## Out of scope
- CI: repo has no CI workflow yet, so no checks to wait for
- Real logo/photo assets: still placeholder per user agreement
- Payment processing: not part of spec

## Code references informing this plan
- `routes/web.php` (all 30+ routes wiring directly to Livewire components)
- `app/Livewire/LandingPageComponent.php` — landing data
- `app/Livewire/Auth/RegisterBuyerComponent.php` — register flow
- `app/Livewire/Buyer/BrowseComponent.php` — cart + checkout
- `app/Livewire/Admin/DashboardComponent.php` — admin stats
- `app/Livewire/InvestorRelationsComponent.php` — inquiry form
