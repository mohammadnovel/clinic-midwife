<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('deliveries.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Form Persalinan Baru</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <form action="{{ route('deliveries.store') }}" method="POST" class="p-6.5">
                @csrf

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Pilih Kehamilan (Status Aktif) <span
                            class="text-meta-1">*</span></label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="pregnancy_id"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary select2">
                            <option value="">-- Pilih Ibu Hamil --</option>
                            @foreach($pregnancies as $p)
                                <option value="{{ $p->id }}">{{ $p->patient->name }} (HPL:
                                    {{ $p->hpl ? $p->hpl->format('d M Y') : '-' }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Waktu Lahir</label>
                        <input type="datetime-local" name="delivery_time" value="{{ date('Y-m-d\TH:i') }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Metode Persalinan</label>
                        <select name="method"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="Normal">Normal (Spontan)</option>
                            <option value="Vacuum">Vacuum</option>
                            <option value="Sectio Caesar">Sectio Caesar</option>
                            <option value="Induksi">Induksi</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Kondisi Lahir</label>
                        <select name="birth_condition"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="Healthy">Sehat / Hidup</option>
                            <option value="Asphyxia">Asfiksia (Sesak)</option>
                            <option value="Stillbirth">Lahir Mati (IUFD)</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Perdarahan (ml)</label>
                        <input type="number" name="blood_loss_ml" placeholder="Contoh: 200"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Lama Persalinan (Menit)</label>
                    <div class="flex gap-4">
                        <input type="number" name="duration_first_stage" placeholder="Kala I"
                            class="w-1/3 rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-sm outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        <input type="number" name="duration_second_stage" placeholder="Kala II"
                            class="w-1/3 rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-sm outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        <input type="number" name="duration_third_stage" placeholder="Kala III"
                            class="w-1/3 rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-sm outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Kondisi Perineum / Plasenta</label>
                    <textarea name="perineum_condition" rows="2" placeholder="Utuh / Robekan Derajat 1/2/3"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"></textarea>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Komplikasi / Catatan</label>
                    <textarea name="complications" rows="2"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"></textarea>
                </div>

                <div class="p-4 bg-gray-100 dark:bg-meta-4 rounded mb-4">
                    <p class="text-sm text-gray-600 dark:text-gray-300"><i class="fas fa-info-circle mr-1"></i> Setelah
                        menyimpan data persalinan, Anda akan diarahkan untuk mengisi data <strong>Bayi</strong>.</p>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Simpan
                    Persalinan</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
</x-admin-layout>