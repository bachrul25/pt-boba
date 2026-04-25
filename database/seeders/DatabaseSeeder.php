<?php

namespace Database\Seeders;

use App\Models\CompanyStructure;
use App\Models\Product;
use App\Models\SellerProfile;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator PT BOBA',
                'password' => 'password',
                'role' => 'admin',
                'phone' => '+62811000000',
                'address' => 'Kantor Pusat PT BOBA, Surabaya',
            ]
        );

        // Dummy buyers
        $buyers = [
            ['name' => 'Andi Pratama', 'email' => 'buyer1@gmail.com'],
            ['name' => 'Sari Dewi', 'email' => 'buyer2@gmail.com'],
        ];
        foreach ($buyers as $b) {
            User::updateOrCreate(
                ['email' => $b['email']],
                array_merge($b, [
                    'password' => 'password',
                    'role' => 'buyer',
                    'phone' => '+6281200000'.rand(10, 99),
                    'address' => 'Jakarta, Indonesia',
                ])
            );
        }

        // Dummy sellers
        $sellersData = [
            [
                'name' => 'Toko Tsoecha',
                'email' => 'seller1@gmail.com',
                'shop_name' => 'Tsoecha Official Store',
                'shop_description' => 'Official store brand tsoecha.co - fashion pria PT BOBA.',
                'shop_address' => 'Surabaya, Jawa Timur',
            ],
            [
                'name' => 'Toko Sokyuut',
                'email' => 'seller2@gmail.com',
                'shop_name' => 'Sokyuut Boutique',
                'shop_description' => 'Fashion wanita kontemporer brand sokyuut PT BOBA.',
                'shop_address' => 'Bandung, Jawa Barat',
            ],
            [
                'name' => 'Tos2bro Green Services',
                'email' => 'seller3@gmail.com',
                'shop_name' => 'tos2bro Green Ops',
                'shop_description' => 'Green technology holding - pengelolaan sampah & energi terbarukan.',
                'shop_address' => 'Surabaya, Jawa Timur',
            ],
        ];

        $sellers = [];
        foreach ($sellersData as $s) {
            $user = User::updateOrCreate(
                ['email' => $s['email']],
                [
                    'name' => $s['name'],
                    'password' => 'password',
                    'role' => 'seller',
                    'phone' => '+6281200'.rand(1000, 9999),
                    'address' => $s['shop_address'],
                ]
            );
            SellerProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'shop_name' => $s['shop_name'],
                    'shop_description' => $s['shop_description'],
                    'shop_address' => $s['shop_address'],
                    'status' => 'approved',
                    'is_completed' => true,
                ]
            );
            $sellers[$s['email']] = $user;
        }

        // Company structure
        CompanyStructure::truncate();
        $founders = [
            [
                'name' => 'Bachrul Ullum Assrori',
                'position' => 'Direktur',
                'description' => 'Bertanggung jawab atas pengambilan keputusan utama, arah bisnis perusahaan, pengembangan brand, kerja sama, serta pengawasan operasional PT BOBA.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Ario Putra Bakti',
                'position' => 'Komisaris Utama',
                'description' => 'Bertanggung jawab dalam pengawasan utama terhadap kebijakan perusahaan, memberikan arahan strategis, serta memastikan perusahaan berjalan sesuai tujuan perusahaan.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Ellen Sinta Budirahayu',
                'position' => 'Komisaris',
                'description' => 'Bertanggung jawab membantu pengawasan perusahaan, memberikan masukan terhadap pengembangan bisnis, dan mendukung keberlanjutan perusahaan.',
                'sort_order' => 3,
            ],
        ];
        foreach ($founders as $f) {
            CompanyStructure::create(array_merge($f, ['status' => 'active']));
        }

        // Products: 3 tsoecha.co + 3 sokyuut
        $tsoecha = $sellers['seller1@gmail.com'];
        $sokyuut = $sellers['seller2@gmail.com'];
        $ponpin = $sellers['seller3@gmail.com'];

        $products = [
            ['seller_id' => $tsoecha->id, 'brand' => 'tsoecha.co', 'gender_category' => 'pria', 'name' => 'Kaos Basic Premium', 'description' => 'Kaos cotton combed 30s, jahitan rapi, nyaman dipakai harian.', 'price' => 89000, 'stock' => 50, 'category' => 'Kaos'],
            ['seller_id' => $tsoecha->id, 'brand' => 'tsoecha.co', 'gender_category' => 'pria', 'name' => 'Hoodie Fleece Series', 'description' => 'Hoodie bahan fleece tebal, cocok untuk cuaca sejuk.', 'price' => 229000, 'stock' => 30, 'category' => 'Hoodie'],
            ['seller_id' => $tsoecha->id, 'brand' => 'tsoecha.co', 'gender_category' => 'pria', 'name' => 'Celana Chinos Slim', 'description' => 'Celana chinos slim fit, bahan stretch, kasual & formal.', 'price' => 199000, 'stock' => 40, 'category' => 'Celana'],
            ['seller_id' => $sokyuut->id, 'brand' => 'sokyuut', 'gender_category' => 'wanita', 'name' => 'Blouse Linen Everyday', 'description' => 'Blouse linen breathable, adem, elegan.', 'price' => 179000, 'stock' => 35, 'category' => 'Blouse'],
            ['seller_id' => $sokyuut->id, 'brand' => 'sokyuut', 'gender_category' => 'wanita', 'name' => 'Dress Casual Midi', 'description' => 'Dress midi casual, bahan rayon premium.', 'price' => 259000, 'stock' => 25, 'category' => 'Dress'],
            ['seller_id' => $sokyuut->id, 'brand' => 'sokyuut', 'gender_category' => 'wanita', 'name' => 'Hijab Pashmina Soft', 'description' => 'Hijab pashmina soft, tidak menerawang, tidak mudah kusut.', 'price' => 79000, 'stock' => 100, 'category' => 'Hijab'],
        ];
        foreach ($products as $p) {
            Product::updateOrCreate(
                ['name' => $p['name'], 'seller_id' => $p['seller_id']],
                array_merge($p, ['status' => 'active'])
            );
        }

        // Services: 4 tos2bro services
        $services = [
            [
                'name' => 'Jasa Pengambilan Sampah Rumah Tangga',
                'service_type' => 'pengambilan_sampah',
                'description' => 'Jemput sampah rumah tangga 2x seminggu, disortir di lokasi, ramah lingkungan.',
                'price' => 150000,
                'category' => 'Rumah Tangga',
            ],
            [
                'name' => 'Jasa Pengelolaan Sampah Bisnis',
                'service_type' => 'pengelolaan_sampah',
                'description' => 'Paket pengelolaan sampah untuk cafe, restoran, kantor. Laporan bulanan dan segregasi lengkap.',
                'price' => 1500000,
                'category' => 'Bisnis',
            ],
            [
                'name' => 'Pengolahan Sampah Organik Jadi Kompos',
                'service_type' => 'pengolahan_sampah_organik',
                'description' => 'Konversi sampah organik menjadi kompos premium untuk pertanian dan urban farming.',
                'price' => 750000,
                'category' => 'Industri',
            ],
            [
                'name' => 'Bahan Bakar Kendaraan dari Sampah Organik',
                'service_type' => 'bahan_bakar_kendaraan',
                'description' => 'Konversi sampah organik menjadi bio-fuel untuk kendaraan komersial.',
                'price' => 2500000,
                'category' => 'Industri',
            ],
        ];
        foreach ($services as $s) {
            Service::updateOrCreate(
                ['name' => $s['name'], 'seller_id' => $ponpin->id],
                array_merge($s, [
                    'seller_id' => $ponpin->id,
                    'brand' => 'tos2bro',
                    'status' => 'active',
                ])
            );
        }
    }
}
