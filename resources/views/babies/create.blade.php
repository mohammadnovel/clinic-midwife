<x-admin-layout>
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-baby mr-2 text-yellow-500"></i>Tambah Data Bayi</h2>
            <p class="text-sm text-gray-500 mt-1">Input data bayi baru lahir.</p>
        </div>
        <a href="{{ route('babies.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="mb-4 flex items-start gap-3 rounded-xl border border-yellow-200 bg-yellow-50 p-4 dark:bg-yellow-900/20 dark:border-yellow-800">
        <i class="fas fa-info-circle text-yellow-500 mt-0.5"></i>
        <p class="text-sm text-yellow-700 dark:text-yellow-300">Idealnya data bayi dibuat otomatis dari menu <strong>Persalinan</strong>. Gunakan form ini hanya untuk input data manual.</p>
    </div>

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 dark:bg-red-900/20"><ul class="list-disc pl-5 text-sm text-red-600">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-yellow-100 text-yellow-600"><i class="fas fa-baby text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Data Bayi</h3>
        </div>
        <form action="{{ route('babies.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Nama Ibu <span class="text-red-500">*</span></label>
                <select name="patient_id" required class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                    <option value="">-- Pilih Ibu --</option>
                    @foreach($mothers as $m)
                    <option value="{{ $m->id }}" {{ old('patient_id') == $m->id ? 'selected' : '' }}>{{ $m->name }} &mdash; {{ $m->nik }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Nama Bayi <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Bayi" required
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Jenis Kelamin</label>
                    <div class="flex gap-3 mt-1">
                        <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-stroke p-3 text-sm flex-1 has-[:checked]:border-blue-400 has-[:checked]:bg-blue-50 dark:border-strokedark dark:has-[:checked]:bg-blue-900/20">
                            <input type="radio" name="gender" value="male" {{ old('gender', 'male') == 'male' ? 'checked' : '' }} class="accent-blue-500" />
                            <span class="font-medium">👦 Laki-laki</span>
                        </label>
                        <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-stroke p-3 text-sm flex-1 has-[:checked]:border-pink-400 has-[:checked]:bg-pink-50 dark:border-strokedark dark:has-[:checked]:bg-pink-900/20">
                            <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} class="accent-pink-500" />
                            <span class="font-medium">👧 Perempuan</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Berat Lahir (Kg) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="birth_weight" value="{{ old('birth_weight') }}" placeholder="3.5" required
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm text-center outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Panjang (cm) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.1" name="birth_length" value="{{ old('birth_length') }}" placeholder="50" required
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm text-center outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Jam Lahir <span class="text-red-500">*</span></label>
                    <input type="time" name="birth_time" value="{{ old('birth_time') }}" required
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Kondisi Lahir</label>
                <input type="text" name="birth_condition" value="{{ old('birth_condition', 'Sehat / Normal') }}"
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
            </div>

            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                <i class="fas fa-save"></i> Simpan Data Bayi
            </button>
        </form>
    </div>
</div>
</x-admin-layout>
