<x-admin-layout>
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-edit mr-2 text-primary"></i>Edit Data Vaksinasi</h2>
        </div>
        <a href="{{ route('immunizations.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-green-100 text-green-600"><i class="fas fa-syringe text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Data Imunisasi</h3>
        </div>
        <form action="{{ route('immunizations.update', $immunization->id) }}" method="POST" class="p-6 space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Pasien</label>
                <select name="patient_id" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    @foreach($patients as $p)
                    <option value="{{ $p->id }}" {{ old('patient_id', $immunization->patient_id) == $p->id ? 'selected' : '' }}>{{ $p->name }} &mdash; {{ $p->nik }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Jenis Vaksin</label>
                <select name="immunization_type_id" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    @foreach($types as $t)
                    <option value="{{ $t->id }}" {{ old('immunization_type_id', $immunization->immunization_type_id) == $t->id ? 'selected' : '' }}>
                        {{ $t->name }} &mdash; {{ $t->recommended_age_months }} bulan
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Tanggal Vaksinasi</label>
                    <input type="date" name="date_given" value="{{ old('date_given', $immunization->date_given) }}"
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Nomor Batch Vaksin</label>
                    <input type="text" name="batch_number" value="{{ old('batch_number', $immunization->batch_number) }}"
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Catatan / Reaksi</label>
                <textarea name="notes" rows="3" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('notes', $immunization->notes) }}</textarea>
            </div>

            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
</x-admin-layout>
