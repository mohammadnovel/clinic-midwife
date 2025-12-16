<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('pregnancies.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Edit Data Kehamilan</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="p-6.5 border-b border-stroke dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">Informasi Pasien</h3>
                <p>Nama: <b>{{ $pregnancy->patient->name }}</b></p>
                <p>HPL: {{ $pregnancy->hpl }}</p>
            </div>

            <form action="{{ route('pregnancies.update', $pregnancy->id) }}" method="POST" class="p-6.5">
                @csrf
                @method('PUT')

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Status Kehamilan <span
                            class="text-meta-1">*</span></label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="status"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="active" {{ $pregnancy->status == 'active' ? 'selected' : '' }}>Aktif (Belum
                                Melahirkan)</option>
                            <option value="delivered" {{ $pregnancy->status == 'delivered' ? 'selected' : '' }}>Sudah
                                Melahirkan (Delivered)</option>
                            <option value="aborted" {{ $pregnancy->status == 'aborted' ? 'selected' : '' }}>Keguguran
                                (Aborted)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Riwayat / Catatan Tambahan</label>
                    <textarea name="history_notes" rows="3"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ $pregnancy->history_notes }}</textarea>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Update
                    Status</button>
            </form>
        </div>
    </div>
</x-admin-layout>