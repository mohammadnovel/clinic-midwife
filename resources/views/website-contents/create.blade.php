<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('website-contents.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Tambah Konten Website</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <form action="{{ route('website-contents.store') }}" method="POST" class="p-6.5">
                @csrf

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Kategori Konten <span
                            class="text-meta-1">*</span></label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="category"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="slider">Slider / Banner Utama</option>
                            <option value="service_highlight">Service Highlight</option>
                            <option value="about_us">Tentang Kami</option>
                            <option value="faq">FAQ / Tanya Jawab</option>
                            <option value="announcement">Pengumuman</option>
                            <option value="contact">Kontak</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Key (ID Unik) <span
                            class="text-meta-1">*</span></label>
                    <input type="text" name="key" placeholder="Contoh: slider-1, about-us-main"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        required />
                    <p class="text-sm text-gray-500 mt-1">Harus unik, gunakan huruf kecil dan strip (slug format).</p>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Judul</label>
                    <input type="text" name="title" placeholder="Judul Konten"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        required />
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Isi Konten (HTML / Text)</label>
                    <textarea name="content" rows="6"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"></textarea>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Simpan
                    Konten</button>
            </form>
        </div>
    </div>
</x-admin-layout>