<x-admin-layout>
<div class="mx-auto max-w-3xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-pen mr-2 text-primary"></i>Tulis Artikel</h2>
        <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4"><ul class="list-disc pl-5 text-sm text-red-600">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
            <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary"><i class="fas fa-info-circle text-sm"></i></div>
                <h3 class="font-semibold text-black dark:text-white">Informasi Artikel</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Judul Artikel <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Judul artikel..."
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">Kategori</label>
                        <select name="category_id" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <option value="">-- Tanpa Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-black dark:text-white">Status <span class="text-red-500">*</span></label>
                        <select name="status" required class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input">
                            <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Ringkasan / Excerpt</label>
                    <textarea name="excerpt" rows="2" placeholder="Ringkasan singkat artikel (tampil di daftar)..."
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input">{{ old('excerpt') }}</textarea>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
            <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary"><i class="fas fa-align-left text-sm"></i></div>
                <h3 class="font-semibold text-black dark:text-white">Konten Artikel</h3>
            </div>
            <div class="p-6">
                <textarea name="content" id="content-editor" rows="14" required placeholder="Tulis konten artikel di sini..."
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input font-mono">{{ old('content') }}</textarea>
            </div>
        </div>

        <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
            <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary"><i class="fas fa-image text-sm"></i></div>
                <h3 class="font-semibold text-black dark:text-white">Thumbnail</h3>
            </div>
            <div class="p-6">
                <div id="drop-zone" class="flex flex-col items-center justify-center border-2 border-dashed border-stroke rounded-xl p-8 text-center cursor-pointer hover:border-primary transition-colors dark:border-strokedark">
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-300 mb-2"></i>
                    <p class="text-sm text-gray-400">Klik atau drag & drop gambar di sini</p>
                    <p class="text-xs text-gray-300 mt-1">PNG, JPG, WEBP (maks. 2MB)</p>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="hidden">
                </div>
                <div id="preview-wrap" class="mt-3 hidden">
                    <img id="thumbnail-preview" src="#" alt="Preview" class="h-40 rounded-xl object-cover">
                    <button type="button" onclick="clearThumb()" class="mt-2 text-xs text-red-400 hover:text-red-600"><i class="fas fa-times mr-1"></i>Hapus gambar</button>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 pb-4">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke px-5 py-2.5 text-sm font-medium hover:bg-gray-50 dark:border-strokedark">
                Batal
            </a>
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-primary px-6 py-2.5 text-sm font-semibold text-white hover:bg-opacity-90 active:scale-95">
                <i class="fas fa-save"></i> Simpan Artikel
            </button>
        </div>
    </form>
</div>

<script>
    // Thumbnail drag & drop / click
    const dropZone = document.getElementById('drop-zone');
    const thumbInput = document.getElementById('thumbnail');
    const previewWrap = document.getElementById('preview-wrap');
    const previewImg = document.getElementById('thumbnail-preview');

    dropZone.addEventListener('click', () => thumbInput.click());
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('border-primary'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('border-primary'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('border-primary');
        if (e.dataTransfer.files[0]) showPreview(e.dataTransfer.files[0]);
    });
    thumbInput.addEventListener('change', () => { if (thumbInput.files[0]) showPreview(thumbInput.files[0]); });

    function showPreview(file) {
        const reader = new FileReader();
        reader.onload = e => { previewImg.src = e.target.result; previewWrap.classList.remove('hidden'); dropZone.classList.add('hidden'); };
        reader.readAsDataURL(file);
    }

    function clearThumb() {
        thumbInput.value = '';
        previewImg.src = '#';
        previewWrap.classList.add('hidden');
        dropZone.classList.remove('hidden');
    }
</script>
</x-admin-layout>
