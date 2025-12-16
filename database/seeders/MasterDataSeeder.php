<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Medicine;
use App\Models\ImmunizationType;
use App\Models\WebsiteContent;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // Services
        $services = [
            ['code' => 'ANC01', 'name' => 'Pemeriksaan ANC', 'category' => 'ANC', 'price' => 50000],
            ['code' => 'DEL01', 'name' => 'Persalinan Normal', 'category' => 'Delivery', 'price' => 1500000],
            ['code' => 'IMM01', 'name' => 'Imunisasi Dasar', 'category' => 'Immunization', 'price' => 30000],
            ['code' => 'KB01', 'name' => 'Suntik KB 1 Bulan', 'category' => 'Planning', 'price' => 25000],
            ['code' => 'KB02', 'name' => 'Suntik KB 3 Bulan', 'category' => 'Planning', 'price' => 30000],
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
    }
}
