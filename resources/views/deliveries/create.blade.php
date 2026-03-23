<x-admin-layout>
<div class="mx-auto max-w-3xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-hospital-user mr-2 text-primary"></i>Form Persalinan Baru</h2>
            <p class="text-sm text-gray-500 mt-1">Catat data persalinan ibu secara lengkap.</p>
        </div>
        <a href="{{ route('deliveries.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 dark:bg-red-900/20"><ul class="list-disc pl-5 text-sm text-red-600">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ route('deliveries.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Identitas --}}
            <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-pink-100 text-pink-500"><i class="fas fa-user text-sm"></i></div>
                    <h3 class="font-semibold text-black dark:text-white">Data Ibu</h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">Pilih Kehamilan (Aktif) <span class="text-red-500">*</span></label>
                        <select name="pregnancy_id" required class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="">-- Pilih Ibu Hamil --</option>
                            @foreach($pregnancies as $p)
                            <option value="{{ $p->id }}" {{ old('pregnancy_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->patient->name }} &mdash; HPL: {{ $p->hpl ? $p->hpl->format('d M Y') : '-' }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">Waktu Lahir <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="delivery_time" value="{{ old('delivery_time', date('Y-m-d\TH:i')) }}" required
                            class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">Metode Persalinan</label>
                            <select name="method" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                @foreach(['Normal' => 'Normal (Spontan)', 'Vacuum' => 'Vacuum', 'Sectio Caesar' => 'Sectio Caesar', 'Induksi' => 'Induksi'] as $val => $label)
                                <option value="{{ $val }}" {{ old('method') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">Kondisi Lahir</label>
                            <select name="birth_condition" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                @foreach(['Healthy' => 'Sehat / Hidup', 'Asphyxia' => 'Asfiksia (Sesak)', 'Stillbirth' => 'Lahir Mati (IUFD)'] as $val => $label)
                                <option value="{{ $val }}" {{ old('birth_condition') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail Persalinan --}}
            <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-red-100 text-red-500"><i class="fas fa-procedures text-sm"></i></div>
                    <h3 class="font-semibold text-black dark:text-white">Detail Persalinan</h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">Lama Persalinan (menit) &mdash; Kala I / II / III</label>
                        <div class="grid grid-cols-3 gap-2">
                            <input type="number" name="duration_first_stage" value="{{ old('duration_first_stage') }}" placeholder="Kala I"
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-3 text-sm text-center outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            <input type="number" name="duration_second_stage" value="{{ old('duration_second_stage') }}" placeholder="Kala II"
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-3 text-sm text-center outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            <input type="number" name="duration_third_stage" value="{{ old('duration_third_stage') }}" placeholder="Kala III"
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-3 text-sm text-center outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        </div>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">Perdarahan (ml)</label>
                        <input type="number" name="blood_loss_ml" value="{{ old('blood_loss_ml') }}" placeholder="Contoh: 200"
                            class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">Kondisi Perineum / Plasenta</label>
                        <textarea name="perineum_condition" rows="2" placeholder="Utuh / Robekan Derajat 1/2/3..."
                            class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('perineum_condition') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">Komplikasi / Catatan</label>
                        <textarea name="complications" rows="2" placeholder="Komplikasi yang terjadi..."
                            class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('complications') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Info & Submit --}}
            <div class="lg:col-span-2">
                <div class="mb-4 flex items-start gap-3 rounded-xl border border-blue-200 bg-blue-50 p-4 dark:bg-blue-900/20 dark:border-blue-800">
                    <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                    <p class="text-sm text-blue-700 dark:text-blue-300">Setelah menyimpan data persalinan, Anda akan diarahkan untuk mengisi data <strong>Bayi</strong>.</p>
                </div>
                <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                    <i class="fas fa-save"></i> Simpan Data Persalinan
                </button>
            </div>
        </div>
    </form>
</div>
</x-admin-layout>
