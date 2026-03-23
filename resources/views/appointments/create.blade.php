<x-admin-layout>
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-calendar-plus mr-2 text-primary"></i>Buat Antrian Baru</h2>
            <p class="text-sm text-gray-500 mt-1">Daftarkan pasien untuk kunjungan hari ini atau mendatang.</p>
        </div>
        <a href="{{ route('appointments.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 dark:bg-red-900/20"><ul class="list-disc pl-5 text-sm text-red-600">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary"><i class="fas fa-calendar-check text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Detail Kunjungan</h3>
        </div>
        <form action="{{ route('appointments.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Pilih Pasien <span class="text-red-500">*</span></label>
                <select name="patient_id" required class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    <option value="">-- Pilih Pasien --</option>
                    @foreach($patients as $p)
                    <option value="{{ $p->id }}" {{ old('patient_id') == $p->id ? 'selected' : '' }}>{{ $p->name }} &mdash; {{ $p->nik }}</option>
                    @endforeach
                </select>
                <p class="mt-1.5 text-xs text-gray-500">Belum terdaftar? <a href="{{ route('patients.create') }}" class="text-primary hover:underline font-medium">Daftarkan pasien baru &rarr;</a></p>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Pilih Bidan</label>
                <select name="midwife_id" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    <option value="">-- Pilih Bidan (Opsional) --</option>
                    @foreach($midwives as $m)
                    <option value="{{ $m->id }}" {{ old('midwife_id') == $m->id ? 'selected' : '' }}>{{ $m->user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Tanggal & Waktu <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="appointment_date" value="{{ old('appointment_date', now()->format('Y-m-d\TH:i')) }}" required
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Kategori Layanan</label>
                    <select name="service_category" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                        @foreach(['General' => 'Pemeriksaan Umum', 'ANC' => 'Pemeriksaan Kehamilan (ANC)', 'Delivery' => 'Persalinan', 'Immunization' => 'Imunisasi Bayi', 'KB' => 'Keluarga Berencana'] as $val => $label)
                        <option value="{{ $val }}" {{ old('service_category') == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Catatan</label>
                <textarea name="notes" rows="2" placeholder="Catatan tambahan (opsional)..."
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                <i class="fas fa-ticket-alt"></i> Simpan & Cetak Antrian
            </button>
        </form>
    </div>
</div>
</x-admin-layout>
