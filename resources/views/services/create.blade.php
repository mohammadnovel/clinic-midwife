<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('services.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Tambah Data Layanan</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <form action="{{ route('services.store') }}" method="POST" class="p-6.5">
                @csrf
                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Kode Layanan <span
                            class="text-meta-1">*</span></label>
                    <input type="text" name="code" placeholder="Contoh: ANC01"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        required />
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Nama Layanan <span
                            class="text-meta-1">*</span></label>
                    <input type="text" name="name" placeholder="Nama Layanan"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        required />
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Kategori</label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="category"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="General">Umum</option>
                            <option value="ANC">Pemeriksaan Kehamilan (ANC)</option>
                            <option value="Delivery">Persalinan</option>
                            <option value="Immunization">Imunisasi</option>
                            <option value="KB">Keluarga Berencana</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Harga (Rp)</label>
                    <input type="number" name="price" placeholder="0"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        required />
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Simpan
                    Layanan</button>
            </form>
        </div>
    </div>
</x-admin-layout>