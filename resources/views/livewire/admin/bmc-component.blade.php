@section('page-title', 'Business Model Canvas')

<div>
    <div class="d-flex justify-content-between align-items-end flex-wrap mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-grid-3x3-gap"></i> Business Model Canvas</h4>
            <p class="text-secondary mb-0">Model bisnis PT Bikin Orang Bahagia (PT BOBA) &mdash; Holding Company: Fashion, Produk Olahan &amp; Green Technology</p>
        </div>
    </div>

    {{-- BMC Grid Layout --}}
    <div class="bmc-canvas mb-4">
        <div class="bmc-row bmc-row-top">
            {{-- Key Partners --}}
            <div class="bmc-cell bmc-partners">
                <div class="bmc-header">
                    <i class="bi bi-people-fill"></i> Key Partners
                </div>
                <div class="bmc-body">
                    <ul class="bmc-list">
                        <li>
                            <strong>Supplier Tekstil &amp; Bahan Baku Fashion</strong>
                            <span class="bmc-desc">Pemasok kain, benang, aksesoris, dan bahan baku untuk brand fashion tsoecha.co dan sokyuut. Kerjasama jangka panjang untuk konsistensi kualitas dan harga kompetitif.</span>
                        </li>
                        <li>
                            <strong>Mitra Manufaktur &amp; Konveksi</strong>
                            <span class="bmc-desc">Pabrik garmen dan konveksi lokal yang memproduksi pakaian sesuai standar kualitas PT BOBA. Mitra produksi untuk scaling kapasitas di pasar ASEAN.</span>
                        </li>
                        <li>
                            <strong>Penyedia Teknologi &amp; Platform Digital</strong>
                            <span class="bmc-desc">Partner infrastruktur IT (hosting, payment gateway, cloud services) yang mendukung marketplace Ponpin dan platform e-commerce PT BOBA.</span>
                        </li>
                        <li>
                            <strong>Mitra Logistik &amp; Pengiriman</strong>
                            <span class="bmc-desc">Jasa ekspedisi nasional dan internasional (JNE, J&T, Sicepat, DHL) untuk distribusi produk ke seluruh Indonesia dan ASEAN.</span>
                        </li>
                        <li>
                            <strong>Investor &amp; Lembaga Keuangan</strong>
                            <span class="bmc-desc">Angel investor, venture capital, dan lembaga perbankan yang mendukung pendanaan ekspansi bisnis dan pengembangan produk baru.</span>
                        </li>
                        <li>
                            <strong>Komunitas &amp; Organisasi Lingkungan</strong>
                            <span class="bmc-desc">NGO dan komunitas green technology yang mendukung misi sustainability Ponpin dan memberikan validasi ESG (Environmental, Social, Governance).</span>
                        </li>
                        <li>
                            <strong>Marketplace Partner (Shopee, Tokopedia, Lazada)</strong>
                            <span class="bmc-desc">Platform e-commerce besar sebagai kanal distribusi tambahan untuk memperluas jangkauan pasar produk fashion PT BOBA.</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Key Activities + Key Resources (stacked) --}}
            <div class="bmc-cell bmc-stacked">
                {{-- Key Activities --}}
                <div class="bmc-sub-cell bmc-activities">
                    <div class="bmc-header">
                        <i class="bi bi-gear-fill"></i> Key Activities
                    </div>
                    <div class="bmc-body">
                        <ul class="bmc-list">
                            <li>
                                <strong>Desain &amp; Produksi Fashion</strong>
                                <span class="bmc-desc">Riset tren mode, desain koleksi baru untuk tsoecha.co dan sokyuut, produksi garmen dengan quality control ketat, serta manajemen supply chain dari bahan baku hingga produk jadi.</span>
                            </li>
                            <li>
                                <strong>Pengembangan &amp; Operasional Platform Marketplace</strong>
                                <span class="bmc-desc">Pengembangan fitur marketplace Ponpin, maintenance platform, onboarding seller baru, dan optimasi user experience untuk buyer dan seller.</span>
                            </li>
                            <li>
                                <strong>Layanan Green Technology (Ponpin)</strong>
                                <span class="bmc-desc">Penyediaan jasa teknologi ramah lingkungan: instalasi panel surya, konsultasi efisiensi energi, waste management, dan layanan sustainability untuk bisnis dan rumah tangga.</span>
                            </li>
                            <li>
                                <strong>Manajemen Brand &amp; Pemasaran Digital</strong>
                                <span class="bmc-desc">Strategi branding multi-brand, content marketing, social media management, influencer collaboration, dan kampanye iklan digital untuk seluruh portfolio brand PT BOBA.</span>
                            </li>
                            <li>
                                <strong>Pengelolaan Investor Relations</strong>
                                <span class="bmc-desc">Komunikasi dengan investor, penyusunan laporan keuangan, roadshow, dan pengelolaan dokumen perusahaan untuk transparansi dan kepercayaan investor.</span>
                            </li>
                            <li>
                                <strong>Quality Assurance &amp; Customer Service</strong>
                                <span class="bmc-desc">Pengendalian mutu produk, penanganan komplain, manajemen retur, dan peningkatan kepuasan pelanggan melalui layanan after-sales yang responsif.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Key Resources --}}
                <div class="bmc-sub-cell bmc-resources">
                    <div class="bmc-header">
                        <i class="bi bi-box-seam-fill"></i> Key Resources
                    </div>
                    <div class="bmc-body">
                        <ul class="bmc-list">
                            <li>
                                <strong>Portfolio Brand (tsoecha.co, sokyuut, Ponpin)</strong>
                                <span class="bmc-desc">Tiga brand dengan positioning berbeda: tsoecha.co (fashion premium), sokyuut (fashion casual/youth), dan Ponpin (green technology &amp; marketplace ASEAN).</span>
                            </li>
                            <li>
                                <strong>Platform Digital &amp; Infrastruktur IT</strong>
                                <span class="bmc-desc">Website marketplace, sistem manajemen order, payment gateway terintegrasi, dan dashboard analytics untuk monitoring performa bisnis secara real-time.</span>
                            </li>
                            <li>
                                <strong>Tim Kreatif &amp; Manajemen</strong>
                                <span class="bmc-desc">Fashion designer, software developer, marketing specialist, dan tim operasional yang berpengalaman dalam industri fashion dan teknologi.</span>
                            </li>
                            <li>
                                <strong>Jaringan Seller &amp; Mitra Bisnis</strong>
                                <span class="bmc-desc">Ekosistem seller yang terdaftar di platform, mitra konveksi, dan partner bisnis strategis yang mendukung pertumbuhan marketplace.</span>
                            </li>
                            <li>
                                <strong>Modal &amp; Pendanaan Investor</strong>
                                <span class="bmc-desc">Sumber daya finansial dari investor, pendapatan operasional, dan akses ke pendanaan tambahan untuk ekspansi ke pasar ASEAN.</span>
                            </li>
                            <li>
                                <strong>Data &amp; Intellectual Property</strong>
                                <span class="bmc-desc">Database pelanggan, analitik pasar, desain original, trademark brand, dan insight data yang mendukung pengambilan keputusan bisnis berbasis data.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Value Propositions --}}
            <div class="bmc-cell bmc-value">
                <div class="bmc-header">
                    <i class="bi bi-star-fill"></i> Value Propositions
                </div>
                <div class="bmc-body">
                    <ul class="bmc-list">
                        <li>
                            <strong>Fashion Lokal Berkualitas Internasional</strong>
                            <span class="bmc-desc">Produk fashion karya anak bangsa dengan standar kualitas global, desain kekinian, dan harga terjangkau untuk pasar ASEAN.</span>
                        </li>
                        <li>
                            <strong>Platform Marketplace Terintegrasi</strong>
                            <span class="bmc-desc">Satu platform untuk membeli produk fashion dan memesan layanan green technology, memudahkan transaksi dan pengalaman belanja seamless.</span>
                        </li>
                        <li>
                            <strong>Komitmen Sustainability &amp; ESG</strong>
                            <span class="bmc-desc">Layanan green technology Ponpin yang membantu bisnis dan masyarakat menerapkan prinsip ramah lingkungan dan keberlanjutan.</span>
                        </li>
                        <li>
                            <strong>Multi-Brand Portfolio</strong>
                            <span class="bmc-desc">Pilihan brand beragam yang menyasar segmen pasar berbeda: premium, casual, youth, dan layanan teknologi.</span>
                        </li>
                        <li>
                            <strong>Peluang Investasi Transparan</strong>
                            <span class="bmc-desc">Investor relations yang terbuka dengan milestone tracking, impact metrics, dan dokumen perusahaan yang mudah diakses.</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Customer Relationships + Channels (stacked) --}}
            <div class="bmc-cell bmc-stacked">
                {{-- Customer Relationships --}}
                <div class="bmc-sub-cell bmc-relationships">
                    <div class="bmc-header">
                        <i class="bi bi-heart-fill"></i> Customer Relationships
                    </div>
                    <div class="bmc-body">
                        <ul class="bmc-list">
                            <li>
                                <strong>Self-Service Digital</strong>
                                <span class="bmc-desc">Platform marketplace memungkinkan buyer browse, order, dan track secara mandiri.</span>
                            </li>
                            <li>
                                <strong>Dedicated Account Manager</strong>
                                <span class="bmc-desc">Layanan khusus untuk seller dan investor dengan support personal.</span>
                            </li>
                            <li>
                                <strong>Community Building</strong>
                                <span class="bmc-desc">Membangun komunitas fashion dan sustainability melalui event dan konten edukatif.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Channels --}}
                <div class="bmc-sub-cell bmc-channels">
                    <div class="bmc-header">
                        <i class="bi bi-signpost-fill"></i> Channels
                    </div>
                    <div class="bmc-body">
                        <ul class="bmc-list">
                            <li>
                                <strong>Platform Marketplace PT BOBA</strong>
                                <span class="bmc-desc">Website dan mobile app sebagai kanal penjualan utama.</span>
                            </li>
                            <li>
                                <strong>E-commerce (Shopee, Tokopedia, Lazada)</strong>
                                <span class="bmc-desc">Distribusi multi-channel untuk jangkauan pasar lebih luas.</span>
                            </li>
                            <li>
                                <strong>Social Media &amp; Digital Marketing</strong>
                                <span class="bmc-desc">Instagram, TikTok, dan Facebook untuk brand awareness dan konversi.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Customer Segments --}}
            <div class="bmc-cell bmc-segments">
                <div class="bmc-header">
                    <i class="bi bi-person-lines-fill"></i> Customer Segments
                </div>
                <div class="bmc-body">
                    <ul class="bmc-list">
                        <li>
                            <strong>Fashion Consumer (B2C)</strong>
                            <span class="bmc-desc">Konsumen akhir yang membeli produk fashion tsoecha.co dan sokyuut.</span>
                        </li>
                        <li>
                            <strong>Seller / Reseller (B2B)</strong>
                            <span class="bmc-desc">Pelaku usaha yang menjual produk melalui platform marketplace.</span>
                        </li>
                        <li>
                            <strong>Pengguna Jasa Green Tech (B2B &amp; B2C)</strong>
                            <span class="bmc-desc">Bisnis dan rumah tangga yang membutuhkan layanan green technology Ponpin.</span>
                        </li>
                        <li>
                            <strong>Investor</strong>
                            <span class="bmc-desc">Angel investor dan VC yang mencari peluang investasi di industri fashion dan teknologi hijau.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Bottom Row: Cost Structure + Revenue Streams --}}
        <div class="bmc-row bmc-row-bottom">
            {{-- Cost Structure --}}
            <div class="bmc-cell bmc-costs">
                <div class="bmc-header">
                    <i class="bi bi-cash-stack"></i> Cost Structure
                </div>
                <div class="bmc-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="bmc-list">
                                <li>
                                    <strong>Biaya Produksi &amp; Bahan Baku</strong>
                                    <span class="bmc-desc">Pengadaan kain, bahan baku produk olahan, dan biaya manufaktur garmen untuk seluruh brand.</span>
                                </li>
                                <li>
                                    <strong>Biaya SDM &amp; Operasional</strong>
                                    <span class="bmc-desc">Gaji tim kreatif, developer, marketing, operasional, dan manajemen perusahaan.</span>
                                </li>
                                <li>
                                    <strong>Infrastruktur Teknologi</strong>
                                    <span class="bmc-desc">Server, hosting, payment gateway, domain, dan biaya pengembangan platform marketplace.</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="bmc-list">
                                <li>
                                    <strong>Biaya Marketing &amp; Branding</strong>
                                    <span class="bmc-desc">Digital ads, influencer, content production, dan kampanye brand awareness.</span>
                                </li>
                                <li>
                                    <strong>Logistik &amp; Distribusi</strong>
                                    <span class="bmc-desc">Biaya pengiriman, warehousing, dan manajemen rantai pasok.</span>
                                </li>
                                <li>
                                    <strong>Biaya Legal &amp; Compliance</strong>
                                    <span class="bmc-desc">Perizinan usaha, trademark, pajak, dan kepatuhan regulasi bisnis.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Revenue Streams --}}
            <div class="bmc-cell bmc-revenue">
                <div class="bmc-header">
                    <i class="bi bi-currency-exchange"></i> Revenue Streams
                </div>
                <div class="bmc-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="bmc-list">
                                <li>
                                    <strong>Penjualan Produk Fashion (Direct Sales)</strong>
                                    <span class="bmc-desc">Pendapatan utama dari penjualan langsung produk brand tsoecha.co dan sokyuut melalui platform sendiri dan marketplace partner. Meliputi pakaian, aksesoris, dan koleksi limited edition.</span>
                                </li>
                                <li>
                                    <strong>Komisi Marketplace (Transaction Fee)</strong>
                                    <span class="bmc-desc">Potongan komisi dari setiap transaksi yang terjadi di platform marketplace Ponpin antara seller dan buyer. Persentase komisi bervariasi berdasarkan kategori produk.</span>
                                </li>
                                <li>
                                    <strong>Pendapatan Jasa Layanan Green Technology</strong>
                                    <span class="bmc-desc">Revenue dari layanan instalasi, konsultasi, dan maintenance green technology Ponpin. Termasuk jasa per project dan kontrak layanan berlangganan untuk klien korporat.</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="bmc-list">
                                <li>
                                    <strong>Subscription &amp; Premium Seller</strong>
                                    <span class="bmc-desc">Pendapatan dari paket berlangganan seller premium yang mendapatkan fitur tambahan: analytics dashboard, prioritas display, dan tools marketing di platform.</span>
                                </li>
                                <li>
                                    <strong>Penjualan Produk Olahan</strong>
                                    <span class="bmc-desc">Revenue dari produk olahan makanan/minuman yang dipasarkan di bawah brand PT BOBA. Diversifikasi pendapatan di luar segmen fashion dan teknologi.</span>
                                </li>
                                <li>
                                    <strong>Pendanaan Investor &amp; Partnership Fee</strong>
                                    <span class="bmc-desc">Modal investasi dari angel investor dan VC untuk ekspansi bisnis, serta partnership fee dari kerjasama strategis dengan brand dan perusahaan lain di ekosistem ASEAN.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('head')
    <style>
        .bmc-canvas {
            display: flex;
            flex-direction: column;
            gap: 0;
            border: 2px solid var(--boba-primary);
            border-radius: 1rem;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 8px 32px rgba(12, 63, 54, .08);
        }
        .bmc-row {
            display: flex;
        }
        .bmc-row-top {
            min-height: 420px;
        }
        .bmc-row-bottom {
            border-top: 2px solid var(--boba-primary);
        }
        .bmc-cell {
            flex: 1;
            border-right: 1px solid rgba(22, 97, 82, .2);
            display: flex;
            flex-direction: column;
        }
        .bmc-cell:last-child {
            border-right: none;
        }
        .bmc-row-bottom .bmc-cell {
            flex: 1;
        }
        .bmc-stacked {
            display: flex;
            flex-direction: column;
        }
        .bmc-sub-cell {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .bmc-sub-cell:first-child {
            border-bottom: 1px solid rgba(22, 97, 82, .2);
        }
        .bmc-header {
            background: linear-gradient(135deg, var(--boba-dark) 0%, var(--boba-primary) 100%);
            color: #fff;
            padding: .6rem .85rem;
            font-weight: 700;
            font-size: .85rem;
            letter-spacing: .3px;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .bmc-header i {
            font-size: 1rem;
            opacity: .85;
        }
        .bmc-body {
            padding: .75rem;
            flex: 1;
            overflow-y: auto;
        }
        .bmc-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .bmc-list li {
            padding: .45rem .5rem;
            border-radius: .5rem;
            margin-bottom: .35rem;
            background: rgba(22, 97, 82, .03);
            border-left: 3px solid var(--boba-primary);
            transition: background .2s;
        }
        .bmc-list li:hover {
            background: rgba(22, 97, 82, .08);
        }
        .bmc-list li strong {
            display: block;
            font-size: .82rem;
            color: var(--boba-dark);
            margin-bottom: .15rem;
        }
        .bmc-desc {
            font-size: .75rem;
            color: #5b6b80;
            line-height: 1.4;
        }

        /* Color accents per block */
        .bmc-partners .bmc-header { background: linear-gradient(135deg, #1a4a3f 0%, #2d7a68 100%); }
        .bmc-partners .bmc-list li { border-left-color: #2d7a68; background: rgba(45, 122, 104, .04); }
        .bmc-partners .bmc-list li:hover { background: rgba(45, 122, 104, .1); }

        .bmc-activities .bmc-header { background: linear-gradient(135deg, #1b6b4a 0%, #2dbf95 100%); }
        .bmc-activities .bmc-list li { border-left-color: #2dbf95; background: rgba(45, 191, 149, .04); }
        .bmc-activities .bmc-list li:hover { background: rgba(45, 191, 149, .1); }

        .bmc-resources .bmc-header { background: linear-gradient(135deg, #b08700 0%, #f5b400 100%); }
        .bmc-resources .bmc-list li { border-left-color: #f5b400; background: rgba(245, 180, 0, .04); }
        .bmc-resources .bmc-list li:hover { background: rgba(245, 180, 0, .1); }
        .bmc-resources .bmc-list li strong { color: #7a5800; }

        .bmc-value .bmc-header { background: linear-gradient(135deg, var(--boba-dark) 0%, var(--boba-primary) 100%); }
        .bmc-value .bmc-list li { border-left-color: var(--boba-primary); background: rgba(22, 97, 82, .04); }
        .bmc-value .bmc-list li:hover { background: rgba(22, 97, 82, .1); }

        .bmc-relationships .bmc-header { background: linear-gradient(135deg, #8b2252 0%, #d63384 100%); }
        .bmc-relationships .bmc-list li { border-left-color: #d63384; background: rgba(214, 51, 132, .04); }
        .bmc-relationships .bmc-list li:hover { background: rgba(214, 51, 132, .1); }

        .bmc-channels .bmc-header { background: linear-gradient(135deg, #1a5276 0%, #2980b9 100%); }
        .bmc-channels .bmc-list li { border-left-color: #2980b9; background: rgba(41, 128, 185, .04); }
        .bmc-channels .bmc-list li:hover { background: rgba(41, 128, 185, .1); }

        .bmc-segments .bmc-header { background: linear-gradient(135deg, #0c3f36 0%, #166152 100%); }
        .bmc-segments .bmc-list li { border-left-color: #166152; background: rgba(22, 97, 82, .04); }
        .bmc-segments .bmc-list li:hover { background: rgba(22, 97, 82, .1); }

        .bmc-costs .bmc-header { background: linear-gradient(135deg, #5b2c6f 0%, #8e44ad 100%); }
        .bmc-costs .bmc-list li { border-left-color: #8e44ad; background: rgba(142, 68, 173, .04); }
        .bmc-costs .bmc-list li:hover { background: rgba(142, 68, 173, .1); }

        .bmc-revenue .bmc-header { background: linear-gradient(135deg, #1e6e3e 0%, #27ae60 100%); }
        .bmc-revenue .bmc-list li { border-left-color: #27ae60; background: rgba(39, 174, 96, .04); }
        .bmc-revenue .bmc-list li:hover { background: rgba(39, 174, 96, .1); }

        @media (max-width: 991.98px) {
            .bmc-row {
                flex-direction: column;
            }
            .bmc-cell {
                border-right: none;
                border-bottom: 1px solid rgba(22, 97, 82, .2);
            }
            .bmc-cell:last-child {
                border-bottom: none;
            }
            .bmc-row-top {
                min-height: auto;
            }
        }
    </style>
    @endpush
</div>
