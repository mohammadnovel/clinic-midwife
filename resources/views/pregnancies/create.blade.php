<x-admin-layout>
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-baby-carriage mr-2 text-pink-500"></i>Registrasi Kehamilan Baru</h2>
            <p class="text-sm text-gray-500 mt-1">Catat data kehamilan ibu beserta riwayatnya.</p>
        </div>
        <a href="{{ route('pregnancies.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 dark:bg-red-900/20"><ul class="list-disc pl-5 text-sm text-red-600">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-pink-100 text-pink-500"><i class="fas fa-heart text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Data Kehamilan</h3>
        </div>
        <form action="{{ route('pregnancies.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Ibu Hamil <span class="text-red-500">*</span></label>
                <select name="patient_id" required class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    <option value="">-- Pilih Pasien --</option>
                    @foreach($patients as $p)
                    <option value="{{ $p->id }}" {{ old('patient_id') == $p->id ? 'selected' : '' }}>{{ $p->name }} &mdash; NIK {{ $p->nik }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">HPHT (Hari Pertama Haid Terakhir) <span class="text-red-500">*</span></label>
                <input type="date" name="hpht" value="{{ old('hpht') }}" required
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                <p class="mt-1.5 text-xs text-gray-500"><i class="fas fa-info-circle mr-1"></i>HPL (Hari Perkiraan Lahir) dihitung otomatis +280 hari dari HPHT.</p>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Gravida <span class="text-xs text-gray-400">(Hamil ke-)</span></label>
                    <input type="number" name="gravida" value="{{ old('gravida', 1) }}" min="1" required
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm text-center outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Partus <span class="text-xs text-gray-400">(Melahirkan)</span></label>
                    <input type="number" name="partus" value="{{ old('partus', 0) }}" min="0" required
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm text-center outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Abortus <span class="text-xs text-gray-400">(Keguguran)</span></label>
                    <input type="number" name="abortus" value="{{ old('abortus', 0) }}" min="0" required
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm text-center outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Riwayat / Catatan Tambahan</label>
                <textarea name="history_notes" rows="4" placeholder="Riwayat penyakit, alergi, kondisi khusus..."
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('history_notes') }}</textarea>
            </div>

            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                <i class="fas fa-save"></i> Simpan Data Kehamilan
            </button>
        </form>
    </div>
</div>
</x-admin-layout>
