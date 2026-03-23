<x-admin-layout>
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-user-edit mr-2 text-primary"></i>Edit Data Bidan</h2>
            <p class="text-sm text-gray-500 mt-1">{{ $midwife->user->name }}</p>
        </div>
        <a href="{{ route('midwives.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 dark:bg-red-900/20"><ul class="list-disc pl-5 text-sm text-red-600">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-blue-600"><i class="fas fa-user-nurse text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Data Bidan</h3>
        </div>
        <form action="{{ route('midwives.update', $midwife->id) }}" method="POST" class="p-6 space-y-4">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Nama Lengkap <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="text" name="name" value="{{ old('name', $midwife->user->name) }}" required
                            class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-10 pr-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-user text-sm"></i></span>
                    </div>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Nomor SIP <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="text" name="sip_number" value="{{ old('sip_number', $midwife->sip_number) }}" required
                            class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-10 pr-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-certificate text-sm"></i></span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Nomor HP</label>
                    <div class="relative">
                        <input type="text" name="phone" value="{{ old('phone', $midwife->phone) }}"
                            class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-10 pr-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-phone text-sm"></i></span>
                    </div>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">URL Foto</label>
                    <input type="url" name="photo_path" value="{{ old('photo_path', $midwife->photo_path) }}" placeholder="https://..."
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Bio Singkat</label>
                <textarea name="bio" rows="3" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('bio', $midwife->bio) }}</textarea>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Status Aktif</label>
                <div class="flex gap-3">
                    <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-stroke p-3 text-sm transition has-[:checked]:border-green-500 has-[:checked]:bg-green-50 dark:border-strokedark dark:has-[:checked]:bg-green-900/20">
                        <input type="radio" name="is_active" value="1" {{ old('is_active', $midwife->is_active) ? 'checked' : '' }} class="accent-green-500" />
                        <span class="font-medium">✅ Aktif</span>
                    </label>
                    <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-stroke p-3 text-sm transition has-[:checked]:border-red-400 has-[:checked]:bg-red-50 dark:border-strokedark dark:has-[:checked]:bg-red-900/20">
                        <input type="radio" name="is_active" value="0" {{ !old('is_active', $midwife->is_active) ? 'checked' : '' }} class="accent-red-500" />
                        <span class="font-medium text-red-600">⛔ Non-aktif</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
</x-admin-layout>
