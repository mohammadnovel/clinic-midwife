<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                <i class="fas fa-user-plus mr-2 text-primary"></i>Registrasi Pasien Baru
            </h2>
            <nav>
                <a href="{{ route('patients.index') }}"
                    class="flex items-center gap-2 rounded bg-white px-4 py-2 font-medium text-black dark:bg-meta-4 dark:text-white hover:bg-opacity-90 shadow-sm border border-stroke dark:border-strokedark">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </nav>
        </div>

        <div class="rounded-lg border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">
                    Informasi Pribadi
                </h3>
            </div>

            <form action="{{ route('patients.store') }}" method="POST" class="p-6.5">
                @csrf
                <div class="mb-4.5">
                    <label class="mb-2.5 block font-medium text-black dark:text-white">
                        Nomor Induk Kependudukan (NIK) <span class="text-meta-1">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="nik" placeholder="Masukkan 16 digit NIK"
                            class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                        <span class="absolute right-4 top-4">
                            <i class="fas fa-id-card text-gray-400"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block font-medium text-black dark:text-white">
                            Nama Lengkap <span class="text-meta-1">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" name="name" placeholder="Nama Pasien"
                                class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                required />
                            <span class="absolute right-4 top-4">
                                <i class="fas fa-user text-gray-400"></i>
                            </span>
                        </div>
                    </div>

                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block font-medium text-black dark:text-white">
                            Tanggal Lahir <span class="text-meta-1">*</span>
                        </label>
                        <div class="relative">
                            <input type="date" name="date_of_birth"
                                class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                required />
                        </div>
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block font-medium text-black dark:text-white">
                        Alamat Lengkap
                    </label>
                    <textarea name="address" rows="3" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan..."
                        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"></textarea>
                </div>

                <div class="mb-6 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block font-medium text-black dark:text-white">
                            Nomor Handphone / WhatsApp
                        </label>
                        <div class="relative">
                            <input type="text" name="phone" placeholder="08..."
                                class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            <span class="absolute right-4 top-4">
                                <i class="fas fa-phone text-gray-400"></i>
                            </span>
                        </div>
                    </div>

                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block font-medium text-black dark:text-white">
                            Nama Suami (Jika Ada)
                        </label>
                        <div class="relative">
                            <input type="text" name="husband_name" placeholder="Nama Suami"
                                class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            <span class="absolute right-4 top-4">
                                <i class="fas fa-male text-gray-400"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <button
                    class="flex w-full justify-center rounded-lg bg-primary p-4 font-medium text-white transition hover:bg-opacity-90">
                    <i class="fas fa-save mr-2"></i> Simpan Data Pasien
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>