<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('pnc-visits.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Edit Kunjungan Nifas</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="p-6.5 border-b border-stroke dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">Pasien: {{ $pncVisit->delivery->patient->name }}</h3>
            </div>

            <form action="{{ route('pnc-visits.update', $pncVisit->id) }}" method="POST" class="p-6.5">
                @csrf
                @method('PUT')

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Jenis Kunjungan</label>
                    <select name="visit_code"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                        <option value="KF1" {{ $pncVisit->visit_code == 'KF1' ? 'selected' : '' }}>KF1 (6 jam - 2 hari)
                        </option>
                        <option value="KF2" {{ $pncVisit->visit_code == 'KF2' ? 'selected' : '' }}>KF2 (3 - 7 hari)
                        </option>
                        <option value="KF3" {{ $pncVisit->visit_code == 'KF3' ? 'selected' : '' }}>KF3 (8 - 28 hari)
                        </option>
                        <option value="KF4" {{ $pncVisit->visit_code == 'KF4' ? 'selected' : '' }}>KF4 (29 - 42 hari)
                        </option>
                    </select>
                </div>

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Tekanan Darah</label>
                        <input type="text" name="blood_pressure" value="{{ $pncVisit->blood_pressure }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Kondisi Lokia</label>
                        <input type="text" name="lochia_condition" value="{{ $pncVisit->lochia_condition }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Involusi Uterus</label>
                        <input type="text" name="uterine_involution" value="{{ $pncVisit->uterine_involution }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="breastfeeding_status" value="1" class="sr-only peer" {{ $pncVisit->breastfeeding_status ? 'checked' : '' }}>
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
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ $pncVisit->notes }}</textarea>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Update
                    Data</button>
            </form>
        </div>
    </div>
</x-admin-layout>