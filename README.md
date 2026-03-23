# Klinik Bidan Sejahtera — Sistem Informasi Manajemen Klinik

> Sistem informasi manajemen klinik kebidanan terpadu untuk pelayanan ibu dan anak yang optimal.

---

## Daftar Isi

- [Tentang Aplikasi](#tentang-aplikasi)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Fitur Utama](#fitur-utama)
- [Modul Aplikasi](#modul-aplikasi)
- [Peran Pengguna (Role)](#peran-pengguna-role)
- [Struktur Database](#struktur-database)
- [Instalasi](#instalasi)
- [Akun Default](#akun-default)
- [Struktur Folder](#struktur-folder)

---

## Tentang Aplikasi

**Klinik Bidan Sejahtera** adalah aplikasi manajemen klinik kebidanan berbasis web yang dibangun dengan Laravel 12. Aplikasi ini mencakup seluruh alur layanan klinik mulai dari pendaftaran antrian publik, rekam medis kehamilan, persalinan, nifas, imunisasi, keluarga berencana, manajemen transaksi, surat rujukan, hingga laporan klinik.

---

## Teknologi yang Digunakan

| Komponen | Teknologi |
|---|---|
| Framework Backend | Laravel 12 (PHP ^8.2) |
| Autentikasi | Laravel Breeze |
| Manajemen Role | Spatie Laravel Permission v6 |
| Frontend CSS | Tailwind CSS (via CDN) |
| Komponen Reaktif | Alpine.js v3 |
| Tabel Data | jQuery DataTables 1.13.6 |
| Select Interaktif | Select2 v4.1 |
| Notifikasi | SweetAlert2 v11 |
| Icon | Font Awesome 6 |
| Primary Key | UUID (custom HasUuid trait) |

---

## Fitur Utama

### Halaman Publik
- Landing page klinik dengan informasi layanan, tim bidan, dan jadwal praktik
- **Form Daftar Antrian** via modal popup — pasien baru atau lama dapat mendaftar langsung dari halaman utama
- Tampilan status antrian hari ini (total terdaftar, dalam antrian, estimasi tunggu)
- Jadwal shift bidan (Pagi / Siang / Malam) ditampilkan secara real-time

### Dashboard Admin
- Statistik ringkasan: total pasien, antrian hari ini, transaksi, dan pendapatan bulan ini
- Grafik kunjungan dan transaksi
- Daftar antrian terbaru

### Dashboard Bidan
- Daftar pasien yang perlu dilayani hari ini
- Akses cepat ke rekam medis, ANC, persalinan, nifas

### Dashboard Apotek
- Daftar resep yang belum disiapkan
- Monitoring stok obat menipis

---

## Modul Aplikasi

### 1. Manajemen Antrian & Jadwal (Appointments)
- Pendaftaran antrian dari halaman publik maupun admin
- Nomor antrian otomatis berformat `A-001`, `A-002`, dst. (reset harian)
- Status antrian: `pending` → `scheduled` → `completed`
- Assign bidan ke jadwal kunjungan

### 2. Data Pasien
- CRUD data pasien lengkap (NIK, tanggal lahir, golongan darah, BPJS, dll.)
- Pencarian pasien berdasarkan nama, NIK, nomor HP, atau nomor BPJS
- Riwayat kunjungan, kehamilan, dan transaksi per pasien

### 3. Data Bidan
- CRUD data bidan dengan akun pengguna terintegrasi
- Nomor SIP (Surat Izin Praktik)
- Jadwal praktik per shift (Pagi, Siang, Malam)
- Status aktif/nonaktif

### 4. Pemeriksaan Kehamilan (ANC — Antenatal Care)
- Pencatatan data kehamilan (HPHT, HPL otomatis +280 hari, riwayat G/P/A)
- Kunjungan ANC per kehamilan dengan data:
  - Usia kehamilan (minggu), tinggi fundus uteri (TFU)
  - Detak jantung janin (DJJ), posisi janin
  - Berat badan, tekanan darah
  - Hasil laboratorium, keluhan, tindakan
- Status kehamilan: `active` / `delivered` / `aborted`

### 5. Persalinan (Delivery)
- Dokumentasi lengkap proses persalinan:
  - Waktu persalinan, metode, kondisi bayi lahir
  - Durasi kala I, II, III
  - Kondisi perineum, plasenta, perdarahan (ml)
  - Komplikasi yang terjadi
- Terhubung otomatis ke data kehamilan

### 6. Data Bayi
- Pencatatan data bayi baru lahir:
  - Berat lahir (gram), panjang lahir (cm)
  - Jenis kelamin, kondisi saat lahir
- Terhubung ke data persalinan dan data ibu (pasien)

### 7. Kunjungan Nifas (PNC — Postnatal Care)
- Jadwal kunjungan nifas KF1 s/d KF4 sesuai standar:
  - KF1: 6 jam–2 hari
  - KF2: 3–7 hari
  - KF3: 8–28 hari
  - KF4: 29–42 hari
- Pemantauan kondisi lokia, TFU, tekanan darah
- Status menyusui (lancar / bermasalah)

### 8. Imunisasi
- Jenis imunisasi dengan rekomendasi usia (dalam hari)
- Pencatatan imunisasi per pasien/bayi:
  - Tanggal pemberian, nomor batch vaksin
  - Terhubung ke data kunjungan

### 9. Keluarga Berencana (KB)
- Pencatatan akseptor KB:
  - Metode: Suntik 1 Bulan, Suntik 3 Bulan, Pil KB, IUD/Spiral, Implan/Susuk, Kondom
  - Tanggal kunjungan, berat badan, tekanan darah
  - Efek samping / keluhan
  - Tanggal kunjungan ulang dihitung otomatis sesuai metode

### 10. Rekam Medis (SOAP)
- Catatan medis format SOAP (Subjective, Objective, Assessment, Plan)
- Terhubung ke kunjungan dan pasien

### 11. Transaksi & Pembayaran
- Pembuatan transaksi dengan beberapa item layanan sekaligus (multi-service)
- Kode invoice otomatis format `INV-YYYYMMDD-XXXX`
- Metode pembayaran: Tunai, Transfer, QRIS, BPJS
- Status pembayaran: `paid` / `unpaid`
- Cetak invoice (print-friendly)

### 12. Surat Rujukan
- Pembuatan surat rujukan ke rumah sakit langsung dari klinik
- Tipe rujukan: `emergency` (darurat) / `regular` (biasa)
- Status rujukan: `pending` → `sent` → `received`
- Data lengkap: diagnosis, alasan rujukan, rumah sakit tujuan, alamat
- Cetak surat rujukan resmi (print-friendly dengan kop klinik)

### 13. Obat & Stok (Apotek)
- Manajemen inventaris obat dan bahan medis
- Monitoring stok minimum dengan peringatan
- Pencatatan tanggal kadaluarsa
- Resep dari bidan terhubung ke stok obat

### 14. Layanan Klinik
- Master data layanan dengan kategori dan harga
- Status aktif/nonaktif per layanan

### 15. Laporan
- Laporan kunjungan, transaksi, dan aktivitas klinik

### 16. CMS Website
- Manajemen konten halaman publik (slider, highlight layanan, FAQ, pengumuman, kontak)
- Status publish/unpublish per konten

---

## Peran Pengguna (Role)

| Role | Deskripsi | Akses |
|---|---|---|
| `admin` | Administrator / Resepsionis | Semua modul, manajemen pengguna, laporan |
| `bidan` | Bidan / Tenaga Medis | Pasien, rekam medis, ANC, persalinan, nifas, KB, imunisasi, rujukan |
| `pharmacy` | Staf Apotek | Manajemen obat, stok, resep |
| `patient` | Pasien | Hanya melihat data pribadi sendiri |

---

## Struktur Database

Total **20+ tabel** dengan UUID sebagai primary key di seluruh tabel utama.

| Tabel | Deskripsi |
|---|---|
| `users` | Akun pengguna (autentikasi) |
| `patients` | Data pasien (NIK, tanggal lahir, BPJS, dll.) |
| `midwives` | Data bidan (SIP, jadwal, bio) |
| `services` | Layanan klinik (nama, kategori, harga) |
| `medicines` | Inventaris obat dan bahan medis |
| `practice_schedules` | Jadwal shift bidan |
| `appointments` | Antrian dan jadwal kunjungan |
| `medical_records` | Rekam medis SOAP |
| `pregnancies` | Data kehamilan (HPHT, HPL, G/P/A) |
| `anc_visits` | Kunjungan ANC per kehamilan |
| `deliveries` | Dokumentasi persalinan |
| `babies` | Data bayi baru lahir |
| `pnc_visits` | Kunjungan nifas (KF1–KF4) |
| `family_plannings` | Akseptor KB |
| `immunization_types` | Jenis vaksin dan rekomendasi usia |
| `immunization_records` | Catatan pemberian imunisasi |
| `transactions` | Tagihan dan pembayaran |
| `transaction_details` | Item per transaksi (layanan/obat) |
| `prescriptions` | Resep obat dari bidan |
| `referrals` | Surat rujukan ke rumah sakit |
| `website_contents` | Konten CMS halaman publik |

---

## Instalasi

```bash
# 1. Clone repositori
git clone <repo-url>
cd clinic-midwife

# 2. Install dependensi PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Konfigurasi database di .env
DB_CONNECTION=mysql
DB_DATABASE=clinic_midwife
DB_USERNAME=root
DB_PASSWORD=

# 6. Jalankan migrasi dan seeder
php artisan migrate --seed

# 7. Jalankan server
php artisan serve
```

Buka di browser: `http://localhost:8000`

---

## Akun Default

Setelah `php artisan migrate --seed`, akun berikut tersedia:

| Nama | Email | Password | Role |
|---|---|---|---|
| Administrator | admin@clinic.com | password | admin |
| Bidan Siti (Shift Pagi) | siti@clinic.com | password | bidan |
| Bidan Dewi (Shift Siang) | dewi@clinic.com | password | bidan |
| Bidan Rina (Shift Malam) | rina@clinic.com | password | bidan |
| 7 Pasien Contoh | pasien{1-7}@clinic.com | password | patient |

---

## Struktur Folder

```
app/
├── Http/Controllers/           # 23 controller (satu per modul)
├── Models/                     # 21 model (semua menggunakan UUID)
└── Traits/HasUuid.php          # Trait generate UUID otomatis

database/
├── migrations/                 # 24 file migrasi tabel
└── seeders/
    ├── DatabaseSeeder.php
    ├── RoleSeeder.php          # Role & permission Spatie
    ├── MasterDataSeeder.php    # Layanan, obat, jadwal bidan
    └── ClinicalSeeder.php      # Data klinis contoh

resources/views/
├── components/
│   └── admin-layout.blade.php  # Layout utama seluruh halaman admin
├── auth/
│   └── login.blade.php         # Halaman login custom
├── welcome.blade.php           # Landing page publik
├── appointments/               # Antrian & jadwal kunjungan
├── patients/                   # Manajemen data pasien
├── midwives/                   # Manajemen data bidan
├── pregnancies/                # Pencatatan kehamilan
├── anc-visits/                 # Pemeriksaan ANC
├── deliveries/                 # Dokumentasi persalinan
├── babies/                     # Data bayi baru lahir
├── pnc-visits/                 # Kunjungan nifas
├── family-plannings/           # Keluarga berencana
├── immunizations/              # Imunisasi
├── transactions/               # Transaksi & invoice
├── referrals/                  # Surat rujukan RS
├── medicines/                  # Obat & stok apotek
├── services/                   # Layanan klinik
├── reports/                    # Laporan
└── website-contents/           # CMS konten website

routes/
├── web.php                     # Semua route aplikasi
└── auth.php                    # Route autentikasi (Breeze)
```

---

## Dependensi Utama

```json
{
  "require": {
    "laravel/framework": "^12.0",
    "spatie/laravel-permission": "^6.24"
  },
  "require-dev": {
    "laravel/breeze": "^2.3",
    "laravel/sail": "^1.41",
    "fakerphp/faker": "^1.23"
  }
}
```

---

> Dikembangkan untuk mendukung pelayanan kesehatan ibu dan anak di Indonesia.
