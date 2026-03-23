<x-admin-layout>
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-globe mr-2 text-primary"></i>Tambah Konten Website</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola konten yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('website-contents.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 dark:bg-red-900/20"><ul class="list-disc pl-5 text-sm text-red-600">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 text-indigo-600"><i class="fas fa-file-alt text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Detail Konten</h3>
        </div>
        <form action="{{ route('website-contents.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                        @foreach(['slider' => 'Slider / Banner Utama', 'service_highlight' => 'Service Highlight', 'about_us' => 'Tentang Kami', 'faq' => 'FAQ / Tanya Jawab', 'announcement' => 'Pengumuman', 'contact' => 'Kontak'] as $val => $label)
                        <option value="{{ $val }}" {{ old('category') == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Key (Slug Unik) <span class="text-red-500">*</span></label>
                    <input type="text" name="key" value="{{ old('key') }}" placeholder="mis: slider-hero-1" required
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    <p class="text-xs text-gray-400 mt-1">Huruf kecil dan tanda strip saja.</p>
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Judul Konten" required
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Isi Konten (HTML / Teks)</label>
                <textarea name="content" rows="8" placeholder="Konten dalam format HTML atau teks biasa..."
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm font-mono outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                <i class="fas fa-save"></i> Simpan Konten
            </button>
        </form>
    </div>
</div>
</x-admin-layout>
