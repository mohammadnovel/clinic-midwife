<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('immunizations.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Catat Vaksinasi / Imunisasi</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <form action="{{ route('immunizations.store') }}" method="POST" class="p-6.5">
                @csrf

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Pilih Anak / Pasien <span
                            class="text-meta-1">*</span></label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="patient_id"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary select2">
                            <option value="">-- Pilih Pasien --</option>
                            @foreach($patients as $p)
                                <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->nik }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Jenis Vaksin <span
                            class="text-meta-1">*</span></label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="immunization_type_id"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            @foreach($types as $t)
                                <option value="{{ $t->id }}">{{ $t->name }} (Usia: {{ $t->recommended_age_months }} bln)
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Tanggal Vaksinasi</label>
                        <input type="date" name="date_given" value="{{ date('Y-m-d') }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Nomor Batch Vaksin</label>
                        <input type="text" name="batch_number" placeholder="Contoh: BATCH-12345"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Catatan / Reaksi</label>
                    <textarea name="notes" rows="3"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"></textarea>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Simpan
                    Data</button>
            </form>
        </div>
    </div>
</x-admin-layout>