<x-admin-layout>
<div class="mx-auto max-w-4xl">

    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white">
                <i class="fas fa-edit mr-2 text-primary"></i>Update Transaksi
            </h2>
            <p class="text-sm text-gray-500 mt-1 font-mono">{{ $transaction->code }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('transactions.show', $transaction) }}"
                class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
                <i class="fas fa-eye"></i> Lihat Invoice
            </a>
            <a href="{{ route('transactions.index') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4 flex items-center gap-3 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700 dark:bg-green-900/20 dark:border-green-800 dark:text-green-400">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Detail Items --}}
        <div class="lg:col-span-2">
            <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-list text-sm"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-black dark:text-white">Detail Layanan</h3>
                        <p class="text-xs text-gray-500">Pasien: <span class="font-medium text-black dark:text-white">{{ $transaction->patient->name }}</span></p>
                    </div>
                </div>
                <div class="p-6">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-stroke dark:border-strokedark">
                                <th class="pb-3 text-left font-medium text-gray-500">Nama Item</th>
                                <th class="pb-3 text-center font-medium text-gray-500">Qty</th>
                                <th class="pb-3 text-right font-medium text-gray-500">Harga</th>
                                <th class="pb-3 text-right font-medium text-gray-500">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stroke dark:divide-strokedark">
                            @foreach($transaction->details as $item)
                            <tr>
                                <td class="py-3">
                                    <div class="font-medium text-black dark:text-white">{{ $item->item_name }}</div>
                                    <div class="text-xs text-gray-400">{{ ucfirst($item->item_type) }}</div>
                                </td>
                                <td class="py-3 text-center text-gray-600 dark:text-gray-300">{{ $item->quantity }}</td>
                                <td class="py-3 text-right text-gray-600 dark:text-gray-300">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="py-3 text-right font-semibold text-black dark:text-white">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-stroke dark:border-strokedark">
                                <td colspan="3" class="pt-4 text-right font-semibold text-black dark:text-white">Total Tagihan</td>
                                <td class="pt-4 text-right text-xl font-bold text-primary">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- Payment Update --}}
        <div class="lg:col-span-1">
            <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-credit-card text-sm"></i>
                    </div>
                    <h3 class="font-semibold text-black dark:text-white">Update Pembayaran</h3>
                </div>
                <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">Metode Pembayaran</label>
                        <select name="payment_method"
                            class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="cash"     {{ $transaction->payment_method == 'cash'     ? 'selected' : '' }}>💵 Tunai / Cash</option>
                            <option value="transfer" {{ $transaction->payment_method == 'transfer' ? 'selected' : '' }}>🏦 Transfer Bank</option>
                            <option value="qris"     {{ $transaction->payment_method == 'qris'     ? 'selected' : '' }}>📱 QRIS</option>
                            <option value="bpjs"     {{ $transaction->payment_method == 'bpjs'     ? 'selected' : '' }}>🏥 BPJS Kesehatan</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">Status Pembayaran</label>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-stroke p-3 text-sm transition hover:border-primary has-[:checked]:border-green-500 has-[:checked]:bg-green-50 dark:border-strokedark dark:has-[:checked]:bg-green-900/20">
                                <input type="radio" name="payment_status" value="paid"
                                    {{ $transaction->payment_status == 'paid' ? 'checked' : '' }} class="accent-green-500" />
                                <span class="font-medium">✅ Lunas</span>
                            </label>
                            <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-stroke p-3 text-sm transition hover:border-primary has-[:checked]:border-orange-400 has-[:checked]:bg-orange-50 dark:border-strokedark dark:has-[:checked]:bg-orange-900/20">
                                <input type="radio" name="payment_status" value="unpaid"
                                    {{ $transaction->payment_status == 'unpaid' ? 'checked' : '' }} class="accent-orange-400" />
                                <span class="font-medium">⏳ Belum</span>
                            </label>
                        </div>
                    </div>

                    {{-- Status badge --}}
                    <div class="rounded-lg p-3 {{ $transaction->payment_status == 'paid' ? 'bg-green-50 border border-green-200' : 'bg-orange-50 border border-orange-200' }}">
                        <p class="text-xs text-gray-500">Status saat ini</p>
                        <p class="font-semibold {{ $transaction->payment_status == 'paid' ? 'text-green-700' : 'text-orange-600' }}">
                            {{ $transaction->payment_status == 'paid' ? '✅ Sudah Lunas' : '⏳ Belum Lunas' }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <button type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</x-admin-layout>
