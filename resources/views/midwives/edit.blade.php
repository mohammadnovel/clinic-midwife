<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
            <a href="{{ route('midwives.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Edit Data Bidan</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <form action="{{ route('midwives.update', $midwife->id) }}" method="POST" class="p-6.5">
                @csrf
                @method('PUT')
                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Nama Lengkap <span
                            class="text-meta-1">*</span></label>
                    <input type="text" name="name" value="{{ $midwife->user->name }}"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        required />
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Nomor SIP <span
                            class="text-meta-1">*</span></label>
                    <input type="text" name="sip_number" value="{{ $midwife->sip_number }}"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                        required />
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Nomor HP</label>
                    <input type="text" name="phone" value="{{ $midwife->phone }}"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">URL Foto</label>
                    <input type="url" name="photo_path" value="{{ $midwife->photo_path }}" placeholder="https://..."
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>

                <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Bio Singkat</label>
                    <textarea name="bio" rows="3"
                        class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ $midwife->bio }}</textarea>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Update Data
                    Bidan</button>
            </form>
        </div>
    </div>
</x-admin-layout>