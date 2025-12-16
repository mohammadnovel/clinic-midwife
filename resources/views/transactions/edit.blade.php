<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('transactions.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Update Status Transaksi</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="p-6.5 border-b border-stroke dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">Invoice: {{ $transaction->code }}</h3>
                <p>Total: <b>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</b></p>
            </div>

            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="p-6.5">
                @csrf
                @method('PUT')

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Metode Pembayaran</label>
                        <select name="payment_method"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="cash" {{ $transaction->payment_method == 'cash' ? 'selected' : '' }}>Tunai /
                                Cash</option>
                            <option value="transfer" {{ $transaction->payment_method == 'transfer' ? 'selected' : '' }}>
                                Transfer Bank</option>
                            <option value="qris" {{ $transaction->payment_method == 'qris' ? 'selected' : '' }}>QRIS
                            </option>
                            <option value="bpjs" {{ $transaction->payment_method == 'bpjs' ? 'selected' : '' }}>BPJS
                            </option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Status Pembayaran</label>
                        <select name="payment_status"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="unpaid" {{ $transaction->payment_status == 'unpaid' ? 'selected' : '' }}>Belum
                                Lunas (Unpaid)</option>
                            <option value="paid" {{ $transaction->payment_status == 'paid' ? 'selected' : '' }}>Lunas
                                (Paid)</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-gray-100 rounded">
                    <h4 class="font-bold text-sm mb-2">Detail Item:</h4>
                    <ul class="list-disc pl-5 text-sm">
                        @foreach(\Illuminate\Support\Facades\DB::table('transaction_details')->where('transaction_id', $transaction->id)->get() as $item)
                            <li>{{ $item->item_name }} ({{ $item->quantity }}) - Rp
                                {{ number_format($item->subtotal, 0, ',', '.') }}</li>
                        @endforeach
                    </ul>
                </div>
                <br>
                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Simpan
                    Perubahan</button>
            </form>
        </div>
    </div>
</x-admin-layout>