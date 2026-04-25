<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\CompanyDocument;
use App\Models\Founder;
use App\Models\ImpactMetric;
use App\Models\Milestone;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users (Admin, demo Seller, demo Buyer)
        $admin = User::updateOrCreate(
            ['email' => 'admin@ptboba.test'],
            [
                'name' => 'Admin PT BOBA',
                'password' => 'password',
                'role' => 'admin',
                'phone' => '+62 812-0000-0001',
                'address' => 'Kantor Pusat PT BOBA',
                'is_active' => true,
            ]
        );

        $sellerTsoecha = User::updateOrCreate(
            ['email' => 'seller.tsoecha@ptboba.test'],
            [
                'name' => 'Seller Tsoecha',
                'password' => 'password',
                'role' => 'seller',
                'phone' => '+62 812-0000-0002',
                'address' => 'Surabaya',
                'store_name' => 'Tsoecha Official Store',
                'is_active' => true,
            ]
        );

        $sellerSokyuut = User::updateOrCreate(
            ['email' => 'seller.sokyuut@ptboba.test'],
            [
                'name' => 'Seller Sokyuut',
                'password' => 'password',
                'role' => 'seller',
                'phone' => '+62 812-0000-0003',
                'address' => 'Surabaya',
                'store_name' => 'Sokyuut Official Store',
                'is_active' => true,
            ]
        );

        $sellerPonpin = User::updateOrCreate(
            ['email' => 'seller.ponpin@ptboba.test'],
            [
                'name' => 'Seller Ponpin',
                'password' => 'password',
                'role' => 'seller',
                'phone' => '+62 812-0000-0004',
                'address' => 'Jakarta',
                'store_name' => 'Ponpin Green Tech',
                'is_active' => true,
            ]
        );

        $buyer = User::updateOrCreate(
            ['email' => 'buyer@ptboba.test'],
            [
                'name' => 'Demo Buyer',
                'password' => 'password',
                'role' => 'buyer',
                'phone' => '+62 812-0000-0099',
                'address' => 'Jl. Demo No. 1',
                'is_active' => true,
            ]
        );

        // Founders
        $founders = [
            [
                'name' => 'Bachrul Ullum Assrori',
                'position' => 'Direktur',
                'description' => 'Bertanggung jawab atas pengambilan keputusan utama, arah bisnis perusahaan, pengembangan brand, kerja sama, serta pengawasan operasional PT BOBA.',
                'order_index' => 1,
            ],
            [
                'name' => 'Ario Putra Bakti',
                'position' => 'Komisaris Utama',
                'description' => 'Bertanggung jawab dalam pengawasan utama terhadap kebijakan perusahaan, memberikan arahan strategis, serta memastikan perusahaan berjalan sesuai tujuan perusahaan.',
                'order_index' => 2,
            ],
            [
                'name' => 'Ellen Sinta Budirahayu',
                'position' => 'Komisaris',
                'description' => 'Bertanggung jawab membantu pengawasan perusahaan, memberikan masukan terhadap pengembangan bisnis, dan mendukung keberlanjutan perusahaan.',
                'order_index' => 3,
            ],
        ];
        foreach ($founders as $f) {
            Founder::updateOrCreate(['name' => $f['name']], $f);
        }

        // Brands
        $tsoecha = Brand::updateOrCreate(
            ['slug' => 'tsoecha-co'],
            [
                'name' => 'tsoecha.co',
                'type' => 'fashion',
                'category' => 'Fashion Pria',
                'description' => 'Brand fashion pria PT BOBA yang menghadirkan kaos, kemeja, hoodie, jaket, celana, dan aksesoris pria dengan desain modern dan kualitas premium.',
                'is_active' => true,
            ]
        );

        $sokyuut = Brand::updateOrCreate(
            ['slug' => 'sokyuut'],
            [
                'name' => 'sokyuut',
                'type' => 'fashion',
                'category' => 'Fashion Wanita',
                'description' => 'Brand fashion wanita PT BOBA yang menyediakan blouse, dress, outer, hijab, rok, celana, dan aksesoris wanita yang modis, nyaman, dan berkualitas.',
                'is_active' => true,
            ]
        );

        $ponpin = Brand::updateOrCreate(
            ['slug' => 'ponpin'],
            [
                'name' => 'Ponpin',
                'type' => 'service',
                'category' => 'Green Technology',
                'description' => 'Holding company green technology PT BOBA — pengambilan sampah, pengelolaan sampah, pengolahan sampah organik, dan pembuatan bahan bakar kendaraan dari sampah organik.',
                'is_active' => true,
            ]
        );

        // Tsoecha products
        $tsoechaProducts = [
            ['Kaos Tsoecha Classic', 'Kaos', 149000, 50],
            ['Kemeja Tsoecha Premium', 'Kemeja', 299000, 30],
            ['Hoodie Tsoecha Urban', 'Hoodie', 349000, 25],
            ['Jaket Tsoecha Bomber', 'Jaket', 449000, 20],
            ['Celana Chino Tsoecha', 'Celana', 259000, 35],
            ['Topi Tsoecha Signature', 'Aksesoris', 99000, 60],
        ];
        foreach ($tsoechaProducts as [$name, $cat, $price, $stock]) {
            Product::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'brand_id' => $tsoecha->id,
                    'seller_id' => $sellerTsoecha->id,
                    'name' => $name,
                    'category' => $cat,
                    'description' => "Produk {$name} dari brand tsoecha.co — fashion pria modern dari PT BOBA.",
                    'price' => $price,
                    'stock' => $stock,
                    'is_active' => true,
                ]
            );
        }

        // Sokyuut products
        $sokyuutProducts = [
            ['Blouse Sokyuut Daily', 'Blouse', 199000, 40],
            ['Dress Sokyuut Elegant', 'Dress', 399000, 25],
            ['Outer Sokyuut Casual', 'Outer', 329000, 20],
            ['Hijab Sokyuut Pashmina', 'Hijab', 79000, 100],
            ['Rok Sokyuut Plisket', 'Rok', 219000, 30],
            ['Celana Sokyuut Kulot', 'Celana', 249000, 35],
        ];
        foreach ($sokyuutProducts as [$name, $cat, $price, $stock]) {
            Product::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'brand_id' => $sokyuut->id,
                    'seller_id' => $sellerSokyuut->id,
                    'name' => $name,
                    'category' => $cat,
                    'description' => "Produk {$name} dari brand sokyuut — fashion wanita modis dari PT BOBA.",
                    'price' => $price,
                    'stock' => $stock,
                    'is_active' => true,
                ]
            );
        }

        // Ponpin services
        $ponpinServices = [
            ['Pengambilan Sampah Rumah Tangga', 'Pengambilan Sampah', 'Layanan jemput sampah rumah tangga rutin sesuai jadwal yang Anda pilih.', 75000, 'bulan'],
            ['Pengelolaan Sampah Korporat', 'Pengelolaan Sampah', 'Pengelolaan sampah lengkap untuk perusahaan, perkantoran, dan kawasan industri.', 1500000, 'bulan'],
            ['Pengolahan Sampah Organik', 'Pengolahan Organik', 'Pengolahan sampah organik menjadi kompos dan pupuk berkualitas.', 250000, 'ton'],
            ['Konversi Sampah Organik ke Bahan Bakar', 'Bahan Bakar Hijau', 'Konversi sampah organik menjadi bahan bakar kendaraan ramah lingkungan.', 5000000, 'project'],
        ];
        foreach ($ponpinServices as [$name, $cat, $desc, $price, $unit]) {
            Service::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'brand_id' => $ponpin->id,
                    'seller_id' => $sellerPonpin->id,
                    'name' => $name,
                    'category' => $cat,
                    'description' => $desc,
                    'price' => $price,
                    'unit' => $unit,
                    'is_active' => true,
                ]
            );
        }

        // Milestones
        $milestones = [
            ['title' => 'Pendirian PT BOBA', 'year' => 2024, 'month' => 'Januari', 'description' => 'PT Bikin Orang Bahagia resmi didirikan dengan visi industri tekstil, fashion, dan green technology.', 'icon' => 'bi-flag-fill', 'order_index' => 1],
            ['title' => 'Peluncuran Brand tsoecha.co & sokyuut', 'year' => 2024, 'month' => 'Maret', 'description' => 'Dua brand fashion utama PT BOBA resmi diluncurkan ke pasar nasional.', 'icon' => 'bi-bag-check-fill', 'order_index' => 2],
            ['title' => 'Peluncuran Ponpin', 'year' => 2024, 'month' => 'Juli', 'description' => 'Holding company green technology Ponpin resmi beroperasi melayani pengelolaan sampah berkelanjutan.', 'icon' => 'bi-recycle', 'order_index' => 3],
            ['title' => 'Ekspansi Marketplace Digital', 'year' => 2026, 'month' => 'April', 'description' => 'PT BOBA meluncurkan marketplace digital terintegrasi untuk produk fashion dan layanan green technology.', 'icon' => 'bi-globe', 'order_index' => 4],
            ['title' => 'Visi Pertumbuhan Internasional', 'year' => 2027, 'month' => null, 'description' => 'Rencana ekspansi ke pasar Asia Tenggara dan kerja sama investor strategis nasional/internasional.', 'icon' => 'bi-graph-up-arrow', 'order_index' => 5],
        ];
        foreach ($milestones as $m) {
            Milestone::updateOrCreate(['title' => $m['title']], $m);
        }

        // Impact metrics
        $metrics = [
            ['name' => 'Brand Utama', 'value' => '3', 'unit' => 'Brand', 'category' => 'company', 'icon' => 'bi-stars', 'description' => 'tsoecha.co, sokyuut, dan Ponpin di bawah naungan PT BOBA.', 'order_index' => 1],
            ['name' => 'Bidang Bisnis', 'value' => '2', 'unit' => 'Sektor', 'category' => 'company', 'icon' => 'bi-diagram-3', 'description' => 'Fashion (tekstil & produk olahan) dan Green Technology.', 'order_index' => 2],
            ['name' => 'Kategori Produk Fashion', 'value' => '12+', 'unit' => 'Item', 'category' => 'product', 'icon' => 'bi-bag-heart', 'description' => 'Produk fashion pria & wanita siap pasar.', 'order_index' => 3],
            ['name' => 'Sampah Dikelola', 'value' => '500+', 'unit' => 'Ton/tahun (target)', 'category' => 'esg', 'icon' => 'bi-recycle', 'description' => 'Target awal pengelolaan sampah Ponpin.', 'order_index' => 4],
            ['name' => 'Reduksi Emisi', 'value' => '120+', 'unit' => 'Ton CO2e/tahun (target)', 'category' => 'esg', 'icon' => 'bi-tree-fill', 'description' => 'Estimasi reduksi emisi melalui pengolahan organik & bahan bakar hijau.', 'order_index' => 5],
            ['name' => 'Potensi Pasar', 'value' => 'Lokal & Internasional', 'unit' => null, 'category' => 'market', 'icon' => 'bi-globe-asia-australia', 'description' => 'Komitmen ekonomi kreatif & ramah lingkungan.', 'order_index' => 6],
        ];
        foreach ($metrics as $m) {
            ImpactMetric::updateOrCreate(['name' => $m['name']], $m);
        }

        // Documents (public-facing investor docs placeholders)
        $docs = [
            ['title' => 'Company Profile PT BOBA 2026', 'category' => 'Profile', 'description' => 'Profil lengkap perusahaan PT Bikin Orang Bahagia.', 'year' => 2026, 'is_public' => true],
            ['title' => 'Pitch Deck Investor', 'category' => 'Investor', 'description' => 'Materi presentasi peluang investasi PT BOBA.', 'year' => 2026, 'is_public' => true],
            ['title' => 'Sustainability Report Ponpin', 'category' => 'ESG', 'description' => 'Laporan keberlanjutan layanan Ponpin.', 'year' => 2026, 'is_public' => true],
        ];
        foreach ($docs as $d) {
            CompanyDocument::updateOrCreate(['title' => $d['title']], $d);
        }
    }
}
