<x-admin-layout>
<div x-data="transactionForm(@json($services->values()))" class="mx-auto max-w-5xl">

    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white">
                <i class="fas fa-file-invoice-dollar mr-2 text-primary"></i>Buat Transaksi Baru
            </h2>
            <p class="text-sm text-gray-500 mt-1">Tambahkan layanan dan informasi pembayaran pasien.</p>
        </div>
        <a href="{{ route('transactions.index') }}"
            class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 dark:bg-red-900/20 dark:border-red-800">
        <ul class="list-disc pl-5 text-sm text-red-600 dark:text-red-400">
            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST" @submit="prepareSubmit">
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- LEFT: Patient + Services --}}
            <div class="xl:col-span-2 space-y-6">

                {{-- Patient Card --}}
                <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                    <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary">
                            <i class="fas fa-user-injured text-sm"></i>
                        </div>
                        <h3 class="font-semibold text-black dark:text-white">Data Pasien</h3>
                    </div>
                    <div class="p-6">
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">
                            Pilih Pasien <span class="text-red-500">*</span>
                        </label>

                        {{-- Search input --}}
                        <div class="relative mb-2">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fas fa-search text-sm"></i>
                            </span>
                            <input type="text" x-model="patientSearch"
                                placeholder="Cari nama atau NIK pasien..."
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-10 pr-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        </div>

                        <select name="patient_id" x-model="selectedPatientId" required
                            class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="">-- Pilih Pasien --</option>
                            @foreach($patients as $p)
                            <option value="{{ $p->id }}"
                                x-show="!patientSearch || '{{ strtolower($p->name) }}'.includes(patientSearch.toLowerCase()) || '{{ $p->nik }}'.includes(patientSearch)">
                                {{ $p->name }} &mdash; NIK {{ $p->nik }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Services Card --}}
                <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                    <div class="flex items-center justify-between border-b border-stroke px-6 py-4 dark:border-strokedark">
                        <div class="flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-hand-holding-medical text-sm"></i>
                            </div>
                            <h3 class="font-semibold text-black dark:text-white">Layanan yang Diberikan</h3>
                        </div>
                        <button type="button" @click="addRow()"
                            class="inline-flex items-center gap-1.5 rounded-lg bg-primary px-3 py-2 text-xs font-medium text-white hover:bg-opacity-90 transition">
                            <i class="fas fa-plus"></i> Tambah Layanan
                        </button>
                    </div>

                    <div class="p-6">
                        {{-- Table Header --}}
                        <div class="hidden sm:grid grid-cols-12 gap-2 mb-3 text-xs font-semibold uppercase text-gray-500 px-1">
                            <div class="col-span-5">Layanan / Tindakan</div>
                            <div class="col-span-2 text-center">Qty</div>
                            <div class="col-span-3 text-right">Harga Satuan</div>
                            <div class="col-span-2 text-right">Aksi</div>
                        </div>

                        {{-- Dynamic Rows --}}
                        <div class="space-y-3">
                            <template x-for="(row, index) in rows" :key="index">
                                <div class="grid grid-cols-12 gap-2 items-start rounded-lg border border-gray-100 dark:border-gray-700 p-3 bg-gray-50 dark:bg-gray-800/50">
                                    {{-- Service Select --}}
                                    <div class="col-span-12 sm:col-span-5">
                                        <label class="sm:hidden text-xs text-gray-500 mb-1 block">Layanan</label>
                                        <select
                                            :name="`items[${index}][service_id]`"
                                            x-model="row.service_id"
                                            @change="onServiceChange(index)"
                                            required
                                            class="w-full rounded-lg border border-stroke bg-white py-2.5 px-3 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                            <option value="">-- Pilih Layanan --</option>
                                            <template x-for="svc in services" :key="svc.id">
                                                <option :value="svc.id" x-text="svc.name"></option>
                                            </template>
                                        </select>
                                    </div>

                                    {{-- Qty --}}
                                    <div class="col-span-4 sm:col-span-2">
                                        <label class="sm:hidden text-xs text-gray-500 mb-1 block">Qty</label>
                                        <input type="number"
                                            :name="`items[${index}][qty]`"
                                            x-model.number="row.qty"
                                            @input="row.qty = Math.max(1, row.qty)"
                                            min="1"
                                            class="w-full rounded-lg border border-stroke bg-white py-2.5 px-3 text-sm text-center outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                    </div>

                                    {{-- Price display --}}
                                    <div class="col-span-5 sm:col-span-3 flex items-center justify-end">
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500 sm:hidden">Subtotal</p>
                                            <p class="font-semibold text-sm text-black dark:text-white" x-text="formatCurrency(rowSubtotal(row))"></p>
                                            <p class="text-xs text-gray-400" x-show="row.qty > 1" x-text="`@ ${formatCurrency(row.price)}`"></p>
                                        </div>
                                    </div>

                                    {{-- Remove --}}
                                    <div class="col-span-3 sm:col-span-2 flex justify-end">
                                        <button type="button" @click="removeRow(index)"
                                            :disabled="rows.length === 1"
                                            class="rounded-lg p-2 text-red-400 hover:bg-red-50 hover:text-red-600 transition disabled:opacity-30 disabled:cursor-not-allowed">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>

                        {{-- Empty state --}}
                        <div x-show="rows.length === 0" class="py-8 text-center text-gray-400">
                            <i class="fas fa-hand-holding-medical text-3xl mb-2 opacity-30"></i>
                            <p class="text-sm">Belum ada layanan. Klik "Tambah Layanan".</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Payment + Summary --}}
            <div class="xl:col-span-1 space-y-6">

                {{-- Order Summary --}}
                <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                    <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                            <i class="fas fa-receipt text-sm"></i>
                        </div>
                        <h3 class="font-semibold text-black dark:text-white">Ringkasan</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-2 text-sm mb-4">
                            <template x-for="row in rows.filter(r => r.service_id)" :key="row.service_id + row.qty">
                                <div class="flex justify-between text-gray-600 dark:text-gray-300">
                                    <span x-text="(row.name || 'Layanan') + (row.qty > 1 ? ` x${row.qty}` : '')"></span>
                                    <span x-text="formatCurrency(rowSubtotal(row))"></span>
                                </div>
                            </template>
                            <div x-show="rows.filter(r => r.service_id).length === 0" class="text-center text-gray-400 py-2">
                                Belum ada item dipilih
                            </div>
                        </div>
                        <div class="border-t border-stroke pt-3 dark:border-strokedark">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-black dark:text-white">Total</span>
                                <span class="text-xl font-bold text-primary" x-text="formatCurrency(total)"></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Payment Card --}}
                <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                    <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fas fa-credit-card text-sm"></i>
                        </div>
                        <h3 class="font-semibold text-black dark:text-white">Pembayaran</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">
                                Metode Pembayaran
                            </label>
                            <select name="payment_method"
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                <option value="cash">💵 Tunai / Cash</option>
                                <option value="transfer">🏦 Transfer Bank</option>
                                <option value="qris">📱 QRIS</option>
                                <option value="bpjs">🏥 BPJS Kesehatan</option>
                            </select>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">
                                Status Pembayaran
                            </label>
                            <div class="grid grid-cols-2 gap-2">
                                <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-stroke p-3 text-sm transition hover:border-primary has-[:checked]:border-primary has-[:checked]:bg-primary/5 dark:border-strokedark">
                                    <input type="radio" name="payment_status" value="paid" class="accent-primary" />
                                    <span class="font-medium">✅ Lunas</span>
                                </label>
                                <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-stroke p-3 text-sm transition hover:border-primary has-[:checked]:border-primary has-[:checked]:bg-primary/5 dark:border-strokedark">
                                    <input type="radio" name="payment_status" value="unpaid" checked class="accent-primary" />
                                    <span class="font-medium">⏳ Belum</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                            <i class="fas fa-save"></i> Simpan Transaksi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function transactionForm(services) {
    return {
        services: services,
        rows: [{ service_id: '', qty: 1, price: 0, name: '' }],
        patientSearch: '',
        selectedPatientId: '',

        addRow() {
            this.rows.push({ service_id: '', qty: 1, price: 0, name: '' });
        },

        removeRow(index) {
            if (this.rows.length > 1) this.rows.splice(index, 1);
        },

        onServiceChange(index) {
            const svc = this.services.find(s => s.id === this.rows[index].service_id);
            if (svc) {
                this.rows[index].price = parseFloat(svc.price);
                this.rows[index].name  = svc.name;
            } else {
                this.rows[index].price = 0;
                this.rows[index].name  = '';
            }
        },

        rowSubtotal(row) {
            return (parseFloat(row.price) || 0) * (parseInt(row.qty) || 0);
        },

        get total() {
            return this.rows.reduce((sum, r) => sum + this.rowSubtotal(r), 0);
        },

        formatCurrency(val) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(val);
        },

        prepareSubmit() {
            // nothing needed — native form inputs already carry the right names
        }
    }
}
</script>
</x-admin-layout>
