<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('family-plannings.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Form Keluarga Berencana (KB)</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <form action="{{ route('family-plannings.store') }}" method="POST" class="p-6.5">
                @csrf

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Pilih Pasien <span
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

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Metode Kontrasepsi</label>
                        <select name="method"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="Suntik 1 Bulan">Suntik 1 Bulan</option>
                            <option value="Suntik 3 Bulan">Suntik 3 Bulan</option>
                            <option value="Pil KB">Pil KB</option>
                            <option value="IUD / Spiral">IUD / Spiral</option>
                            <option value="Implan / Susuk">Implan / Susuk</option>
                            <option value="Kondom">Kondom</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Tanggal Pasang / Kunjungan</label>
                        <input type="date" name="visit_date" value="{{ date('Y-m-d') }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                </div>

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Berat Badan (Kg)</label>
                        <input type="text" name="weight" placeholder="Contoh: 55 Kg"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Tekanan Darah</label>
                        <input type="text" name="blood_pressure" placeholder="110/70"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Efek Samping / Keluhan</label>
                    <textarea name="side_effects" rows="3"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"></textarea>
                </div>

                <div class="p-4 bg-gray-100 dark:bg-meta-4 rounded mb-4">
                    <p class="text-sm text-gray-600 dark:text-gray-300"><i class="fas fa-info-circle mr-1"></i> Tanggal
                        kunjungan ulang (Next Visit) akan dihitung otomatis berdasarkan metode yang dipilih.</p>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Simpan
                    Data</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
</x-admin-layout>