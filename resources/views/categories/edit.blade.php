<x-admin-layout>
<div class="mx-auto max-w-xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-edit mr-2 text-primary"></i>Edit Kategori</h2>
        <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary"><i class="fas fa-tag text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Edit Kategori</h3>
        </div>
        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Nama Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input">{{ old('description', $category->description) }}</textarea>
            </div>
            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
</x-admin-layout>
