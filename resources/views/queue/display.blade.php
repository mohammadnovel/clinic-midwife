<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="30">
    <title>Antrian Klinik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-900 text-white h-screen flex flex-col overflow-hidden">

    <!-- Header -->
    <header class="bg-pink-600 p-6 flex justify-between items-center shadow-lg z-10">
        <div class="flex items-center space-x-4">
            <div class="bg-white p-2 rounded-full">
                <!-- Icon Placeholder -->
                <svg class="w-10 h-10 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-black tracking-wider uppercase">Klinik Bidan Sejahtera</h1>
                <p class="text-pink-100 text-lg">Melayani Sepenuh Hati</p>
            </div>
        </div>
        <div class="text-right">
            <div id="clock" class="text-4xl font-bold">00:00</div>
            <div id="date" class="text-lg text-pink-200">Senin, 1 Jan 2025</div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="flex-1 flex p-6 gap-6">

        <!-- Left: Current Call -->
        <div class="w-2/3 flex flex-col gap-6">
            <div
                class="flex-1 bg-white text-gray-900 rounded-3xl shadow-2xl flex flex-col items-center justify-center p-10 border-8 border-pink-500 relative overflow-hidden">
                <div
                    class="absolute top-0 left-0 w-full bg-pink-500 text-white text-center py-4 text-3xl font-bold uppercase">
                    Sedang Diperiksa</div>

                @if($current)
                    <div class="text-9xl font-black text-gray-800 mb-8">{{ $current->queue_number }}</div>
                    <div class="text-5xl font-bold text-pink-600 mb-4">{{ $current->patient->name }}</div>
                    <div class="text-3xl text-gray-500 bg-gray-100 px-6 py-2 rounded-full">Poli
                        {{ $current->service_category ?? 'Umum' }}</div>
                @else
                    <div class="text-gray-400 text-4xl">Belum ada panggilan</div>
                @endif
            </div>

            <!-- Footer Running Text -->
            <div class="bg-gray-800 rounded-xl p-4 overflow-hidden whitespace-nowrap">
                <div class="inline-block animate-marquee text-2xl font-medium text-yellow-400">
                    Selamat Datang di Klinik Bidan Sejahtera. Mohon menunggu panggilan sesuai nomor antrian. Jagalah
                    kebersihan dan kenyamanan bersama.
                </div>
            </div>
        </div>

        <!-- Right: List -->
        <div class="w-1/3 bg-gray-800 rounded-3xl p-6 shadow-xl flex flex-col">
            <h2 class="text-2xl font-bold mb-6 border-b border-gray-700 pb-4 text-pink-400">Antrian Berikutnya</h2>

            <div class="flex-1 overflow-y-auto space-y-4">
                @forelse($appointments->where('status', 'pending')->take(5) as $appt)
                    <div class="bg-gray-700 p-6 rounded-2xl flex justify-between items-center border-l-8 border-pink-400">
                        <div>
                            <div class="text-3xl font-bold text-white">{{ $appt->queue_number }}</div>
                            <div class="text-gray-300 text-lg">{{ $appt->patient->name }}</div>
                        </div>
                        <div class="text-right">
                            <span class="bg-gray-600 text-xs px-2 py-1 rounded text-gray-300">Menunggu</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-10">Tidak ada antrian</div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function updateTime() {
            const now = new Date();
            document.getElementById('clock').innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            document.getElementById('date').innerText = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
</body>

</html>