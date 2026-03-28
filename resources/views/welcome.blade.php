<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{ bookingOpen: false }"
    x-init="$watch('bookingOpen', val => {
        if (val) {
            $nextTick(() => {
                window._s2open = false;
                $('#select-service').select2({
                    placeholder: '-- Pilih Layanan --',
                    allowClear: true,
                    dropdownParent: $('body'),
                    width: '100%',
                });
                $('#select-service').on('select2:open',  () => { window._s2open = true;  });
                $('#select-service').on('select2:close', () => { setTimeout(() => { window._s2open = false; }, 150); });
            });
        } else {
            if ($('#select-service').data('select2')) {
                $('#select-service').select2('destroy');
            }
        }
    })">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klinik Bidan Sejahtera - Melayani dengan Hati</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <!-- AOS Scroll Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
        /* Parallax */
        .parallax-bg {
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
        }
        @media (max-width: 768px) {
            .parallax-bg { background-attachment: scroll; }
        }
        .modal-enter { animation: modalIn 0.3s ease forwards; }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.95) translateY(10px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }
        .input-pub {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border-radius: 10px;
            border: 1.5px solid #e5e7eb;
            background: #f9fafb;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }
        .input-pub:focus {
            border-color: #db2777;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(219,39,119,0.12);
        }
        .select-pub {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border-radius: 10px;
            border: 1.5px solid #e5e7eb;
            background: #f9fafb;
            font-size: 0.875rem;
            outline: none;
            appearance: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }
        .select-pub:focus {
            border-color: #db2777;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(219,39,119,0.12);
        }
        /* Select2 — body appended, z-index above modal (z-[999]) */
        .select2-container--open .select2-dropdown { z-index: 10000 !important; }
        /* Force always open below */
        .select2-dropdown--above {
            top: calc(100% + 4px) !important;
            bottom: auto !important;
            border-radius: 10px !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
        }
        /* Select field styling */
        .select2-container { width: 100% !important; }
        .select2-container--default .select2-selection--single {
            height: 46px !important;
            border-radius: 10px !important;
            border: 1.5px solid #e5e7eb !important;
            background: #f9fafb !important;
            padding-left: 40px;
            display: flex !important;
            align-items: center;
        }
        .select2-container--default.select2-container--open .select2-selection--single,
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #db2777 !important;
            background: #fff !important;
            box-shadow: 0 0 0 3px rgba(219,39,119,0.12) !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: normal !important;
            padding-left: 0 !important;
            color: #374151;
            font-size: 0.875rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__placeholder { color: #9ca3af; }
        .select2-container--default .select2-selection--single .select2-selection__arrow { display: none; }
        /* Dropdown styling */
        .select2-dropdown {
            border-radius: 10px !important;
            border: 1.5px solid #e5e7eb !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
            font-size: 0.875rem;
            overflow: hidden;
        }
        .select2-search--dropdown { padding: 8px; }
        .select2-search--dropdown .select2-search__field {
            border-radius: 8px;
            border: 1.5px solid #e5e7eb;
            padding: 7px 12px;
            font-size: 0.8rem;
            outline: none;
        }
        .select2-search--dropdown .select2-search__field:focus { border-color: #db2777; }
        .select2-container--default .select2-results__option { padding: 10px 16px; color: #374151; }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #db2777 !important;
        }
    </style>
</head>

<body class="antialiased text-gray-700 bg-white">

    <!-- Top Bar -->
    <div class="bg-pink-600 text-white py-2 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center text-sm">
            <div class="flex space-x-6">
                <span><i class="fas fa-envelope mr-2"></i> info@klinikbidansejahtera.com</span>
                <span><i class="fas fa-phone mr-2"></i> +62 812 3456 7890</span>
            </div>
            <div class="flex space-x-6">
                <span><i class="fas fa-clock mr-2"></i> Senin - Sabtu: 08:00 - 20:00</span>
                <div class="flex space-x-3">
                    <a href="#" class="hover:text-pink-200"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-pink-200"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-pink-200"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="#" class="flex items-center space-x-2">
                        <i class="fas fa-heartbeat text-3xl text-pink-600"></i>
                        <span class="text-2xl font-bold text-gray-800">Bidan<span
                                class="text-pink-600">Sejahtera</span></span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-700 hover:text-pink-600 font-medium uppercase text-sm">Beranda</a>
                    <a href="#about" class="text-gray-700 hover:text-pink-600 font-medium uppercase text-sm">Tentang</a>
                    <a href="#services"
                        class="text-gray-700 hover:text-pink-600 font-medium uppercase text-sm">Layanan</a>
                    <a href="#team" class="text-gray-700 hover:text-pink-600 font-medium uppercase text-sm">Bidan</a>
                    <a href="#contact"
                        class="text-gray-700 hover:text-pink-600 font-medium uppercase text-sm">Kontak</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="px-5 py-2 bg-pink-600 text-white rounded-full font-bold hover:bg-pink-700 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-5 py-2 border-2 border-pink-600 text-pink-600 rounded-full font-bold hover:bg-pink-600 hover:text-white transition">Masuk</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative h-[700px] flex items-center bg-cover bg-center"
        style="background-image: url('https://images.unsplash.com/photo-1531983412531-1f49a365ffed?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80');">
        <div class="absolute inset-0 bg-gradient-to-r from-pink-900/90 to-purple-900/80"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-white relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-pink-400 font-bold tracking-wider uppercase mb-2">Selamat Datang di Klinik Kami</h3>
                    <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4">Kesehatan Ibu & Anak <br> Prioritas
                        Utama Kami</h1>
                    <p class="text-lg opacity-90 mb-8">Memberikan pelayanan kebidanan profesional, ramah, dan terpercaya
                        untuk mendampingi masa-masa indah kehamilan hingga tumbuh kembang si kecil.</p>
                    <button @click="bookingOpen = true"
                        class="inline-flex items-center gap-2 px-8 py-3.5 bg-pink-600 text-white font-bold rounded-full shadow-lg hover:bg-pink-700 active:scale-95 transition">
                        <i class="fas fa-calendar-plus"></i> Buat Janji Temu
                    </button>
                </div>

                <!-- Queue Stats Card -->
                <div class="hidden lg:block relative">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-pink-600 to-purple-600 rounded-lg blur opacity-75">
                    </div>
                    <div class="relative bg-white/10 backdrop-blur-md border border-white/20 rounded-lg p-8 text-white">
                        <h3 class="text-2xl font-bold mb-6 text-center border-b border-white/20 pb-4">Status Antrian
                            Hari Ini</h3>
                        <div class="grid grid-cols-2 gap-6 text-center">
                            <div>
                                <span class="block text-4xl font-bold mb-1">{{ $totalQueue ?? 0 }}</span>
                                <span class="text-sm opacity-80">Total Terdaftar</span>
                            </div>
                            <div>
                                <span
                                    class="block text-4xl font-bold mb-1 text-pink-400">{{ $pendingQueue ?? 0 }}</span>
                                <span class="text-sm opacity-80">Dalam Antrian</span>
                            </div>
                        </div>
                        <div class="mt-8 text-center bg-white/20 rounded p-4">
                            <p class="text-sm mb-1">Estimasi Waktu Tunggu</p>
                            <p class="text-xl font-bold">~15 Menit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Modal -->
    <div x-cloak x-show="bookingOpen"
        class="fixed inset-0 z-[999] flex items-center justify-center p-4"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">

        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="if(!window._s2open) bookingOpen = false"></div>

        <!-- Modal Card -->
        <div id="booking-modal-card" class="relative w-full max-w-xl bg-white rounded-2xl shadow-2xl modal-enter"
            @click.stop>

            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-pink-600 to-pink-500 px-6 py-5 text-white rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-calendar-plus text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold leading-tight">Daftar Antrian</h3>
                            <p class="text-pink-100 text-xs">Isi data di bawah untuk mendaftar kunjungan</p>
                        </div>
                    </div>
                    <button @click="bookingOpen = false"
                        class="w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form id="booking-modal-form" action="{{ route('queue.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Row 1: Nama + No HP -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 pointer-events-none">
                                    <i class="fas fa-user text-sm"></i>
                                </span>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    placeholder="Nama lengkap pasien"
                                    class="input-pub" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">
                                No. HP / WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 pointer-events-none">
                                    <i class="fas fa-phone text-sm"></i>
                                </span>
                                <input type="text" name="phone" value="{{ old('phone') }}" required
                                    placeholder="08xx-xxxx-xxxx"
                                    class="input-pub" />
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Tanggal Lahir + Tanggal Kunjungan -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 pointer-events-none">
                                    <i class="fas fa-birthday-cake text-sm"></i>
                                </span>
                                <input type="date" name="dob" value="{{ old('dob') }}" required
                                    class="input-pub" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">
                                Tanggal Kunjungan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 pointer-events-none">
                                    <i class="fas fa-calendar text-sm"></i>
                                </span>
                                <input type="date" name="visit_date" value="{{ old('visit_date', date('Y-m-d')) }}"
                                    required min="{{ date('Y-m-d') }}"
                                    class="input-pub" />
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Layanan -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">
                            Jenis Layanan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 pointer-events-none z-10">
                                <i class="fas fa-stethoscope text-sm"></i>
                            </span>
                            <select id="select-service" name="service" required class="select-pub">
                                <option value="">-- Pilih Layanan --</option>
                                <option value="ANC"        {{ old('service') == 'ANC'        ? 'selected' : '' }}>Pemeriksaan Kehamilan (ANC)</option>
                                <option value="Persalinan" {{ old('service') == 'Persalinan' ? 'selected' : '' }}>Persalinan Normal</option>
                                <option value="Imunisasi"  {{ old('service') == 'Imunisasi'  ? 'selected' : '' }}>Imunisasi Anak</option>
                                <option value="KB"         {{ old('service') == 'KB'         ? 'selected' : '' }}>Keluarga Berencana (KB)</option>
                                <option value="Nifas"      {{ old('service') == 'Nifas'      ? 'selected' : '' }}>Kunjungan Nifas</option>
                                <option value="Umum"       {{ old('service') == 'Umum'       ? 'selected' : '' }}>Konsultasi Umum</option>
                            </select>
                        </div>
                    </div>

                    <!-- Info Note -->
                    <div class="flex items-start gap-2.5 rounded-xl bg-pink-50 border border-pink-100 p-3.5">
                        <i class="fas fa-info-circle text-pink-400 mt-0.5 flex-shrink-0"></i>
                        <p class="text-xs text-pink-700 leading-relaxed">
                            Nomor antrian akan dikirim via WhatsApp. Pastikan nomor HP aktif dan dapat dihubungi.
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-1">
                        <button type="button" @click="bookingOpen = false"
                            class="flex-1 py-3 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold text-sm hover:bg-gray-50 transition active:scale-95">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 flex items-center justify-center gap-2 py-3 rounded-xl bg-pink-600 text-white font-semibold text-sm hover:bg-pink-700 transition active:scale-95 shadow-md shadow-pink-200">
                            <i class="fas fa-paper-plane"></i> Daftar Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section class="py-16 bg-white" id="about">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right" data-aos-duration="800">
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/midwife-provides-prenatal-care-and-assists-with-childbirth-illustration-svg-download-png-6910614.png"
                        alt="Ilustrasi Bidan"
                        class="w-full max-w-md mx-auto drop-shadow-2xl hover:scale-105 transition duration-500">
                </div>
                <div data-aos="fade-left" data-aos-duration="800">
                    <h4 class="text-pink-600 font-bold uppercase tracking-wide mb-2">Tentang Kami</h4>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Mitra Terpercaya untuk Keluarga Sehat</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Kami adalah klinik bidan yang berdedikasi untuk memberikan layanan kesehatan holistik bagi ibu
                        dan anak. Dengan fasilitas yang nyaman dan tenaga medis yang berpengalaman, kami memastikan
                        setiap kunjungan Anda menjadi pengalaman yang menenangkan.
                    </p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start" data-aos="fade-up" data-aos-delay="100">
                            <i class="fas fa-check-circle text-pink-600 mt-1 mr-3"></i>
                            <span class="text-gray-700">Bidan tersertifikasi dan berpengalaman lebih dari 10 tahun.</span>
                        </li>
                        <li class="flex items-start" data-aos="fade-up" data-aos-delay="200">
                            <i class="fas fa-check-circle text-pink-600 mt-1 mr-3"></i>
                            <span class="text-gray-700">Fasilitas persalinan 24 jam yang steril dan hommy.</span>
                        </li>
                        <li class="flex items-start" data-aos="fade-up" data-aos-delay="300">
                            <i class="fas fa-check-circle text-pink-600 mt-1 mr-3"></i>
                            <span class="text-gray-700">Pelayanan ramah anak dan konseling laktasi.</span>
                        </li>
                    </ul>
                    <a href="#" class="text-pink-600 font-bold hover:text-pink-800" data-aos="fade-up" data-aos-delay="400">
                        Pelajari Lebih Lanjut <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Parallax Divider -->
    <div class="parallax-bg relative h-48 flex items-center justify-center"
        style="background-image: url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80');">
        <div class="absolute inset-0 bg-pink-800/70"></div>
        <div class="relative z-10 text-center text-white" data-aos="zoom-in">
            <p class="text-2xl font-bold tracking-wide">Kesehatan Anda, Prioritas Kami</p>
            <p class="text-pink-200 mt-1">Lebih dari 1.000 ibu dan bayi telah kami layani dengan sepenuh hati</p>
        </div>
    </div>

    <!-- Services Section -->
    <section class="py-16 bg-gray-50" id="services">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h4 class="text-pink-600 font-bold uppercase tracking-wide mb-2">Layanan Kami</h4>
                <h2 class="text-3xl font-bold text-gray-900">Solusi Kesehatan Lengkap</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition group" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6 text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition">
                        <i class="fas fa-baby-carriage text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Pemeriksaan Kehamilan (ANC)</h3>
                    <p class="text-gray-600">Pemantauan kesehatan ibu dan janin secara berkala dengan standar pelayanan terkini.</p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6 text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition">
                        <i class="fas fa-hospital-user text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Persalinan Normal</h3>
                    <p class="text-gray-600">Layanan persalinan 24 jam dengan asuhan sayang ibu dan bayi serta inisiasi menyusui dini.</p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6 text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition">
                        <i class="fas fa-syringe text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Imunisasi Dasar</h3>
                    <p class="text-gray-600">Lengkapi perlindungan buah hati dengan imunisasi dasar lengkap dan vaksin tambahan.</p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition group" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6 text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition">
                        <i class="fas fa-pills text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Keluarga Berencana (KB)</h3>
                    <p class="text-gray-600">Konseling dan pelayanan kontrasepsi (Suntik, Pil, IUD, Implant) sesuai kebutuhan.</p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6 text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition">
                        <i class="fas fa-child text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Tumbuh Kembang Anak</h3>
                    <p class="text-gray-600">Deteksi dini tumbuh kembang balita dan stimulasi perkembangan anak.</p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6 text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition">
                        <i class="fas fa-user-md text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Konsultasi Kesehatan Wanita</h3>
                    <p class="text-gray-600">Layanan kesehatan reproduksi remaja, pra-nikah, hingga masa menopause.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Schedule Section (Jadwal Bidan) -->
    <section class="py-16 bg-white border-t" id="schedule">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h4 class="text-pink-600 font-bold uppercase tracking-wide mb-2">Jadwal Praktik</h4>
                <h2 class="text-3xl font-bold text-gray-900">Siap Melayani Anda Sepanjang Hari</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Shift Pagi -->
                <div class="bg-blue-50 rounded-xl p-8 border border-blue-100 hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="0">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 rounded-full bg-blue-500 text-white flex items-center justify-center text-xl mr-4">
                            <i class="fas fa-sun"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Shift Pagi</h3>
                            <p class="text-blue-600 font-medium">07:00 - 15:00 WIB</p>
                        </div>
                    </div>
                    @if(count($shifts['Pagi']) > 0)
                        <ul class="space-y-4">
                            @foreach($shifts['Pagi'] as $schedule)
                                <li class="flex items-center bg-white p-3 rounded shadow-sm">
                                    <img src="{{ $schedule->midwife->photo_path ?? 'https://ui-avatars.com/api/?name=' . urlencode($schedule->midwife->user->name) }}"
                                        class="w-10 h-10 rounded-full object-cover mr-3">
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">{{ $schedule->midwife->user->name }}</p>
                                        <p class="text-xs text-gray-500">Bidan Jaga</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 italic">Tidak ada jadwal.</p>
                    @endif
                </div>

                <!-- Shift Siang -->
                <div class="bg-orange-50 rounded-xl p-8 border border-orange-100 hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="150">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 rounded-full bg-orange-500 text-white flex items-center justify-center text-xl mr-4">
                            <i class="fas fa-cloud-sun"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Shift Siang</h3>
                            <p class="text-orange-600 font-medium">15:00 - 22:00 WIB</p>
                        </div>
                    </div>
                    @if(count($shifts['Siang']) > 0)
                        <ul class="space-y-4">
                            @foreach($shifts['Siang'] as $schedule)
                                <li class="flex items-center bg-white p-3 rounded shadow-sm">
                                    <img src="{{ $schedule->midwife->photo_path ?? 'https://ui-avatars.com/api/?name=' . urlencode($schedule->midwife->user->name) }}"
                                        class="w-10 h-10 rounded-full object-cover mr-3">
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">{{ $schedule->midwife->user->name }}</p>
                                        <p class="text-xs text-gray-500">Bidan Jaga</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 italic">Tidak ada jadwal.</p>
                    @endif
                </div>

                <!-- Shift Malam -->
                <div class="bg-indigo-50 rounded-xl p-8 border border-indigo-100 hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 rounded-full bg-indigo-500 text-white flex items-center justify-center text-xl mr-4">
                            <i class="fas fa-moon"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Shift Malam</h3>
                            <p class="text-indigo-600 font-medium">22:00 - 07:00 WIB</p>
                        </div>
                    </div>
                    @if(count($shifts['Malam']) > 0)
                        <ul class="space-y-4">
                            @foreach($shifts['Malam'] as $schedule)
                                <li class="flex items-center bg-white p-3 rounded shadow-sm">
                                    <img src="{{ $schedule->midwife->photo_path ?? 'https://ui-avatars.com/api/?name=' . urlencode($schedule->midwife->user->name) }}"
                                        class="w-10 h-10 rounded-full object-cover mr-3">
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">{{ $schedule->midwife->user->name }}</p>
                                        <p class="text-xs text-gray-500">Bidan Jaga</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 italic">Tidak ada jadwal.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Team / Midwife Section -->
    <section class="py-16 bg-white" id="team">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h4 class="text-pink-600 font-bold uppercase tracking-wide mb-2" data-aos="fade-up">Tim Kami</h4>
            <h2 class="text-3xl font-bold text-gray-900 mb-12" data-aos="fade-up" data-aos-delay="100">Bidan Profesional Anda</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $midwives = \App\Models\Midwife::with('user')->where('is_active', true)->get();
                @endphp

                @foreach($midwives as $midwife)
                    <div data-aos="zoom-in" data-aos-delay="{{ $loop->index * 150 }}"
                        class="bg-white border rounded-lg overflow-hidden relative group shadow-sm hover:shadow-md transition">
                        <div class="h-80 overflow-hidden">
                            <img src="{{ $midwife->photo_path ?? 'https://ui-avatars.com/api/?name=' . urlencode($midwife->user->name) }}"
                                alt="{{ $midwife->user->name }}"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-bold text-gray-900">{{ $midwife->user->name }}</h3>
                            <p class="text-pink-600 font-medium mb-3">SIP: {{ $midwife->sip_number }}</p>
                            <p class="text-gray-500 text-sm line-clamp-2">
                                {{ $midwife->bio ?? 'Bidan profesional berkomitmen untuk kesehatan ibu dan anak.' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Artikel Terbaru -->
    @php $latestPosts = \App\Models\Post::with('category')->where('status','published')->latest('published_at')->limit(3)->get(); @endphp
    @if($latestPosts->count() > 0)
    <section class="py-20 bg-gray-50" id="artikel">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="inline-block bg-primary/10 text-primary text-xs font-semibold px-4 py-1.5 rounded-full mb-3 uppercase tracking-wide">Blog & Berita</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Artikel Kesehatan Terkini</h2>
                <p class="text-gray-500 max-w-xl mx-auto">Informasi dan tips kesehatan dari tim profesional kami untuk keluarga Anda.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($latestPosts as $i => $post)
                <article data-aos="fade-up" data-aos-delay="{{ $i * 100 }}"
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow group">
                    <a href="{{ route('blog.show', $post->slug) }}">
                        @if($post->thumbnail)
                            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-pink-50 to-primary/10 flex items-center justify-center">
                                <i class="fas fa-newspaper text-4xl text-primary/30"></i>
                            </div>
                        @endif
                    </a>
                    <div class="p-5">
                        @if($post->category)
                            <span class="bg-primary/10 text-primary text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $post->category->name }}</span>
                        @endif
                        <h3 class="font-bold text-gray-900 mt-3 mb-2 text-base line-clamp-2 group-hover:text-primary transition-colors">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                        @if($post->excerpt)
                            <p class="text-gray-500 text-sm line-clamp-2 mb-4">{{ $post->excerpt }}</p>
                        @endif
                        <div class="flex items-center justify-between text-xs text-gray-400">
                            <span><i class="fas fa-calendar mr-1"></i>{{ $post->published_at?->format('d M Y') }}</span>
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-primary font-semibold hover:underline">
                                Baca <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            <div class="text-center mt-10" data-aos="fade-up">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-semibold rounded-full hover:bg-opacity-90 transition shadow-sm">
                    <i class="fas fa-newspaper"></i> Lihat Semua Artikel
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section — Parallax -->
    <section class="parallax-bg relative py-24 text-white text-center"
        style="background-image: url('https://images.unsplash.com/photo-1505751172876-fa1923c5c528?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80');">
        <div class="absolute inset-0 bg-pink-700/80"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-4" data-aos="fade-up">Siap untuk Kunjungan Anda?</h2>
            <p class="text-xl mb-8 opacity-90" data-aos="fade-up" data-aos-delay="100">
                Jangan ragu untuk berkonsultasi mengenai kesehatan kehamilan dan buah hati Anda bersama kami.
            </p>
            <button @click="bookingOpen = true" data-aos="zoom-in" data-aos-delay="200"
                class="inline-flex items-center gap-2 px-8 py-3.5 bg-white text-pink-600 font-bold rounded-full shadow-lg hover:bg-gray-50 active:scale-95 transition">
                <i class="fas fa-calendar-plus"></i> Daftar Antrian Sekarang
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12" id="contact">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-12">
            <div data-aos="fade-up" data-aos-delay="0">
                <div class="flex items-center mb-6">
                    <i class="fas fa-heartbeat text-3xl text-pink-500 mr-2"></i>
                    <span class="text-2xl font-bold text-white">Bidan<span class="text-pink-500">Sejahtera</span></span>
                </div>
                <p class="leading-relaxed mb-6">
                    Klinik Bidan Sejahtera berkomitmen memberikan pelayanan kesehatan terbaik dengan sentuhan
                    kekeluargaan (Home Care).
                </p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition"><i
                            class="fab fa-instagram"></i></a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition"><i
                            class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <div>
                <h3 class="text-white text-lg font-bold mb-6">Tautan Cepat</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="hover:text-pink-500 transition">Beranda</a></li>
                    <li><a href="#about" class="hover:text-pink-500 transition">Tentang Kami</a></li>
                    <li><a href="#services" class="hover:text-pink-500 transition">Layanan</a></li>
                    <li><a href="#booking" class="hover:text-pink-500 transition">Jadwal Praktek</a></li>
                    <li><a href="#" class="hover:text-pink-500 transition">Artikel Kesehatan</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white text-lg font-bold mb-6">Kontak Kami</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-pink-500"></i>
                        <span>Jl. Kebahagiaan No. 123, Jakarta Selatan, DKI Jakarta</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-phone-alt mt-1 mr-3 text-pink-500"></i>
                        <span>+62 812 3456 7890</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-envelope mt-1 mr-3 text-pink-500"></i>
                        <span>info@klinikbidansejahtera.com</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-clock mt-1 mr-3 text-pink-500"></i>
                        <span>Senin - Sabtu: 08.00 - 20.00 WIB</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-gray-800 text-center text-sm">
            &copy; 2025 Klinik Bidan Sejahtera. All Rights Reserved.
        </div>
    </footer>


<script>
    // Initialize AOS
    AOS.init({
        duration: 700,
        easing: 'ease-out-cubic',
        once: true,
        offset: 80,
    });

    @if(session('success'))
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Terdaftar!',
                html: '<p class="text-gray-600">{{ addslashes(session('success')) }}</p>',
                confirmButtonColor: '#db2777',
                confirmButtonText: 'Oke, Terima Kasih!',
                showClass: { popup: 'animate__animated animate__fadeInDown' },
            });
        });
    @endif

    @if(session('error'))
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Pendaftaran Gagal',
                html: '<p class="text-gray-600">{{ addslashes(session('error')) }}</p>',
                confirmButtonColor: '#db2777',
                confirmButtonText: 'Coba Lagi',
            });
        });
    @endif

    @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            // Re-open modal if there are validation errors
            document.querySelector('[x-data]').__x.$data.bookingOpen = true;
        });
    @endif
</script>

</body>

</html>