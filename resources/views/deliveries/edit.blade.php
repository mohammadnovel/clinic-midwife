<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('deliveries.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Edit Data Persalinan</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <form action="{{ route('deliveries.update', $delivery->id) }}" method="POST" class="p-6.5">
                @csrf
                @method('PUT')

                <div class="p-4 bg-gray-100 dark:bg-meta-4 rounded mb-4">
                    <h3 class="font-bold">Ibu: {{ $delivery->pregnancy->patient->name }}</h3>
                </div>

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Waktu Lahir</label>
                        <input type="datetime-local" name="delivery_time"
                            value="{{ $delivery->delivery_time->format('Y-m-d\TH:i') }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Metode Persalinan</label>
                        <select name="method"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="Normal" {{ $delivery->method == 'Normal' ? 'selected' : '' }}>Normal (Spontan)
                            </option>
                            <option value="Vacuum" {{ $delivery->method == 'Vacuum' ? 'selected' : '' }}>Vacuum</option>
                            <option value="Sectio Caesar" {{ $delivery->method == 'Sectio Caesar' ? 'selected' : '' }}>
                                Sectio Caesar</option>
                            <option value="Induksi" {{ $delivery->method == 'Induksi' ? 'selected' : '' }}>Induksi
                            </option>
                        </select>
                    </div>
                </div>

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Kondisi Lahir</label>
                        <select name="birth_condition"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="Healthy" {{ $delivery->birth_condition == 'Healthy' ? 'selected' : '' }}>Sehat
                                / Hidup</option>
                            <option value="Asphyxia" {{ $delivery->birth_condition == 'Asphyxia' ? 'selected' : '' }}>
                                Asfiksia (Sesak)</option>
                            <option value="Stillbirth" {{ $delivery->birth_condition == 'Stillbirth' ? 'selected' : '' }}>
                                Lahir Mati (IUFD)</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Perdarahan (ml)</label>
                        <input type="number" name="blood_loss_ml" value="{{ $delivery->blood_loss_ml }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Lama Persalinan (Menit)</label>
                    <div class="flex gap-4">
                        <input type="number" name="duration_first_stage" placeholder="Kala I"
                            value="{{ $delivery->duration_first_stage }}"
                            class="w-1/3 rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-sm outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        <input type="number" name="duration_second_stage" placeholder="Kala II"
                            value="{{ $delivery->duration_second_stage }}"
                            class="w-1/3 rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-sm outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        <input type="number" name="duration_third_stage" placeholder="Kala III"
                            value="{{ $delivery->duration_third_stage }}"
                            class="w-1/3 rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-sm outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Kondisi Perineum / Plasenta</label>
                    <textarea name="perineum_condition" rows="2"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ $delivery->perineum_condition }}</textarea>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Komplikasi / Catatan</label>
                    <textarea name="complications" rows="2"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ $delivery->complications }}</textarea>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Update
                    Data</button>
            </form>
        </div>
    </div>
</x-admin-layout>