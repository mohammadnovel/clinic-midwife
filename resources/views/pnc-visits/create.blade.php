<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('pnc-visits.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Catat Kunjungan Nifas</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <form action="{{ route('pnc-visits.store') }}" method="POST" class="p-6.5">
                @csrf

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Pilih Ibu (Dari Riwayat Persalinan) <span
                            class="text-meta-1">*</span></label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="delivery_id"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary select2">
                            <option value="">-- Pilih Ibu --</option>
                            @foreach($deliveries as $d)
                                <option value="{{ $d->id }}">{{ $d->patient->name }} - Tgl Lahir:
                                    {{ $d->delivery_time->format('d/m/Y') }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Jenis Kunjungan</label>
                        <select name="visit_code"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="KF1">KF1 (6 jam - 2 hari post partum)</option>
                            <option value="KF2">KF2 (3 - 7 hari post partum)</option>
                            <option value="KF3">KF3 (8 - 28 hari post partum)</option>
                            <option value="KF4">KF4 (29 - 42 hari post partum)</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Tanggal Kunjungan</label>
                        <input type="date" name="appointment_date" value="{{ date('Y-m-d') }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                </div>

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Tekanan Darah</label>
                        <input type="text" name="blood_pressure" placeholder="110/80"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Kondisi Lokia (Cairan)</label>
                        <input type="text" name="lochia_condition" placeholder="Merah / Putih / Berbau?"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Involusi Uterus (TFU)</label>
                        <input type="text" name="uterine_involution" placeholder="2 jari bawah pusat"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="breastfeeding_status" value="1" class="sr-only peer" checked>
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Menyusui Lancar? (ASI
                            Eksklusif)</span>
                    </label>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Catatan Tambahan</label>
                    <textarea name="notes" rows="3"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"></textarea>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Simpan
                    Data</button>
            </form>
        </div>
    </div>
</x-admin-layout>