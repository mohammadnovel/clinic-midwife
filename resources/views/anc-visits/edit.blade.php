<x-admin-layout>
<div class="mx-auto max-w-3xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-edit mr-2 text-primary"></i>Edit Hasil Pemeriksaan ANC</h2>
            <p class="text-sm text-gray-500 mt-1">{{ $ancVisit->pregnancy->patient->name }} &mdash; {{ $ancVisit->created_at->format('d M Y') }}</p>
        </div>
        <a href="{{ route('anc-visits.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('anc-visits.update', $ancVisit->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-blue-600"><i class="fas fa-heartbeat text-sm"></i></div>
                    <h3 class="font-semibold text-black dark:text-white">Pemeriksaan Fisik</h3>
                </div>
                <div class="p-5 space-y-4">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">Usia Kehamilan (Minggu)</label>
                            <input type="number" name="gestational_age_weeks" value="{{ old('gestational_age_weeks', $ancVisit->gestational_age_weeks) }}"
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm text-center outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">Berat Badan (Kg)</label>
                            <input type="text" name="weight" value="{{ old('weight', $ancVisit->weight) }}"
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm text-center outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">Tensi Darah</label>
                            <input type="text" name="blood_pressure" value="{{ old('blood_pressure', $ancVisit->blood_pressure) }}" placeholder="120/80"
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">Tinggi Fundus (cm)</label>
                            <input type="text" name="fundal_height" value="{{ old('fundal_height', $ancVisit->fundal_height) }}"
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        </div>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">DJJ (Denyut Jantung Janin)</label>
                        <input type="text" name="fetal_heart_rate" value="{{ old('fetal_heart_rate', $ancVisit->fetal_heart_rate) }}"
                            class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-yellow-100 text-yellow-600"><i class="fas fa-clipboard-list text-sm"></i></div>
                    <h3 class="font-semibold text-black dark:text-white">Keluhan & Tindakan</h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">Keluhan Utama</label>
                        <textarea name="complaints" rows="4" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('complaints', $ancVisit->complaints) }}</textarea>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">Tindakan / Resep / Saran</label>
                        <textarea name="actions" rows="4" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('actions', $ancVisit->actions) }}</textarea>
                    </div>
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</x-admin-layout>
