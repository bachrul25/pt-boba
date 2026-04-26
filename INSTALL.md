# Panduan Instalasi PT BOBA Web Application

## Prasyarat
- PHP 8.3+
- Composer 2.x
- MySQL 8 / MariaDB 10.4+ (production) atau SQLite (dev)
- Web browser modern

## Langkah Instalasi

### 1. Clone repository
```bash
git clone https://github.com/bachrul25/pt-boba.git
cd pt-boba
```

### 2. Install dependencies
```bash
composer install
```

### 3. Konfigurasi environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Setup database

**Untuk dev (SQLite — paling mudah):**
```bash
touch database/database.sqlite
```
Edit `.env`:
```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

**Untuk production (MySQL):**
Edit `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pt_boba
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Migrasi + seed data demo
```bash
php artisan migrate:fresh --seed
```

Seeder akan membuat:
- 1 admin, 3 seller (tsoecha/sokyuut/ponpin), 1 buyer
- 3 founders (Bachrul, Ario, Ellen)
- 3 brands + 12 produk fashion + 4 layanan green tech
- 5 milestones + 6 impact metrics + 3 company documents

### 6. Jalankan aplikasi
```bash
php artisan serve
```
Akses di http://127.0.0.1:8000

## Akun Demo (semua password: `password`)
- Admin: `admin@ptboba.test`
- Seller tsoecha: `seller.tsoecha@ptboba.test`
- Seller sokyuut: `seller.sokyuut@ptboba.test`
- Seller Ponpin: `seller.ponpin@ptboba.test`
- Buyer: `buyer@ptboba.test`

## Upload Aset Visual
Folder `public/images/` siap menerima:
- `logo-boba.png` — logo perusahaan
- `brands/tsoecha.png`, `brands/sokyuut.png`, `brands/ponpin.png`
- `founders/bachrul.jpg`, `founders/ario.jpg`, `founders/ellen.jpg`

## Payment Gateway — Xendit (Sandbox)

Aplikasi terintegrasi dengan **Xendit Invoice API** untuk pembayaran order produk + service request (VA, e-wallet, QRIS, kartu kredit). Mode default: **sandbox/test** sehingga tidak ada uang yang berpindah.

### 1. Dapatkan API key
1. Daftar / login ke https://dashboard.xendit.co/
2. Pastikan toggle kanan-atas berada di **Test Mode** (warna kuning, bukan Live)
3. Buka **Settings → Developers → API Keys** → klik **Generate Secret Key**
   - Pilih permission minimal: `Money-in: Invoice Read & Write`, `Money-in: Balance Read`
   - Format key: `xnd_development_xxxxxxxxxxxxxxxx`
4. Buka **Settings → Developers → Callbacks**
   - Tab **Invoices Paid** → copy **Verification Token** dan paste ke `.env` sebagai `XENDIT_CALLBACK_TOKEN`
   - Field **Callback URL for invoices paid**: isi `https://<host-publik-anda>/webhooks/xendit` (lihat langkah 3 untuk dev lokal)

### 2. Set variabel `.env`
```env
APP_URL=http://127.0.0.1:8000
XENDIT_MODE=sandbox
XENDIT_SECRET_KEY=xnd_development_xxxxxxxxxxxxxxxxxxxxxxxx
XENDIT_CALLBACK_TOKEN=your_invoice_callback_verification_token
XENDIT_INVOICE_DURATION=86400
```

### 3. Webhook untuk dev lokal (ngrok)
Xendit perlu memanggil URL publik untuk konfirmasi pembayaran. Untuk dev lokal:
```bash
ngrok http 8000
# lalu salin https-url-nya, mis. https://abcd-1234.ngrok-free.app
```
Set di Xendit dashboard:
- Callback URL: `https://abcd-1234.ngrok-free.app/webhooks/xendit`
- Klik **Test and Save**

### 4. Migrasi schema payment
Migration tambahan akan menambah kolom `payment_provider`, `payment_invoice_id`, `payment_status`, `payment_url`, `paid_at` di tabel `orders` dan `service_requests`. Cukup jalankan:
```bash
php artisan migrate
```
(atau `migrate:fresh --seed` jika ingin reset penuh).

### 5. Test flow pembayaran (sandbox)
1. Login sebagai `buyer@ptboba.test` / `password`
2. Belanja produk → checkout → buka `/buyer/orders`
3. Klik tombol **Bayar Sekarang** → akan redirect ke Xendit Invoice page
4. Pilih metode pembayaran sandbox:
   - **VA**: `BCA / BNI / BRI / Mandiri / Permata` — pakai test number sesuai dokumentasi Xendit, otomatis simulasi paid
   - **E-wallet OVO/DANA/LinkAja**: pilih lalu klik "Simulate" di sandbox
   - **QRIS**: scan dummy / klik "Simulate paid"
5. Setelah simulasi paid:
   - Webhook akan hit `/webhooks/xendit`
   - Kolom `payment_status` jadi `PAID`, `paid_at` terisi, status order ikut `paid`
6. Reload `/buyer/orders` → badge `PAID` muncul; admin bisa lihat di `/admin/orders` (kolom Pembayaran)

### 6. Reference dokumentasi
- Invoice API: https://docs.xendit.co/invoice
- Test simulation: https://docs.xendit.co/xenplatform/test-payments
- Webhook signature: https://docs.xendit.co/xenplatform/webhooks

## Struktur Routing
Semua routing di `routes/web.php` langsung ke Livewire Component (tanpa Controller).
Lihat `routes/web.php` untuk daftar lengkap.
