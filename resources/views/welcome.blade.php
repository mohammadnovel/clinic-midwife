<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klinik Bidan Sejahtera - Melayani dengan Hati</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1555252333-9f8e92e65df4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
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
                    <a href="#booking"
                        class="inline-block px-8 py-3 bg-pink-600 text-white font-bold rounded shadow hover:bg-pink-700 transition">Buat
                        Janji Temu</a>
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

    <!-- Booking Overlay -->
    <div class="relative -mt-12 z-10 px-4 mb-20" id="booking">
        <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-xl p-8 border-t-4 border-pink-600">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('queue.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-5 gap-6 items-end">
                    <div>
                        <label class="block text-gray-600 text-sm font-bold mb-2">Nama Lengkap</label>
                        <input type="text" name="name" placeholder="Nama Pasien" required
                            class="w-full px-4 py-3 rounded bg-gray-50 border border-gray-200 focus:outline-none focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm font-bold mb-2">No. HP</label>
                        <input type="text" name="phone" placeholder="08..." required
                            class="w-full px-4 py-3 rounded bg-gray-50 border border-gray-200 focus:outline-none focus:border-pink-500">
                    </div>
                    <div class="hidden">
                        <!-- Simplification: For new users, we might default DOB or ask it? 
                             Let's assume users might be returning, or we force a date. 
                             To avoid UI clutter, let's add DOB field but maybe small? 
                             Actually, 5 columns is tight. Let's start with basic fields.
                             Wait, controller requires DOB for new patients. 
                             Let's Add input type date for DOB.
                        -->
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm font-bold mb-2">Tgl Lahir</label>
                        <input type="date" name="dob" required
                            class="w-full px-4 py-3 rounded bg-gray-50 border border-gray-200 focus:outline-none focus:border-pink-500">
                    </div>

                    <div>
                        <label class="block text-gray-600 text-sm font-bold mb-2">Kunjungan</label>
                        <input type="date" name="visit_date" required min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-3 rounded bg-gray-50 border border-gray-200 focus:outline-none focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm font-bold mb-2">Layanan</label>
                        <select name="service" required
                            class="w-full px-4 py-3 rounded bg-gray-50 border border-gray-200 focus:outline-none focus:border-pink-500">
                            <option value="ANC">Pemeriksaan Kehamilan</option>
                            <option value="Persalinan">Persalinan</option>
                            <option value="Imunisasi">Imunisasi Anak</option>
                            <option value="KB">Keluarga Berencana</option>
                            <option value="Umum">Konsultasi Umum</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit"
                        class="w-full px-6 py-3 bg-gray-900 text-white font-bold rounded hover:bg-gray-800 transition">
                        Daftar Antrian
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- About Section -->
    <section class="py-16 bg-white" id="about">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/midwife-provides-prenatal-care-and-assists-with-childbirth-illustration-svg-download-png-6910614.png"
                        alt="Ilustrasi Bidan"
                        class="w-full max-w-md mx-auto drop-shadow-2xl hover:scale-105 transition duration-500">
                </div>
                <div>
                    <h4 class="text-pink-600 font-bold uppercase tracking-wide mb-2">Tentang Kami</h4>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Mitra Terpercaya untuk Keluarga Sehat</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Kami adalah klinik bidan yang berdedikasi untuk memberikan layanan kesehatan holistik bagi ibu
                        dan anak. Dengan fasilitas yang nyaman dan tenaga medis yang berpengalaman, kami memastikan
                        setiap kunjungan Anda menjadi pengalaman yang menenangkan.
                    </p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-pink-600 mt-1 mr-3"></i>
                            <span class="text-gray-700">Bidan tersertifikasi dan berpengalaman lebih dari 10
                                tahun.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-pink-600 mt-1 mr-3"></i>
                            <span class="text-gray-700">Fasilitas persalinan 24 jam yang steril dan hommy.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-pink-600 mt-1 mr-3"></i>
                            <span class="text-gray-700">Pelayanan ramah anak dan konseling laktasi.</span>
                        </li>
                    </ul>
                    <a href="#" class="text-pink-600 font-bold hover:text-pink-800">Pelajari Lebih Lanjut <i
                            class="fas fa-arrow-right ml-1"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-16 bg-gray-50" id="services">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h4 class="text-pink-600 font-bold uppercase tracking-wide mb-2">Layanan Kami</h4>
                <h2 class="text-3xl font-bold text-gray-900">Solusi Kesehatan Lengkap</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition group">
                    <div
                        class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6 text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition">
                        <i class="fas fa-baby-carriage text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Pemeriksaan Kehamilan (ANC)</h3>
                    <p class="text-gray-600 mb-4">Pemantauan kesehatan ibu dan janin secara berkala dengan standar
                        pelayanan terkini.</p>
                </div>

                <!-- Service 2 -->
                <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition group">
                    <div
                        class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6 text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition">
                        <i class="fas fa-hospital-user text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Persalinan Normal</h3>
                    <p class="text-gray-600 mb-4">Layanan persalinan 24 jam dengan asuhan sayang ibu dan bayi serta
                        inisiasi menyusui dini.</p>
                </div>

                <!-- Service 3 -->
                <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition group">
                    <div
                        class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6 text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition">
                        <i class="fas fa-syringe text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Imunisasi Dasar</h3>
                    <p class="text-gray-600 mb-4">Lengkapi perlindungan buah hati dengan imunisasi dasar lengkap dan
                        vaksin tambahan.</p>
                </div>

                <!-- Service 4 -->
                <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition group">
                    <div
                        class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6 text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition">
                        <i class="fas fa-pills text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Keluarga Berencana (KB)</h3>
                    <p class="text-gray-600 mb-4">Konseling dan pelayanan kontrasepsi (Suntik, Pil, IUD, Implant) sesuai
                        kebutuhan.</p>
                </div>

                <!-- Service 5 -->
                <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition group">
                    <div
                        class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6 text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition">
                        <i class="fas fa-child text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Tumbuh Kembang Anak</h3>
                    <p class="text-gray-600 mb-4">Deteksi dini tumbuh kembang balita dan stimulasi perkembangan anak.
                    </p>
                </div>

                <!-- Service 6 -->
                <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition group">
                    <div
                        class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6 text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition">
                        <i class="fas fa-user-md text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Konsultasi Kesehatan Wanita</h3>
                    <p class="text-gray-600 mb-4">Layanan kesehatan reproduksi remaja, pra-nikah, hingga masa menopause.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Schedule Section (Jadwal Bidan) -->
    <section class="py-16 bg-white border-t" id="schedule">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h4 class="text-pink-600 font-bold uppercase tracking-wide mb-2">Jadwal Praktik</h4>
                <h2 class="text-3xl font-bold text-gray-900">Siap Melayani Anda Sepanjang Hari</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Shift Pagi -->
                <div class="bg-blue-50 rounded-xl p-8 border border-blue-100 hover:shadow-lg transition">
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
                <div class="bg-orange-50 rounded-xl p-8 border border-orange-100 hover:shadow-lg transition">
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
                <div class="bg-indigo-50 rounded-xl p-8 border border-indigo-100 hover:shadow-lg transition">
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
            <h4 class="text-pink-600 font-bold uppercase tracking-wide mb-2">Tim Kami</h4>
            <h2 class="text-3xl font-bold text-gray-900 mb-12">Bidan Profesional Anda</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $midwives = \App\Models\Midwife::with('user')->where('is_active', true)->get();
                @endphp

                @foreach($midwives as $midwife)
                    <div
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

    <!-- CTA Section -->
    <section class="py-16 bg-pink-600 text-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-6">Siap untuk Kunjungan Anda?</h2>
            <p class="text-xl mb-8 opacity-90">Jangan ragu untuk berkonsultasi mengenai kesehatan kehamilan dan buah
                hati Anda bersama kami.</p>
            <a href="{{ route('login') }}"
                class="inline-block px-8 py-3 bg-white text-pink-600 font-bold rounded shadow hover:bg-gray-100 transition">Daftar
                Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12" id="contact">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-12">
            <div>
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

</body>

</html>