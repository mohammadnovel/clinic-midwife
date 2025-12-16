<x-admin-layout>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
        <!-- Card Item 1: Total Patients -->
        <div
            class="relative overflow-hidden rounded-lg border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="bg-gradient-to-r from-cyan-500 to-blue-500 p-6">
                <div class="flex items-center justify-between">
                    <span
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-white/20 text-white backdrop-blur-sm">
                        <i class="fas fa-users text-xl"></i>
                    </span>
                    <span class="text-sm font-medium text-white/80">Total Pasien</span>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <h4 class="text-3xl font-bold text-white">
                        {{ $stats['patients'] }}
                    </h4>
                </div>
            </div>
        </div>

        <!-- Card Item 2: Visits Today -->
        <div
            class="relative overflow-hidden rounded-lg border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 p-6">
                <div class="flex items-center justify-between">
                    <span
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-white/20 text-white backdrop-blur-sm">
                        <i class="fas fa-calendar-day text-xl"></i>
                    </span>
                    <span class="text-sm font-medium text-white/80">Kunjungan Hari Ini</span>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <h4 class="text-3xl font-bold text-white">
                        {{ $stats['visits_today'] }}
                    </h4>
                </div>
            </div>
        </div>

        <!-- Card Item 3: Pending Queue -->
        <div
            class="relative overflow-hidden rounded-lg border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="bg-gradient-to-r from-orange-400 to-amber-500 p-6">
                <div class="flex items-center justify-between">
                    <span
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-white/20 text-white backdrop-blur-sm">
                        <i class="fas fa-clock text-xl"></i>
                    </span>
                    <span class="text-sm font-medium text-white/80">Antrian Menunggu</span>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <h4 class="text-3xl font-bold text-white">
                        {{ $stats['pending_queue'] ?? 0 }}
                    </h4>
                </div>
            </div>
        </div>

        <!-- Card Item 4: Revenue -->
        <div
            class="relative overflow-hidden rounded-lg border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="bg-gradient-to-r from-rose-500 to-pink-500 p-6">
                <div class="flex items-center justify-between">
                    <span
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-white/20 text-white backdrop-blur-sm">
                        <i class="fas fa-wallet text-xl"></i>
                    </span>
                    <span class="text-sm font-medium text-white/80">Pendapatan Hari Ini</span>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <h4 class="text-2xl font-bold text-white">
                        Rp {{ number_format(0, 0, ',', '.') }} <!-- Placeholder -->
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts / Recent Section -->
    <div class="mt-4 grid grid-cols-12 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5">
        <div
            class="col-span-12 xl:col-span-8 rounded-lg border border-stroke bg-white px-5 pt-7.5 pb-5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5">
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-xl font-bold text-black dark:text-white">Aktivitas Terkini</h4>
                <button class="text-sm text-primary hover:underline">Lihat Semua</button>
            </div>

            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Pasien</th>
                                <th scope="col" class="px-6 py-3">Layanan</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Mock Data for Display -->
                            <tr
                                class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Ibu Siti Aminah</td>
                                <td class="px-6 py-4">Pemeriksaan Kehamilan (ANC)</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                                        Selesai
                                    </span>
                                </td>
                                <td class="px-6 py-4">09:30</td>
                            </tr>
                            <tr
                                class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Bayi Ny. Rina</td>
                                <td class="px-6 py-4">Imunisasi BCG</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">
                                        Menunggu
                                    </span>
                                </td>
                                <td class="px-6 py-4">10:15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Side Widget (Queue/Calendar) -->
        <div class="col-span-12 xl:col-span-4">
            <div
                class="rounded-lg border border-stroke bg-white p-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <h4 class="mb-5 text-xl font-bold text-black dark:text-white">Jadwal Praktek</h4>
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4 dark:bg-meta-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h5 class="font-medium text-black dark:text-white">Pagi</h5>
                            <p class="text-sm">08:00 - 12:00</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4 dark:bg-meta-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                            <i class="fas fa-moon"></i>
                        </div>
                        <div>
                            <h5 class="font-medium text-black dark:text-white">Sore</h5>
                            <p class="text-sm">16:00 - 20:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>