<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Medicine;
use App\Models\ImmunizationType;
use App\Models\WebsiteContent;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // Services
        $services = [
            ['code' => 'ANC01', 'name' => 'Pemeriksaan Kehamilan (ANC)', 'category' => 'ANC',          'price' => 50000,   'icon' => 'fas fa-baby-carriage',      'description' => 'Pemantauan kesehatan ibu dan janin secara berkala dengan standar pelayanan terkini.'],
            ['code' => 'DEL01', 'name' => 'Persalinan Normal',           'category' => 'Delivery',     'price' => 1500000, 'icon' => 'fas fa-hospital-user',      'description' => 'Layanan persalinan 24 jam dengan asuhan sayang ibu dan bayi serta inisiasi menyusui dini.'],
            ['code' => 'IMM01', 'name' => 'Imunisasi Dasar',             'category' => 'Immunization', 'price' => 30000,   'icon' => 'fas fa-syringe',            'description' => 'Lengkapi perlindungan buah hati dengan imunisasi dasar lengkap dan vaksin tambahan.'],
            ['code' => 'KB01',  'name' => 'Suntik KB 1 Bulan',          'category' => 'Planning',     'price' => 25000,   'icon' => 'fas fa-pills',              'description' => 'Konseling dan pelayanan kontrasepsi suntik KB 1 bulan sesuai kebutuhan pasien.'],
            ['code' => 'KB02',  'name' => 'Suntik KB 3 Bulan',          'category' => 'Planning',     'price' => 30000,   'icon' => 'fas fa-pills',              'description' => 'Konseling dan pelayanan kontrasepsi suntik KB 3 bulan sesuai kebutuhan pasien.'],
            ['code' => 'PNC01', 'name' => 'Kunjungan Nifas (PNC)',       'category' => 'General',      'price' => 40000,   'icon' => 'fas fa-child',              'description' => 'Pemeriksaan ibu dan bayi pasca persalinan untuk memastikan pemulihan berjalan optimal.'],
            ['code' => 'GEN01', 'name' => 'Konsultasi Kesehatan Wanita', 'category' => 'General',      'price' => 35000,   'icon' => 'fas fa-user-nurse',         'description' => 'Layanan kesehatan reproduksi remaja, pra-nikah, hingga masa menopause.'],
        ];

        foreach ($services as $s) {
            Service::create($s);
        }

        // Medicines
        $medicines = [
            ['code' => 'MED01', 'name' => 'Paracetamol', 'type' => 'Tablet', 'unit' => 'Strip', 'price' => 5000, 'stock' => 100],
            ['code' => 'MED02', 'name' => 'Amoxicillin', 'type' => 'Tablet', 'unit' => 'Strip', 'price' => 8000, 'stock' => 50],
            ['code' => 'MED03', 'name' => 'Vitamin C', 'type' => 'Syrup', 'unit' => 'Bottle', 'price' => 15000, 'stock' => 200],
        ];

        foreach ($medicines as $m) {
            Medicine::create($m);
        }

        // Immunization Types
        $types = ['BCG', 'Polio 1', 'Polio 2', 'Polio 3', 'DPT-HB-Hib 1', 'DPT-HB-Hib 2', 'DPT-HB-Hib 3', 'Campak'];
        foreach ($types as $t) {
            ImmunizationType::create(['name' => $t]);
        }

        // Website Content
        // Website Content
        $contents = [
            [
                'key' => 'slider-1',
                'title' => 'Layanan Kesehatan Ibu & Anak Terpercaya',
                'content' => 'Kami hadir memberikan pelayanan terbaik untuk buah hati dan anda.',
                'category' => 'slider',
                'image_path' => 'https://via.placeholder.com/800x400'
            ],
            [
                'key' => 'slider-2',
                'title' => 'Fasilitas Modern & Nyaman',
                'content' => 'Klinik dilengkapi dengan peralatan medis terkini.',
                'category' => 'slider',
                'image_path' => 'https://via.placeholder.com/800x400'
            ],
            [
                'key' => 'about-main',
                'title' => 'Tentang Klinik Sehati',
                'content' => '<p>Klinik Bidan Sehati didirikan sejak tahun 2010 dengan visi...</p>',
                'category' => 'about_us'
            ],
            [
                'key' => 'faq-1',
                'title' => 'Apakah menerima BPJS?',
                'content' => 'Ya, kami melayani pasien BPJS Kesehatan untuk persalinan dan pemeriksaan.',
                'category' => 'faq'
            ],
            [
                'key' => 'service-anc',
                'title' => 'Pemeriksaan Kehamilan (ANC)',
                'content' => 'Pemeriksaan rutin untuk memantau kesehatan ibu dan janin.',
                'category' => 'service_highlight'
            ]
        ];

        foreach ($contents as $c) {
            WebsiteContent::create($c);
        }

        // Categories & Posts
        $categories = [
            ['name' => 'Kesehatan Ibu',     'description' => 'Informasi seputar kesehatan ibu hamil dan menyusui.'],
            ['name' => 'Kesehatan Bayi',    'description' => 'Tips dan panduan merawat bayi baru lahir.'],
            ['name' => 'Keluarga Berencana','description' => 'Informasi program KB dan kontrasepsi.'],
            ['name' => 'Nutrisi & Gizi',    'description' => 'Panduan gizi untuk ibu dan anak.'],
        ];

        $createdCategories = [];
        foreach ($categories as $c) {
            $createdCategories[] = Category::create([
                'name'        => $c['name'],
                'slug'        => Str::slug($c['name']) . '-' . Str::random(4),
                'description' => $c['description'],
            ]);
        }

        $admin = User::where('email', 'admin@clinic.com')->first();

        $posts = [
            [
                'category' => 0,
                'title'    => 'Panduan Pemeriksaan Kehamilan (ANC) yang Rutin dan Teratur',
                'excerpt'  => 'Pemeriksaan kehamilan secara rutin sangat penting untuk memantau kondisi ibu dan janin agar tetap sehat sepanjang masa kehamilan.',
                'content'  => "Pemeriksaan antenatal care (ANC) adalah pemeriksaan kesehatan yang dilakukan selama masa kehamilan. Pemeriksaan ini bertujuan untuk memantau kesehatan ibu dan perkembangan janin.\n\nSelama kehamilan, ibu disarankan untuk melakukan pemeriksaan minimal 6 kali:\n- 2 kali pada trimester pertama (0–12 minggu)\n- 1 kali pada trimester kedua (13–26 minggu)\n- 3 kali pada trimester ketiga (27–40 minggu)\n\nPada setiap kunjungan, bidan akan memeriksa tekanan darah, berat badan, tinggi fundus uteri, detak jantung janin, dan kondisi umum ibu.\n\nJangan tunda pemeriksaan kehamilan Anda. Semakin dini masalah terdeteksi, semakin cepat penanganan dapat dilakukan.",
                'status'   => 'published',
            ],
            [
                'category' => 1,
                'title'    => 'Tips Merawat Bayi Baru Lahir di Minggu Pertama',
                'excerpt'  => 'Minggu pertama kelahiran bayi adalah masa kritis. Berikut panduan lengkap merawat si kecil agar tetap sehat dan nyaman.',
                'content'  => "Merawat bayi baru lahir bisa terasa menantang, terutama bagi orang tua pertama kali. Berikut beberapa hal penting yang perlu diperhatikan:\n\n1. ASI Eksklusif\nBerikan ASI sesering mungkin, minimal 8–12 kali per hari. ASI mengandung semua nutrisi yang dibutuhkan bayi dan antibodi untuk melindungi dari infeksi.\n\n2. Perawatan Tali Pusat\nJaga tali pusat tetap kering dan bersih. Jangan dibungkus rapat. Biarkan terbuka agar cepat mengering dan lepas dengan sendirinya.\n\n3. Mandi Bayi\nMandikan bayi dengan air hangat menggunakan spons sampai tali pusat lepas. Setelah itu baru boleh direndam.\n\n4. Tidur yang Aman\nLetakkan bayi terlentang di kasur yang keras dan rata. Hindari bantal tebal atau mainan di sekitar bayi saat tidur.\n\n5. Pantau Warna Kulit\nSedikit kuning pada bayi baru lahir adalah normal. Namun jika kuning menyebar ke badan dan kaki, segera konsultasikan ke tenaga kesehatan.",
                'status'   => 'published',
            ],
            [
                'category' => 2,
                'title'    => 'Mengenal Berbagai Metode Kontrasepsi dan Cara Kerjanya',
                'excerpt'  => 'Memilih metode KB yang tepat adalah keputusan penting. Kenali berbagai pilihan kontrasepsi beserta kelebihan dan kekurangannya.',
                'content'  => "Program Keluarga Berencana (KB) membantu pasangan merencanakan kehamilan dengan lebih baik. Berikut beberapa metode kontrasepsi yang umum digunakan:\n\n1. Suntik KB\nTersedia dalam pilihan 1 bulan dan 3 bulan. Cara kerja: mencegah ovulasi dan mengentalkan lendir serviks. Efektivitas: 99% jika digunakan dengan benar.\n\n2. Pil KB\nDiminum setiap hari pada waktu yang sama. Cocok untuk ibu yang tidak sedang menyusui. Efektivitas: 91–99%.\n\n3. IUD (Spiral)\nAlat kecil berbentuk T yang dipasang di rahim. Tahan lama 3–10 tahun tergantung jenisnya. Efektivitas: >99%.\n\n4. Implan\nBatang kecil yang ditanam di bawah kulit lengan. Bekerja selama 3 tahun. Efektivitas: >99%.\n\nKonsultasikan dengan bidan kami untuk menentukan metode yang paling sesuai dengan kondisi dan kebutuhan Anda.",
                'status'   => 'published',
            ],
            [
                'category' => 3,
                'title'    => 'Nutrisi Penting untuk Ibu Hamil di Setiap Trimester',
                'excerpt'  => 'Asupan nutrisi yang tepat selama kehamilan sangat berpengaruh pada kesehatan ibu dan tumbuh kembang janin.',
                'content'  => "Nutrisi yang baik selama kehamilan bukan hanya untuk ibu, tetapi juga untuk pertumbuhan optimal janin. Berikut panduan nutrisi per trimester:\n\nTrimester 1 (0–12 minggu)\n- Asam folat: penting untuk mencegah cacat tabung saraf. Sumber: sayuran hijau, kacang-kacangan.\n- Vitamin B6: membantu mengurangi mual pagi. Sumber: pisang, ayam, kentang.\n\nTrimester 2 (13–26 minggu)\n- Kalsium: untuk pembentukan tulang dan gigi janin. Sumber: susu, keju, tahu.\n- Zat besi: mencegah anemia. Sumber: daging merah, bayam, hati ayam.\n\nTrimester 3 (27–40 minggu)\n- Omega-3: untuk perkembangan otak janin. Sumber: ikan salmon, kacang kenari.\n- Protein: untuk pertumbuhan jaringan. Sumber: telur, daging, ikan.\n\nPastikan juga minum air putih minimal 8 gelas per hari dan hindari makanan mentah, kafein berlebihan, dan alkohol selama kehamilan.",
                'status'   => 'published',
            ],
            [
                'category' => 0,
                'title'    => 'Tanda-Tanda Bahaya Kehamilan yang Harus Diwaspadai',
                'excerpt'  => 'Kenali tanda bahaya kehamilan sejak dini agar penanganan dapat dilakukan dengan cepat dan tepat.',
                'content'  => "Setiap ibu hamil perlu mengenal tanda-tanda bahaya yang memerlukan penanganan segera. Jangan abaikan gejala-gejala berikut:\n\n1. Perdarahan dari vagina\nPerdarahan pada trimester berapa pun bisa menjadi tanda serius seperti plasenta previa atau solusio plasenta.\n\n2. Nyeri perut hebat\nNyeri perut yang tidak wajar bisa mengindikasikan kehamilan ektopik atau kontraksi prematur.\n\n3. Sakit kepala parah disertai gangguan penglihatan\nIni bisa menjadi tanda preeklamsia — kondisi tekanan darah tinggi yang berbahaya.\n\n4. Bengkak mendadak pada wajah, tangan, atau kaki\nPembengkakan tiba-tiba juga bisa menjadi gejala preeklamsia.\n\n5. Gerakan janin berkurang drastis\nJika dalam sehari Anda merasakan gerakan janin kurang dari 10 kali dalam 2 jam, segera hubungi tenaga kesehatan.\n\nJangan tunda — segera datang ke klinik atau rumah sakit terdekat jika mengalami tanda-tanda di atas.",
                'status'   => 'published',
            ],
            [
                'category' => 1,
                'title'    => 'Jadwal Imunisasi Lengkap Bayi 0–12 Bulan',
                'excerpt'  => 'Imunisasi adalah hak setiap anak untuk terlindungi dari penyakit berbahaya. Ketahui jadwal lengkapnya di sini.',
                'content'  => "Imunisasi atau vaksinasi adalah proses pemberian vaksin untuk membantu sistem kekebalan tubuh anak melawan penyakit tertentu. Berikut jadwal imunisasi dasar bayi:\n\nUsia 0–7 hari:\n- HB0 (Hepatitis B pertama)\n\nUsia 1 bulan:\n- BCG (Tuberkulosis)\n- Polio 1\n\nUsia 2 bulan:\n- DPT-HB-Hib 1\n- Polio 2\n\nUsia 3 bulan:\n- DPT-HB-Hib 2\n- Polio 3\n\nUsia 4 bulan:\n- DPT-HB-Hib 3\n- Polio 4\n- IPV (Inactivated Polio Vaccine)\n\nUsia 9 bulan:\n- Campak/MR\n\nSemua imunisasi di atas tersedia GRATIS melalui program pemerintah di Posyandu, Puskesmas, dan klinik mitra.\n\nKunjungi klinik kami untuk konsultasi jadwal imunisasi si kecil.",
                'status'   => 'published',
            ],
        ];

        foreach ($posts as $p) {
            Post::create([
                'category_id'  => $createdCategories[$p['category']]->id,
                'user_id'      => $admin?->id,
                'title'        => $p['title'],
                'slug'         => Str::slug($p['title']) . '-' . Str::random(4),
                'excerpt'      => $p['excerpt'],
                'content'      => $p['content'],
                'status'       => $p['status'],
                'published_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
