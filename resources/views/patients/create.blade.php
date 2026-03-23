<x-admin-layout>
<div class="mx-auto max-w-2xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-user-plus mr-2 text-primary"></i>Registrasi Pasien Baru</h2>
            <p class="text-sm text-gray-500 mt-1">Isi data identitas pasien dengan lengkap.</p>
        </div>
        <a href="{{ route('patients.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 dark:bg-red-900/20 dark:border-red-800">
        <ul class="list-disc pl-5 text-sm text-red-600 dark:text-red-400">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary"><i class="fas fa-id-card text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Informasi Pribadi</h3>
        </div>
        <form action="{{ route('patients.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">NIK (16 Digit) <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="number" name="nik" value="{{ old('nik') }}" placeholder="Masukkan 16 digit NIK" required
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-10 pr-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-id-card text-sm"></i></span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Nama Lengkap <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Pasien" required
                            class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-10 pr-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-user text-sm"></i></span>
                    </div>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Alamat Lengkap</label>
                <textarea name="address" rows="3" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan..."
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('address') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">No. HP / WhatsApp</label>
                    <div class="relative">
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08..."
                            class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-10 pr-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-phone text-sm"></i></span>
                    </div>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Nama Suami (Jika Ada)</label>
                    <input type="text" name="husband_name" value="{{ old('husband_name') }}" placeholder="Nama Suami"
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">No. BPJS (Opsional)</label>
                    <input type="text" name="bpjs_number" value="{{ old('bpjs_number') }}" placeholder="No. BPJS Kesehatan"
                        class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-black dark:text-white">Golongan Darah</label>
                    <select name="blood_type" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                        <option value="">-- Pilih --</option>
                        @foreach(['A','B','AB','O','A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bt)
                        <option value="{{ $bt }}" {{ old('blood_type') == $bt ? 'selected' : '' }}>{{ $bt }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                <i class="fas fa-save"></i> Simpan Data Pasien
            </button>
        </form>
    </div>
</div>
</x-admin-layout>
