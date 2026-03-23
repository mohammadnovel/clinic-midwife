<x-admin-layout>
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-edit mr-2 text-primary"></i>Edit Data KB</h2>
        </div>
        <a href="{{ route('family-plannings.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary"><i class="fas fa-venus-mars text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Data KB</h3>
        </div>
        <form action="{{ route('family-plannings.update', $familyPlanning->id) }}" method="POST" class="p-6 space-y-4">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Metode Kontrasepsi</label>
                    <select name="method" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                        @foreach(['Suntik 1 Bulan','Suntik 3 Bulan','Pil KB','IUD / Spiral','Implan / Susuk','Kondom'] as $m)
                        <option value="{{ $m }}" {{ old('method', $familyPlanning->method) == $m ? 'selected' : '' }}>{{ $m }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Tanggal Kunjungan</label>
                    <input type="date" name="visit_date" value="{{ old('visit_date', $familyPlanning->installation_date ?? $familyPlanning->created_at->format('Y-m-d')) }}"
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Berat Badan (Kg)</label>
                    <input type="text" name="weight" value="{{ old('weight', $familyPlanning->weight) }}"
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Tekanan Darah</label>
                    <input type="text" name="blood_pressure" value="{{ old('blood_pressure', $familyPlanning->blood_pressure) }}"
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Efek Samping / Keluhan</label>
                <textarea name="side_effects" rows="3" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('side_effects', $familyPlanning->side_effects) }}</textarea>
            </div>

            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
</x-admin-layout>
