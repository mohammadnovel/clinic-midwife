<x-admin-layout>
<div class="mx-auto max-w-3xl">

    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white">
                <i class="fas fa-file-invoice mr-2 text-primary"></i>Detail Invoice
            </h2>
            <p class="font-mono text-sm text-gray-500 mt-1">{{ $transaction->code }}</p>
        </div>
        <div class="flex gap-2">
            <button onclick="window.print()"
                class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white hover:bg-opacity-90 transition">
                <i class="fas fa-print"></i> Cetak
            </button>
            <a href="{{ route('transactions.edit', $transaction) }}"
                class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('transactions.index') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    {{-- Invoice Card --}}
    <div id="invoice-print" class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">

        {{-- Invoice Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-stroke px-8 py-6 dark:border-strokedark">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-heartbeat text-primary text-xl"></i>
                    <span class="text-xl font-bold text-black dark:text-white">Klinik Bidan</span>
                </div>
                <p class="text-sm text-gray-500">Jl. Kesehatan No. 1, Indonesia</p>
                <p class="text-sm text-gray-500">Telp: (021) 000-0000</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-400 uppercase tracking-wider">Invoice</p>
                <p class="font-mono text-2xl font-bold text-primary">{{ $transaction->code }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $transaction->created_at->format('d F Y') }}</p>
                <span class="mt-2 inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                    {{ $transaction->payment_status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-600' }}">
                    {{ $transaction->payment_status == 'paid' ? '✅ LUNAS' : '⏳ BELUM LUNAS' }}
                </span>
            </div>
        </div>

        {{-- Patient Info --}}
        <div class="grid grid-cols-2 gap-6 px-8 py-5 border-b border-stroke dark:border-strokedark bg-gray-50 dark:bg-gray-800/30">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Tagihan Kepada</p>
                <p class="font-semibold text-black dark:text-white">{{ $transaction->patient->name }}</p>
                <p class="text-sm text-gray-500">NIK: {{ $transaction->patient->nik }}</p>
                @if($transaction->patient->phone)
                <p class="text-sm text-gray-500">{{ $transaction->patient->phone }}</p>
                @endif
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Metode Pembayaran</p>
                <p class="font-semibold text-black dark:text-white uppercase">{{ $transaction->payment_method ?? '-' }}</p>
                <p class="text-xs text-gray-400 mt-2">Tgl Cetak: {{ now()->format('d M Y H:i') }}</p>
            </div>
        </div>

        {{-- Items Table --}}
        <div class="px-8 py-6">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b-2 border-stroke dark:border-strokedark">
                        <th class="pb-3 text-left font-semibold text-gray-600">No</th>
                        <th class="pb-3 text-left font-semibold text-gray-600">Deskripsi Layanan</th>
                        <th class="pb-3 text-center font-semibold text-gray-600">Qty</th>
                        <th class="pb-3 text-right font-semibold text-gray-600">Harga</th>
                        <th class="pb-3 text-right font-semibold text-gray-600">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($details as $i => $item)
                    <tr>
                        <td class="py-3 text-gray-400">{{ $i + 1 }}</td>
                        <td class="py-3">
                            <p class="font-medium text-black dark:text-white">{{ $item->item_name }}</p>
                            <p class="text-xs text-gray-400">{{ ucfirst($item->item_type) }}</p>
                        </td>
                        <td class="py-3 text-center text-gray-600">{{ $item->quantity }}</td>
                        <td class="py-3 text-right text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="py-3 text-right font-medium text-black dark:text-white">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-stroke dark:border-strokedark">
                        <td colspan="4" class="pt-4 text-right font-bold text-black dark:text-white pr-4">Total Tagihan</td>
                        <td class="pt-4 text-right text-2xl font-bold text-primary">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                    </tr>
                    @if($transaction->paid_amount > 0)
                    <tr>
                        <td colspan="4" class="pt-1 text-right text-sm text-gray-500 pr-4">Terbayar</td>
                        <td class="pt-1 text-right text-sm font-medium text-green-600">Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                </tfoot>
            </table>
        </div>

        {{-- Footer --}}
        <div class="border-t border-stroke px-8 py-5 dark:border-strokedark text-center">
            <p class="text-sm text-gray-400">Terima kasih telah mempercayakan kesehatan Anda kepada kami.</p>
            <p class="text-xs text-gray-300 mt-1">Dokumen ini dicetak secara otomatis oleh sistem.</p>
        </div>
    </div>
</div>

<style>
@media print {
    body * { visibility: hidden; }
    #invoice-print, #invoice-print * { visibility: visible; }
    #invoice-print { position: fixed; top: 0; left: 0; width: 100%; }
    .no-print { display: none !important; }
}
</style>
</x-admin-layout>
