<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('pregnancies.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Registrasi Kehamilan Baru</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <form action="{{ route('pregnancies.store') }}" method="POST" class="p-6.5">
                @csrf

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Pilih Ibu Hamil <span
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
                    <label class="mb-2.5 block text-black dark:text-white">HPHT (Hari Pertama Haid Terakhir) <span
                            class="text-meta-1">*</span></label>
                    <input type="date" name="hpht"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        required />
                    <p class="text-sm text-gray-500 mt-1">HPL akan dihitung otomatis (+280 hari).</p>
                </div>

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Gravida (Hamil Ke-)</label>
                        <input type="number" name="gravida" value="1" min="1"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Partus (Melahirkan)</label>
                        <input type="number" name="partus" value="0" min="0"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Abortus (Keguguran)</label>
                        <input type="number" name="abortus" value="0" min="0"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Riwayat / Catatan Tambahan</label>
                    <textarea name="history_notes" rows="3"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"></textarea>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Simpan Data
                    Kehamilan</button>
            </form>
        </div>
    </div>
</x-admin-layout>