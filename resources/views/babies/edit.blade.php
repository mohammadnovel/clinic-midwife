<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('babies.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Edit Data Bayi</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <form action="{{ route('babies.update', $baby->id) }}" method="POST" class="p-6.5">
                @csrf
                @method('PUT')

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Nama Bayi <span
                            class="text-meta-1">*</span></label>
                    <input type="text" name="name" value="{{ $baby->name }}"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        required />
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Jenis Kelamin</label>
                    <div class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="gender"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="male" {{ $baby->gender == 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ $baby->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4.5 flex gap-4">
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Berat (Kg)</label>
                        <input type="number" step="0.01" name="birth_weight" value="{{ $baby->birth_weight }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                    <div class="w-1/3">
                        <label class="mb-2.5 block text-black dark:text-white">Panjang (cm)</label>
                        <input type="number" step="0.1" name="birth_length" value="{{ $baby->birth_length }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            required />
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Kondisi Lahir</label>
                    <input type="text" name="birth_condition" value="{{ $baby->birth_condition }}"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Update Data
                    Bayi</button>
            </form>
        </div>
    </div>
</x-admin-layout>