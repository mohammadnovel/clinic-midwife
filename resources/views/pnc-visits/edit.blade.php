<x-admin-layout>
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-edit mr-2 text-primary"></i>Edit Kunjungan Nifas</h2>
        </div>
        <a href="{{ route('pnc-visits.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-purple-100 text-purple-500"><i class="fas fa-notes-medical text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Kunjungan Nifas</h3>
        </div>
        <form action="{{ route('pnc-visits.update', $pncVisit->id) }}" method="POST" class="p-6 space-y-4">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Jenis Kunjungan</label>
                    <select name="visit_code" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                        @foreach(['KF1' => 'KF1 — 6 jam s/d 2 hari', 'KF2' => 'KF2 — 3–7 hari', 'KF3' => 'KF3 — 8–28 hari', 'KF4' => 'KF4 — 29–42 hari'] as $val => $label)
                        <option value="{{ $val }}" {{ old('visit_code', $pncVisit->visit_code) == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Tanggal Kunjungan</label>
                    <input type="date" name="appointment_date" value="{{ old('appointment_date', $pncVisit->appointment_date) }}"
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Tekanan Darah</label>
                    <input type="text" name="blood_pressure" value="{{ old('blood_pressure', $pncVisit->blood_pressure) }}"
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Kondisi Lokia</label>
                    <input type="text" name="lochia_condition" value="{{ old('lochia_condition', $pncVisit->lochia_condition) }}"
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">TFU</label>
                    <input type="text" name="uterine_involution" value="{{ old('uterine_involution', $pncVisit->uterine_involution) }}"
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
            </div>

            <div>
                <label class="mb-3 block text-sm font-medium text-black dark:text-white">Status Menyusui</label>
                <div class="flex gap-3">
                    <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-stroke p-3 text-sm flex-1 has-[:checked]:border-green-500 has-[:checked]:bg-green-50 dark:border-strokedark dark:has-[:checked]:bg-green-900/20">
                        <input type="radio" name="breastfeeding_status" value="1" {{ old('breastfeeding_status', $pncVisit->breastfeeding_status) == 1 ? 'checked' : '' }} class="accent-green-500" />
                        <span class="font-medium">✅ Menyusui Lancar</span>
                    </label>
                    <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-stroke p-3 text-sm flex-1 has-[:checked]:border-orange-400 has-[:checked]:bg-orange-50 dark:border-strokedark dark:has-[:checked]:bg-orange-900/20">
                        <input type="radio" name="breastfeeding_status" value="0" {{ old('breastfeeding_status', $pncVisit->breastfeeding_status) == 0 ? 'checked' : '' }} class="accent-orange-400" />
                        <span class="font-medium">⚠️ Bermasalah</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Catatan Tambahan</label>
                <textarea name="notes" rows="3" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('notes', $pncVisit->notes) }}</textarea>
            </div>

            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
</x-admin-layout>
