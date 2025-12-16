<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('website-contents.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Edit Konten Website</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="p-6.5 border-b border-stroke dark:border-strokedark">
                <p>Key: <b>{{ $websiteContent->key }}</b></p>
            </div>

            <form action="{{ route('website-contents.update', $websiteContent->id) }}" method="POST" class="p-6.5">
                @csrf
                @method('PUT')

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Kategori Konten <span
                            class="text-meta-1">*</span></label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="category"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="slider" {{ $websiteContent->category == 'slider' ? 'selected' : '' }}>Slider /
                                Banner Utama</option>
                            <option value="service_highlight" {{ $websiteContent->category == 'service_highlight' ? 'selected' : '' }}>Service Highlight</option>
                            <option value="about_us" {{ $websiteContent->category == 'about_us' ? 'selected' : '' }}>
                                Tentang Kami</option>
                            <option value="faq" {{ $websiteContent->category == 'faq' ? 'selected' : '' }}>FAQ</option>
                            <option value="announcement" {{ $websiteContent->category == 'announcement' ? 'selected' : '' }}>Pengumuman</option>
                            <option value="contact" {{ $websiteContent->category == 'contact' ? 'selected' : '' }}>Kontak
                            </option>
                        </select>
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Judul</label>
                    <input type="text" name="title" value="{{ $websiteContent->title }}"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        required />
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Isi Konten (HTML / Text)</label>
                    <textarea name="content" rows="6"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ $websiteContent->content }}</textarea>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Update
                    Konten</button>
            </form>
        </div>
    </div>
</x-admin-layout>