# PT Bikin Orang Bahagia (PT BOBA)

Aplikasi web profesional untuk **PT Bikin Orang Bahagia (PT BOBA)** — perusahaan multi-sektor yang menggabungkan industri tekstil, fashion brand (**tsoecha.co**, **sokyuut**), dan layanan green technology (**Ponpin**) dalam satu ekosistem terintegrasi.

Aplikasi ini berfungsi sebagai:

1. **Company Profile** — landing page profesional, halaman investor relations, sustainability/ESG section.
2. **Marketplace** — pembelian produk fashion + pemesanan layanan green technology.
3. **Investor Portal** — peluang investasi, key metrics, milestones, company documents.

## Teknologi

- **Laravel 12** + **Livewire 3**
- **Bootstrap 5** + **Bootstrap Icons** (CDN)
- **MySQL** (production) / SQLite (dev)
- Auth manual via Livewire (tanpa Laravel Breeze / Laravel UI)
- **Tanpa Controller** — semua logic di Livewire Component, routing langsung ke component di `routes/web.php`

## Struktur Halaman

| Path                                | Component                            | Akses          |
| ----------------------------------- | ------------------------------------ | -------------- |
| `/`                                 | LandingPageComponent                 | Public         |
| `/home`                             | HomePageComponent                    | Public         |
| `/investor-relations`               | InvestorRelationsComponent           | Public         |
| `/login`                            | Auth/LoginComponent                  | Guest          |
| `/register`                         | Auth/RoleSelectComponent             | Guest          |
| `/register/buyer`                   | Auth/RegisterBuyerComponent          | Guest          |
| `/register/seller`                  | Auth/RegisterSellerComponent         | Guest          |
| `/admin/...`                        | Admin\* (11 component CRUD)          | Admin          |
| `/buyer/...`                        | Buyer\* (5 component)                | Buyer          |
| `/seller/...`                       | Seller\* (4 component)               | Seller         |

## Setup Lokal

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan serve
```

## Demo Accounts (semua password: `password`)

| Role   | Email                          |
| ------ | ------------------------------ |
| Admin  | `admin@ptboba.test`            |
| Seller | `seller.tsoecha@ptboba.test`   |
| Seller | `seller.sokyuut@ptboba.test`   |
| Seller | `seller.ponpin@ptboba.test`    |
| Buyer  | `buyer@ptboba.test`            |

## Aset Logo

Project menggunakan placeholder logo (huruf "B" di pill). Upload logo asli ke:

- `public/images/logo-boba.png` — logo utama PT BOBA
- `public/images/brands/tsoecha.png`, `sokyuut.png`, `ponpin.png` — logo brand
- `public/images/founders/bachrul.jpg`, `ario.jpg`, `ellen.jpg` — foto pendiri
