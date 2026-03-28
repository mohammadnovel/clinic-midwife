<x-admin-layout>
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-edit mr-2 text-primary"></i>Edit Layanan</h2>
            <p class="text-sm text-gray-500 mt-1 font-mono">{{ $service->code }}</p>
        </div>
        <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 dark:bg-red-900/20"><ul class="list-disc pl-5 text-sm text-red-600">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-green-100 text-green-600"><i class="fas fa-stethoscope text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Detail Layanan</h3>
        </div>
        <form action="{{ route('services.update', $service->id) }}" method="POST" class="p-6 space-y-4">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Kode Layanan <span class="text-red-500">*</span></label>
                    <input type="text" name="code" value="{{ old('code', $service->code) }}" required
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Nama Layanan <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $service->name) }}" required
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Kategori</label>
                    <select name="category" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                        @foreach(['General' => 'Umum', 'ANC' => 'Pemeriksaan Kehamilan (ANC)', 'Delivery' => 'Persalinan', 'Immunization' => 'Imunisasi', 'KB' => 'Keluarga Berencana'] as $val => $label)
                        <option value="{{ $val }}" {{ old('category', $service->category) == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Harga (Rp) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm text-gray-400 font-medium">Rp</span>
                        <input type="number" name="price" value="{{ old('price', $service->price) }}" min="0" required
                            class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-10 pr-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Icon <span class="text-gray-400 font-normal text-xs">(Font Awesome class)</span></label>
                <div class="flex items-center gap-3">
                    <div id="icon-preview" class="flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary text-lg flex-shrink-0">
                        <i class="{{ old('icon', $service->icon) }}"></i>
                    </div>
                    <input type="text" name="icon" id="icon-input" value="{{ old('icon', $service->icon) }}" placeholder="Contoh: fas fa-baby-carriage"
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
                <p class="text-xs text-gray-400 mt-1">Cari icon di <a href="https://fontawesome.com/icons" target="_blank" class="text-primary hover:underline">fontawesome.com/icons</a> → klik icon → salin class-nya</p>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('description', $service->description) }}</textarea>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Status</label>
                <div class="flex gap-3">
                    <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-stroke p-3 text-sm transition has-[:checked]:border-green-500 has-[:checked]:bg-green-50 dark:border-strokedark dark:has-[:checked]:bg-green-900/20">
                        <input type="radio" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }} class="accent-green-500" /> <span class="font-medium">✅ Aktif</span>
                    </label>
                    <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-stroke p-3 text-sm transition has-[:checked]:border-red-400 has-[:checked]:bg-red-50 dark:border-strokedark dark:has-[:checked]:bg-red-900/20">
                        <input type="radio" name="is_active" value="0" {{ !old('is_active', $service->is_active) ? 'checked' : '' }} class="accent-red-500" /> <span class="font-medium text-red-600">⛔ Non-aktif</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
<script>
    document.getElementById('icon-input').addEventListener('input', function () {
        const icon = document.querySelector('#icon-preview i');
        icon.className = this.value || 'fas fa-hand-holding-medical';
    });
</script>
</x-admin-layout>
