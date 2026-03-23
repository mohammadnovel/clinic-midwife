<x-admin-layout>
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-edit mr-2 text-primary"></i>Edit Data Kehamilan</h2>
            <p class="text-sm text-gray-500 mt-1">{{ $pregnancy->patient->name }}</p>
        </div>
        <a href="{{ route('pregnancies.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Info Card --}}
    <div class="mb-4 grid grid-cols-2 sm:grid-cols-4 gap-3">
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark text-center">
            <p class="text-xs text-gray-400">Pasien</p>
            <p class="font-semibold text-sm text-black dark:text-white mt-1">{{ $pregnancy->patient->name }}</p>
        </div>
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark text-center">
            <p class="text-xs text-gray-400">HPL</p>
            <p class="font-semibold text-sm text-primary mt-1">{{ $pregnancy->hpl ? \Carbon\Carbon::parse($pregnancy->hpl)->format('d M Y') : '-' }}</p>
        </div>
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark text-center">
            <p class="text-xs text-gray-400">G / P / A</p>
            <p class="font-semibold text-sm text-black dark:text-white mt-1">{{ $pregnancy->gravida }} / {{ $pregnancy->partus }} / {{ $pregnancy->abortus }}</p>
        </div>
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark text-center">
            <p class="text-xs text-gray-400">Status</p>
            <p class="font-semibold text-sm mt-1 {{ $pregnancy->status == 'active' ? 'text-green-600' : 'text-gray-500' }}">{{ ucfirst($pregnancy->status) }}</p>
        </div>
    </div>

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-pink-100 text-pink-500"><i class="fas fa-edit text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Update Data Kehamilan</h3>
        </div>
        <form action="{{ route('pregnancies.update', $pregnancy->id) }}" method="POST" class="p-6 space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Status Kehamilan <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                    @foreach(['active' => ['label' => '🤰 Aktif (Hamil)', 'color' => 'green'], 'delivered' => ['label' => '👶 Sudah Melahirkan', 'color' => 'blue'], 'aborted' => ['label' => '⚠️ Keguguran', 'color' => 'orange']] as $val => $opt)
                    <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-stroke p-3 text-sm transition has-[:checked]:border-{{ $opt['color'] }}-400 has-[:checked]:bg-{{ $opt['color'] }}-50 dark:border-strokedark dark:has-[:checked]:bg-{{ $opt['color'] }}-900/20">
                        <input type="radio" name="status" value="{{ $val }}" {{ old('status', $pregnancy->status) == $val ? 'checked' : '' }} class="accent-{{ $opt['color'] }}-500" />
                        <span class="font-medium">{{ $opt['label'] }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Riwayat / Catatan Tambahan</label>
                <textarea name="history_notes" rows="4" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('history_notes', $pregnancy->history_notes) }}</textarea>
            </div>

            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
</x-admin-layout>
