# PT BOBA — Test Report (PR #1)

**App**: Laravel 12 + Livewire 3 web application for PT Bikin Orang Bahagia
**Tested against**: local `php artisan serve` on http://127.0.0.1:8001 with seeded SQLite DB
**PR**: https://github.com/bachrul25/pt-boba/pull/1
**Devin session**: https://app.devin.ai/sessions/a59a8f4f78b64afb88d18cdc424dcc27

## Summary

All 6 planned tests passed. End-to-end golden path verified: landing page → buyer registration → cart + checkout → admin login → admin dashboard CRUD → unauthenticated access guard → investor inquiry submission persisted.

| # | Test | Result |
| - | ---- | ------ |
| 1 | Landing page renders all required sections | passed |
| 2 | Buyer registration via Livewire + auto-login | passed |
| 3 | Buyer browse + add to cart + checkout creates order | passed |
| 4 | Seeded admin login + admin dashboard with all menus | passed |
| 5 | Regression: `/admin` rejects unauthenticated, redirects to `/login` | passed |
| 6 | Investor inquiry submission persists to admin panel | passed |

No failures. No blocked tests.

## Evidence

### Test 1 — Landing page

| 🟢 Hero section | 🟢 Founders section |
|---|---|
| ![Hero](https://app.devin.ai/attachments/9ef7bc4f-3d8d-4461-8a39-82ab0771f3a9/screenshot_f029a6c9c7af4e4589cca4d2ad04926b.png) | ![Founders](https://app.devin.ai/attachments/47d8f0d7-75d9-4dd4-8b8d-6efec7ab5a3a/screenshot_315df240c7a2487aa989dc962044ebd3.png) |
| Hero title "PT Bikin Orang Bahagia" + 3 brand stats card | Pendiri PT BOBA: **Bachrul Ullum Assrori**, **Ario Putra Bakti**, **Ellen Sinta Budirahayu** with title + description |

| 🟢 Investor section |
|---|
| ![Investor](https://app.devin.ai/attachments/107adb05-c7fe-4e0b-84ce-b0a05f2343a4/screenshot_e4df3b719522401fa21170cb9330f24d.png) |
| "Peluang Investasi PT BOBA" + "Komitmen Hijau Lewat Ponpin" (Sustainability/ESG with 4 service category cards) |

### Test 2 — Buyer registration

| 🟢 Auto-logged into /buyer |
|---|
| ![Buyer dashboard](https://app.devin.ai/attachments/191f8939-ac05-4063-8366-b99fb1db5005/screenshot_da119d751e764257ad83892356cd8e98.png) |
| Topbar shows "Test Buyer Demo" + "BUYER" badge; sidebar shows Browse Products / Pesan Layanan / My Orders / My Service Requests |

### Test 3 — Cart + checkout

| 🟢 Cart shows added product | 🟢 Order created |
|---|---|
| ![Cart](https://app.devin.ai/attachments/076f1086-05d2-4b0f-8439-8dc16d972f2f/screenshot_137102223d0a41208a0cd150f9cd1b75.png) | ![Orders](https://app.devin.ai/attachments/7e670ab9-c644-439d-9397-283ecbdddd26/screenshot_7f8d4ae6a6514ce98205058999155b00.png) |
| "Kaos Tsoecha Classic" × 1 = Rp 149.000 in cart with checkout form | Order **BOBA-6H0E0WJN** created, status **pending**, Rp 149.000, Kaos Tsoecha Classic × 1 |

### Test 4 — Admin dashboard

| 🟢 Admin overview | 🟢 Admin Products (CRUD list) |
|---|---|
| ![Admin dashboard](https://app.devin.ai/attachments/c29dafdf-98ab-43f0-8d26-575caa07f8e5/screenshot_72c854ce485441ed95f5289d5f73cb40.png) | ![Admin products](https://app.devin.ai/attachments/b8296575-3e49-46e1-a3c2-333c77cd77cc/screenshot_1ed4be7101354c209f551b9150cf8775.png) |
| Stats: Buyer 2, Seller 3, Brand 3, Produk 12, Layanan 4, Order 1; sidebar has all 11 menus including Investor section | 12 seeded products with brand, seller, price, stock, status badge, edit/delete buttons; pagination "1-10 of 12" |

### Test 5 — Regression: unauth `/admin`

| 🟢 Redirected to /login |
|---|
| ![Login redirect](https://app.devin.ai/attachments/2ca362a4-e39e-479b-aa5d-6ca34bb6be3c/screenshot_03f76861da204eb7b7d9f183a1649a06.png) |
| URL changed to `/login`, login form rendered |

### Test 6 — Investor inquiry submission

| 🟢 Form submitted | 🟢 Persisted to admin |
|---|---|
| ![Form success](https://app.devin.ai/attachments/0c3c37a6-6462-4711-8b15-d5b9e35485d3/screenshot_191ad73df92c451484e2f54d212c9602.png) | ![Admin inquiry](https://app.devin.ai/attachments/f47290fe-ec47-4994-ad6c-4f9636a1cc3b/screenshot_f3cdc28df88b44d58a931b0a2a4ea4bb.png) |
| Green flash "Inquiry Anda telah kami terima…" + form cleared | Admin dashboard shows Investor Inquiry count went 0 → 1; "Investor Demo / investor.demo@example.com / Tertarik investasi seri A di sektor green technology Ponpin." with `new` badge |

## Notes
- No CI workflow configured on the repo, so no automated checks to wait for. Pint (Laravel coding style) was run locally before push and reports `passed`.
- Logo placeholders (huruf "B" di pill) — sesuai kesepakatan; user akan upload logo asli ke `public/images/`.
