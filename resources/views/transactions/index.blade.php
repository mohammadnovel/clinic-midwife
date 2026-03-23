<x-admin-layout>
    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white">
                <i class="fas fa-wallet mr-2 text-primary"></i>Transaksi & Pembayaran
            </h2>
            <p class="text-sm text-gray-500 mt-1">Daftar seluruh transaksi klinik.</p>
        </div>
        <a href="{{ route('transactions.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white hover:bg-opacity-90 transition shadow-sm">
            <i class="fas fa-plus"></i> Buat Transaksi
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 flex items-center gap-3 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700 dark:bg-green-900/20 dark:border-green-800 dark:text-green-400">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    {{-- Stats Row --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        @php
            $total      = $transactions->total();
            $paid       = $transactions->getCollection()->where('payment_status','paid')->count();
            $unpaid     = $transactions->getCollection()->where('payment_status','unpaid')->count();
            $revenue    = $transactions->getCollection()->where('payment_status','paid')->sum('total_amount');
        @endphp
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark">
            <p class="text-xs text-gray-500">Total Transaksi</p>
            <p class="text-2xl font-bold text-black dark:text-white mt-1">{{ $transactions->total() }}</p>
        </div>
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark">
            <p class="text-xs text-gray-500">Lunas</p>
            <p class="text-2xl font-bold text-green-600 mt-1">{{ $paid }}</p>
        </div>
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark">
            <p class="text-xs text-gray-500">Belum Lunas</p>
            <p class="text-2xl font-bold text-orange-500 mt-1">{{ $unpaid }}</p>
        </div>
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark">
            <p class="text-xs text-gray-500">Pendapatan (halaman ini)</p>
            <p class="text-lg font-bold text-primary mt-1">Rp {{ number_format($revenue, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Table --}}
    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark overflow-hidden">
        <div class="overflow-x-auto">
            <table id="dataTable" class="w-full text-sm">
                <thead>
                    <tr class="border-b border-stroke dark:border-strokedark bg-gray-50 dark:bg-gray-800/50">
                        <th class="py-3.5 px-5 text-left font-semibold text-gray-600 dark:text-gray-300">Kode Invoice</th>
                        <th class="py-3.5 px-5 text-left font-semibold text-gray-600 dark:text-gray-300">Tanggal</th>
                        <th class="py-3.5 px-5 text-left font-semibold text-gray-600 dark:text-gray-300">Pasien</th>
                        <th class="py-3.5 px-5 text-right font-semibold text-gray-600 dark:text-gray-300">Total</th>
                        <th class="py-3.5 px-5 text-center font-semibold text-gray-600 dark:text-gray-300">Metode</th>
                        <th class="py-3.5 px-5 text-center font-semibold text-gray-600 dark:text-gray-300">Status</th>
                        <th class="py-3.5 px-5 text-center font-semibold text-gray-600 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stroke dark:divide-strokedark">
                    @forelse($transactions as $trx)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition">
                        <td class="py-4 px-5">
                            <span class="font-mono text-xs font-semibold text-primary bg-primary/10 px-2 py-1 rounded">{{ $trx->code }}</span>
                        </td>
                        <td class="py-4 px-5 text-gray-600 dark:text-gray-300">
                            {{ $trx->created_at->format('d M Y') }}
                        </td>
                        <td class="py-4 px-5">
                            <p class="font-medium text-black dark:text-white">{{ $trx->patient->name }}</p>
                            <p class="text-xs text-gray-400">{{ $trx->patient->nik }}</p>
                        </td>
                        <td class="py-4 px-5 text-right font-bold text-black dark:text-white">
                            Rp {{ number_format($trx->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="py-4 px-5 text-center">
                            <span class="rounded-full px-2 py-1 text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                {{ strtoupper($trx->payment_method ?? '-') }}
                            </span>
                        </td>
                        <td class="py-4 px-5 text-center">
                            <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold
                                {{ $trx->payment_status == 'paid' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-orange-100 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400' }}">
                                <span class="mr-1">{{ $trx->payment_status == 'paid' ? '●' : '○' }}</span>
                                {{ $trx->payment_status == 'paid' ? 'Lunas' : 'Belum Lunas' }}
                            </span>
                        </td>
                        <td class="py-4 px-5">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('transactions.show', $trx) }}"
                                    class="rounded-lg p-2 text-blue-500 hover:bg-blue-50 transition" title="Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                <a href="{{ route('transactions.edit', $trx) }}"
                                    class="rounded-lg p-2 text-primary hover:bg-primary/10 transition" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <form action="{{ route('transactions.destroy', $trx) }}" method="POST"
                                    onsubmit="return confirm('Hapus transaksi {{ $trx->code }}?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="rounded-lg p-2 text-red-400 hover:bg-red-50 transition" title="Hapus">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-16 text-center text-gray-400">
                            <i class="fas fa-receipt text-4xl opacity-20 mb-3 block"></i>
                            Belum ada transaksi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $transactions->links() }}
    </div>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({ paging: false, info: false, searching: true, language: { search: "Cari:", zeroRecords: "Tidak ditemukan" } });
        });
    </script>
</x-admin-layout>
