<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false, darkMode: false }"
    :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clinic Admin System</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Select2 custom styling */
        .select2-container--default .select2-selection--single {
            height: 46px !important;
            border-radius: 0.5rem !important;
            border-color: #E2E8F0 !important;
            background-color: transparent !important;
            display: flex;
            align-items: center;
            padding: 0 12px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: normal !important;
            padding-left: 4px !important;
            color: inherit !important;
            font-size: 0.875rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px !important;
            right: 8px !important;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #3C50E0 !important;
        }
        .select2-dropdown {
            border-radius: 0.5rem !important;
            border-color: #E2E8F0 !important;
            font-size: 0.875rem;
        }
        .select2-container { width: 100% !important; }
        .dark .select2-container--default .select2-selection--single {
            background-color: #1A222C !important;
            border-color: #4B5563 !important;
            color: #fff;
        }
        .dark .select2-dropdown {
            background-color: #24303F;
            border-color: #4B5563 !important;
            color: #fff;
        }
        .dark .select2-container--default .select2-results__option {
            background-color: #24303F;
            color: #e5e7eb;
        }
        .dark .select2-container--default .select2-search--dropdown .select2-search__field {
            background-color: #1A222C;
            color: #fff;
            border-color: #4B5563;
        }
    </style>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#3C50E0',
                        secondary: '#80CAEE',
                        dark: '#1A222C',
                        darker: '#24303F'
                    }
                }
            }
    }
    </script>
</head>

<body class="font-sans antialiased bg-gray-100 text-slate-800 dark:bg-dark dark:text-gray-200">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="absolute left-0 top-0 z-50 flex h-screen w-72.5 flex-col overflow-y-hidden bg-darker duration-300 ease-linear lg:static lg:translate-x-0 w-64 text-white">
            <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5 mt-4">
                <a href="{{ route('dashboard') }}" class="text-2xl font-bold flex items-center gap-2">
                    <i class="fas fa-heartbeat text-primary"></i>
                    <span>MidwifeApp</span>
                </a>
                <button @click="sidebarOpen = false" class="block lg:hidden">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </div>

            <div class="flex flex-col overflow-y-auto duration-300 ease-linear">
                <nav class="mt-5 px-4 lg:mt-9 lg:px-6">
                    <div>
                        <h3 class="mb-4 text-sm font-semibold text-gray-400 uppercase">Menu Utama</h3>
                        <ul class="mb-6 flex flex-col gap-1.5 space-y-1">
                            <li>
                                <a href="{{ route('dashboard') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-th-large"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('appointments.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('appointments.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-calendar-check"></i> Jadwal & Antrian
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('patients.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('patients.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-user-injured"></i> Data Pasien
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('midwives.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('midwives.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-user-nurse"></i> Data Bidan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('services.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('services.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-hand-holding-medical"></i> Layanan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('medicines.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('medicines.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-pills"></i> Obat & Stok
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="mb-4 text-sm font-semibold text-gray-400 uppercase">Klinis & Layanan</h3>
                        <ul class="mb-6 flex flex-col gap-1.5 space-y-1">
                            <li>
                                <a href="{{ route('appointments.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('appointments.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-calendar-check"></i> Kunjungan / Antrian
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pregnancies.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('pregnancies.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-baby-carriage"></i> Kehamilan Ibu
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('anc-visits.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('anc-visits.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-notes-medical"></i> Pemeriksaan ANC
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('deliveries.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('deliveries.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-hospital-user"></i> Persalinan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('babies.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('babies.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-baby"></i> Data Bayi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('immunizations.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('immunizations.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-syringe"></i> Imunisasi
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="mb-4 text-sm font-semibold text-gray-400 uppercase">Konten & Blog</h3>
                        <ul class="mb-6 flex flex-col gap-1.5 space-y-1">
                            <li>
                                <a href="{{ route('posts.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('posts.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-newspaper"></i> Artikel & Berita
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('categories.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('categories.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-tags"></i> Kategori
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="mb-4 text-sm font-semibold text-gray-400 uppercase">Manajemen</h3>
                        <ul class="mb-6 flex flex-col gap-1.5 space-y-1">
                            <li>
                                <a href="{{ route('transactions.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('transactions.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-wallet"></i> Transaksi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('referrals.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('referrals.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-ambulance"></i> Surat Rujukan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('website-contents.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('website-contents.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-globe"></i> Website CMS
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('reports.index') }}"
                                    class="flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium {{ request()->routeIs('reports.*') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                                    <i class="fas fa-chart-line"></i> Laporan
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Content Area -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- Header -->
            <header
                class="sticky top-0 z-40 flex w-full bg-white drop-shadow-1 dark:bg-darker dark:drop-shadow-none p-4 justify-between items-center shadow-sm">
                <div class="flex items-center gap-2">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="block lg:hidden p-2 rounded border border-gray-300">
                        <i class="fas fa-bars"></i>
                    </button>
                    <!-- Search could go here -->
                </div>

                <div class="flex items-center gap-4">
                    <!-- User Profile -->
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <div class="text-sm font-medium text-black dark:text-white">
                                {{ Auth::user()->name ?? 'Guest' }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ Auth::user()->roles->pluck('name')->join(', ') ?? 'Role' }}
                            </div>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600">
                            <i class="fas fa-user"></i>
                        </div>
                        <!-- Logout Form -->
                        <form method="POST" action="{{ route('logout') }}" class="ml-2">
                            @csrf
                            <button type="submit" class="text-sm text-red-500 hover:text-red-700"><i
                                    class="fas fa-sign-out-alt"></i></button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    {{ $slot }}
                </div>
            </main>
        </div>

    </div>

<script>
$(document).ready(function () {
    // Initialize Select2 on all select elements (skip Alpine-controlled ones)
    $('select:not([x-model]):not([x-bind])').select2({
        placeholder: '-- Pilih --',
        allowClear: true,
        width: '100%',
    });

    // SweetAlert2 flash notifications
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ addslashes(session('success')) }}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ addslashes(session('error')) }}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true,
        });
    @endif

    @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian!',
            text: '{{ addslashes(session('warning')) }}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
        });
    @endif

    // SweetAlert2 confirm delete
    $(document).on('submit', 'form[data-confirm]', function (e) {
        e.preventDefault();
        const form = this;
        const msg = $(form).data('confirm') || 'Data ini akan dihapus permanen.';
        Swal.fire({
            title: 'Hapus Data?',
            text: msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e53e3e',
            cancelButtonColor: '#718096',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    });
});
</script>

</body>

</html>