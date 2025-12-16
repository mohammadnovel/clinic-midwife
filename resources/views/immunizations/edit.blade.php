<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('immunizations.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Edit Data Vaksinasi</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="p-6.5 border-b border-stroke dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">Pasien: {{ $immunization->patient->name }}</h3>
            </div>

            <form action="{{ route('immunizations.update', $immunization->id) }}" method="POST" class="p-6.5">
                @csrf
                @method('PUT')

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Jenis Vaksin <span
                            class="text-meta-1">*</span></label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="immunization_type_id"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            @foreach($types as $t)
                                <option value="{{ $t->id }}" {{ $immunization->immunization_type_id == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Tanggal Vaksinasi</label>
                        <input type="date" name="date_given"
                            value="{{ \Carbon\Carbon::parse($immunization->date_given)->format('Y-m-d') }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Nomor Batch Vaksin</label>
                        <input type="text" name="batch_number" value="{{ $immunization->batch_number }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Catatan / Reaksi</label>
                    <textarea name="notes" rows="3"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ $immunization->notes }}</textarea>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Update
                    Data</button>
            </form>
        </div>
    </div>
</x-admin-layout>