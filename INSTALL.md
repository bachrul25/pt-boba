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

## Struktur Routing
Semua routing di `routes/web.php` langsung ke Livewire Component (tanpa Controller).
Lihat `routes/web.php` untuk daftar lengkap.
