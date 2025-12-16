<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('appointments.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Buat Antrian Baru</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <form action="{{ route('appointments.store') }}" method="POST" class="p-6.5">
                @csrf

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Pilih Pasien <span
                            class="text-meta-1">*</span></label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="patient_id"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="">-- Pilih Pasien --</option>
                            @foreach($patients as $p)
                                <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->nik }})</option>
                            @endforeach
                        </select>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Pasien belum terdaftar? <a
                            href="{{ route('patients.create') }}" class="text-primary hover:underline">Register Pasien
                            Baru</a></p>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Pilih Bidan</label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="midwife_id"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            @foreach($midwives as $m)
                                <option value="{{ $m->id }}">{{ $m->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Tanggal & Waktu</label>
                        <input type="datetime-local" name="appointment_date" value="{{ now()->format('Y-m-d\TH:i') }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>

                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Kategori Layanan</label>
                        <div class="relative z-20 bg-transparent dark:bg-form-input">
                            <select name="service_category"
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                <option value="General">Pemeriksaan Umum</option>
                                <option value="ANC">Pemeriksaan Kehamilan (ANC)</option>
                                <option value="Delivery">Persalinan</option>
                                <option value="Immunization">Imunisasi Bayi</option>
                                <option value="KB">Keluarga Berencana</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Simpan &
                    Cetak Antrian</button>
            </form>
        </div>
    </div>
</x-admin-layout>