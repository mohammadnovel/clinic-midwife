<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('babies.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Tambah Data Bayi</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="p-6.5 bg-yellow-50 mb-4 border-b border-yellow-100">
                <p class="text-sm text-yellow-700"><i class="fas fa-info-circle"></i> Idealnya data bayi dibuat otomatis
                    dari menu <b>Persalinan</b>. Gunakan form ini hanya untuk input data manual / bayi lama.</p>
            </div>
            <form action="{{ route('babies.store') }}" method="POST" class="p-6.5">
                @csrf

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Nama Ibu <span
                            class="text-meta-1">*</span></label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="patient_id"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="">-- Pilih Ibu --</option>
                            @foreach($mothers as $m)
                                <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->nik }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Nama Bayi <span
                            class="text-meta-1">*</span></label>
                    <input type="text" name="name" placeholder="Nama Bayi"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        required />
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Jenis Kelamin</label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="gender"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Berat (Kg)</label>
                        <input type="number" step="0.01" name="birth_weight" placeholder="3.5"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Panjang (cm)</label>
                        <input type="number" step="0.1" name="birth_length" placeholder="50"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Jam Lahir</label>
                        <input type="time" name="birth_time"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Kondisi Lahir</label>
                    <input type="text" name="birth_condition" value="Sehat / Normal"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Simpan Data
                    Bayi</button>
            </form>
        </div>
    </div>
</x-admin-layout>