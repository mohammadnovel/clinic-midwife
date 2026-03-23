<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — Klinik Bidan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3C50E0',
                        primaryDark: '#2D3CB0',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #3C50E0 0%, #6C63FF 50%, #3C9BE0 100%);
        }
        .floating-card {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }
        .input-field {
            transition: all 0.2s ease;
        }
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(60, 80, 224, 0.15);
        }
    </style>
</head>
<body class="font-sans antialiased">

<div class="min-h-screen flex">

    <!-- Left Panel — Brand / Illustration -->
    <div class="hidden lg:flex lg:w-1/2 gradient-bg flex-col items-center justify-center p-12 relative overflow-hidden">

        <!-- Background circles -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/5 rounded-full translate-x-1/3 translate-y-1/3"></div>
        <div class="absolute top-1/3 right-0 w-48 h-48 bg-white/5 rounded-full translate-x-1/2"></div>

        <!-- Content -->
        <div class="relative z-10 text-center text-white max-w-md">
            <!-- Logo / Icon -->
            <div class="floating-card inline-flex items-center justify-center w-28 h-28 bg-white/20 rounded-3xl mb-8 backdrop-blur-sm border border-white/30 shadow-2xl">
                <i class="fas fa-heartbeat text-5xl text-white"></i>
            </div>

            <h1 class="text-4xl font-bold mb-3 leading-tight">Klinik Bidan<br>Sehat Ibu & Anak</h1>
            <p class="text-white/75 text-base leading-relaxed mb-10">
                Sistem informasi manajemen klinik terpadu untuk pelayanan ibu dan anak yang optimal.
            </p>

            <!-- Feature Highlights -->
            <div class="space-y-3 text-left">
                <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-3 backdrop-blur-sm">
                    <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-baby text-sm"></i>
                    </div>
                    <span class="text-sm font-medium">Pemantauan Kehamilan & ANC</span>
                </div>
                <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-3 backdrop-blur-sm">
                    <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-syringe text-sm"></i>
                    </div>
                    <span class="text-sm font-medium">Jadwal Imunisasi Terstruktur</span>
                </div>
                <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-3 backdrop-blur-sm">
                    <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-ambulance text-sm"></i>
                    </div>
                    <span class="text-sm font-medium">Manajemen Surat Rujukan</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Panel — Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-gray-50">
        <div class="w-full max-w-md">

            <!-- Mobile logo -->
            <div class="lg:hidden text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-2xl mb-4 shadow-lg">
                    <i class="fas fa-heartbeat text-2xl text-white"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Klinik Bidan</h2>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">Selamat Datang</h2>
                    <p class="text-gray-500 text-sm">Masukkan kredensial Anda untuk melanjutkan</p>
                </div>

                <!-- Session Status -->
                @if(session('status'))
                    <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-sm text-green-700 flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700">
                        <div class="flex items-center gap-2 mb-1">
                            <i class="fas fa-exclamation-circle"></i>
                            <span class="font-medium">Login gagal</span>
                        </div>
                        <ul class="list-disc pl-5 space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="fas fa-envelope text-sm"></i>
                            </span>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="nama@klinik.com"
                                class="input-field w-full pl-11 pr-4 py-3 rounded-xl border text-sm text-gray-900 placeholder-gray-400 outline-none focus:border-primary focus:bg-white {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-200 bg-gray-50' }}"
                            />
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs text-primary hover:text-primaryDark font-medium transition">
                                    Lupa password?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="fas fa-lock text-sm"></i>
                            </span>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="input-field w-full pl-11 pr-12 py-3 rounded-xl border text-sm text-gray-900 placeholder-gray-400 outline-none focus:border-primary focus:bg-white {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-200 bg-gray-50' }}"
                            />
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600">
                                <i id="eye-icon" class="fas fa-eye text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center gap-2">
                        <input
                            id="remember_me"
                            name="remember"
                            type="checkbox"
                            class="w-4 h-4 rounded border-gray-300 text-primary accent-primary cursor-pointer"
                        />
                        <label for="remember_me" class="text-sm text-gray-600 cursor-pointer select-none">
                            Ingat saya selama 30 hari
                        </label>
                    </div>

                    <!-- Submit -->
                    <button
                        type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-primaryDark text-white font-semibold py-3.5 rounded-xl text-sm transition active:scale-95 shadow-md shadow-primary/30"
                    >
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk ke Dashboard
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <p class="text-center text-xs text-gray-400 mt-6">
                &copy; {{ date('Y') }} Klinik Bidan — Sistem Informasi Manajemen Klinik
            </p>
        </div>
    </div>

</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eye-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fas fa-eye-slash text-sm';
        } else {
            input.type = 'password';
            icon.className = 'fas fa-eye text-sm';
        }
    }
</script>

</body>
</html>
