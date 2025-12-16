<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('anc-visits.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Edit Hasil Pemeriksaan ANC</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="p-6.5 border-b border-stroke dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">Pasien: {{ $ancVisit->pregnancy->patient->name }}
                </h3>
                <p>Tanggal Kunjungan: {{ $ancVisit->created_at->format('d M Y') }}</p>
            </div>

            <form action="{{ route('anc-visits.update', $ancVisit->id) }}" method="POST" class="p-6.5">
                @csrf
                @method('PUT')

                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Usia Kehamilan (Minggu)</label>
                        <input type="number" name="gestational_age_weeks" value="{{ $ancVisit->gestational_age_weeks }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>

                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Berat Badan (Kg)</label>
                        <input type="text" name="weight" value="{{ $ancVisit->weight }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>

                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Tensi Darah (mmHg)</label>
                        <input type="text" name="blood_pressure" value="{{ $ancVisit->blood_pressure }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Tinggi Fundus (cm)</label>
                        <input type="text" name="fundal_height" value="{{ $ancVisit->fundal_height }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Denyut Jantung Janin (DJJ)</label>
                    <input type="text" name="fetal_heart_rate" value="{{ $ancVisit->fetal_heart_rate }}"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Keluhan Utama</label>
                    <textarea name="complaints" rows="3"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ $ancVisit->complaints }}</textarea>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Tindakan / Resep / Saran</label>
                    <textarea name="actions" rows="3"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ $ancVisit->actions }}</textarea>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Update Hasil
                    Pemeriksaan</button>
            </form>
        </div>
    </div>
</x-admin-layout>