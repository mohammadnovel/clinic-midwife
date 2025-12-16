<x-admin-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white">Laporan Keuangan & Statistik</h2>
            <p class="text-sm text-gray-500">Analisa performa klinik Anda periode ini.</p>
        </div>

        <form method="GET" action="{{ route('reports.index') }}"
            class="flex flex-col sm:flex-row gap-2 bg-white dark:bg-boxdark p-2 rounded-lg shadow-sm border border-stroke dark:border-strokedark">
            <div class="relative">
                <input type="date" name="start_date" value="{{ $startDate }}"
                    class="w-full sm:w-auto rounded border border-stroke bg-transparent py-2 px-4 text-black outline-none transition focus:border-primary active:border-primary dark:border-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
            </div>
            <span class="hidden sm:inline-flex items-center text-gray-500">-</span>
            <div class="relative">
                <input type="date" name="end_date" value="{{ $endDate }}"
                    class="w-full sm:w-auto rounded border border-stroke bg-transparent py-2 px-4 text-black outline-none transition focus:border-primary active:border-primary dark:border-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
            </div>
            <button
                class="inline-flex items-center justify-center rounded bg-primary py-2 px-6 text-center font-medium text-white hover:bg-opacity-90">
                <i class="fas fa-filter mr-2"></i> Filter
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 mb-8">
        <!-- Card Item Income -->
        <div
            class="rounded-lg border border-stroke bg-white p-6 shadow-default dark:border-strokedark dark:bg-boxdark relative overflow-hidden group">
            <div
                class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-primary/10 transition-all group-hover:scale-150">
            </div>
            <div class="flex flex-col relative z-10">
                <span class="mb-2 text-sm font-medium text-gray-500">Pendapatan Bersih</span>
                <h4 class="text-2xl font-bold text-black dark:text-white text-primary">
                    Rp {{ number_format($income, 0, ',', '.') }}
                </h4>
            </div>
            <div class="absolute bottom-6 right-6 text-primary">
                <i class="fas fa-money-bill-wave text-3xl opacity-50"></i>
            </div>
        </div>

        <!-- Card Item Visits -->
        <div
            class="rounded-lg border border-stroke bg-white p-6 shadow-default dark:border-strokedark dark:bg-boxdark relative overflow-hidden group">
            <div
                class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-blue-500/10 transition-all group-hover:scale-150">
            </div>
            <div class="flex flex-col relative z-10">
                <span class="mb-2 text-sm font-medium text-gray-500">Total Kunjungan Pasien</span>
                <h4 class="text-2xl font-bold text-black dark:text-white text-blue-500">
                    {{ $visits }} <span class="text-sm text-gray-500 font-normal">Orang</span>
                </h4>
            </div>
            <div class="absolute bottom-6 right-6 text-blue-500">
                <i class="fas fa-users text-3xl opacity-50"></i>
            </div>
        </div>

        <!-- Card Item New Patients -->
        <div
            class="rounded-lg border border-stroke bg-white p-6 shadow-default dark:border-strokedark dark:bg-boxdark relative overflow-hidden group">
            <div
                class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-green-500/10 transition-all group-hover:scale-150">
            </div>
            <div class="flex flex-col relative z-10">
                <span class="mb-2 text-sm font-medium text-gray-500">Pasien Baru Terdaftar</span>
                <h4 class="text-2xl font-bold text-black dark:text-white text-green-500">
                    {{ $newPatients }} <span class="text-sm text-gray-500 font-normal">Orang</span>
                </h4>
            </div>
            <div class="absolute bottom-6 right-6 text-green-500">
                <i class="fas fa-user-plus text-3xl opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="w-full rounded-lg border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
            <h3 class="font-medium text-black dark:text-white text-lg">
                <i class="fas fa-chart-pie mr-2 text-primary"></i> 5 Layanan Terpopuler
            </h3>
        </div>

        <div class="flex flex-col p-4">
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-2 text-left dark:bg-meta-4">
                            <th class="py-4 px-4 font-medium text-black dark:text-white pl-8">No</th>
                            <th class="py-4 px-4 font-medium text-black dark:text-white">Nama Layanan / Obat</th>
                            <th class="py-4 px-4 font-medium text-black dark:text-white text-center">Jumlah Transaksi
                            </th>
                            <th class="py-4 px-4 font-medium text-black dark:text-white text-right pr-8">Kontribusi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topServices as $index => $svc)
                            <tr
                                class="border-b border-stroke dark:border-strokedark hover:bg-gray-50 dark:hover:bg-boxdark/50 transition">
                                <td class="py-4 px-4 pl-8">
                                    <span
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary font-bold text-sm">
                                        {{ $index + 1 }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 font-medium text-black dark:text-white">
                                    {{ $svc->item_name }}
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span
                                        class="inline-block rounded bg-success/10 py-1 px-3 text-sm font-medium text-success">
                                        {{ $svc->total }}x
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-right pr-8">
                                    <!-- Dummy progress bar for visuals -->
                                    <div class="relative h-2 w-24 rounded-full bg-stroke dark:bg-strokedark ml-auto">
                                        <div class="absolute h-full rounded-full bg-primary"
                                            style="width: {{ min(100, $svc->total * 5) }}%"></div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-inbox text-4xl mb-2 opacity-30"></i>
                                        <p>Belum ada data transaksi yang ditemukan pada periode ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>