<x-admin-layout>
<div class="mx-auto max-w-4xl">

    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white">
                <i class="fas fa-ambulance mr-2 text-red-500"></i>Buat Surat Rujukan
            </h2>
            <p class="text-sm text-gray-500 mt-1">Rujukan pasien ke rumah sakit atau fasilitas kesehatan lain.</p>
        </div>
        <a href="{{ route('referrals.index') }}"
            class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 dark:bg-red-900/20 dark:border-red-800">
        <ul class="list-disc pl-5 text-sm text-red-600 dark:text-red-400">
            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('referrals.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left: Patient + RS Info + Medical --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Pasien --}}
                <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                    <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary">
                            <i class="fas fa-user-injured text-sm"></i>
                        </div>
                        <h3 class="font-semibold text-black dark:text-white">Data Pasien</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">
                                Pasien <span class="text-red-500">*</span>
                            </label>
                            <select name="patient_id" required
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                <option value="">-- Pilih Pasien --</option>
                                @foreach($patients as $p)
                                <option value="{{ $p->id }}" {{ old('patient_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->name }} &mdash; NIK {{ $p->nik }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-black dark:text-white">
                                    Bidan Perujuk
                                </label>
                                <select name="referred_by"
                                    class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                    <option value="">-- Pilih Bidan --</option>
                                    @foreach($midwives as $m)
                                    <option value="{{ $m->id }}" {{ old('referred_by') == $m->id ? 'selected' : '' }}>
                                        {{ $m->user->name ?? 'Bidan #'.$m->id }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-black dark:text-white">
                                    Tgl Rujukan <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="referral_date"
                                    value="{{ old('referral_date', date('Y-m-d')) }}"
                                    required
                                    class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">
                                Kunjungan Terkait (Opsional)
                            </label>
                            <select name="appointment_id"
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                <option value="">-- Tidak terkait kunjungan --</option>
                                @foreach($appointments as $apt)
                                <option value="{{ $apt->id }}" {{ old('appointment_id') == $apt->id ? 'selected' : '' }}>
                                    {{ $apt->patient->name ?? '' }} — {{ \Carbon\Carbon::parse($apt->appointment_date)->format('d M Y H:i') }} (No. {{ $apt->queue_number }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- RS Tujuan --}}
                <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                    <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-red-100 text-red-500">
                            <i class="fas fa-hospital text-sm"></i>
                        </div>
                        <h3 class="font-semibold text-black dark:text-white">Rumah Sakit Tujuan</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">
                                Nama Rumah Sakit <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-hospital-alt text-sm"></i>
                                </span>
                                <input type="text" name="hospital_name"
                                    value="{{ old('hospital_name') }}"
                                    placeholder="Contoh: RSUD Dr. Soeradji Tirtonegoro"
                                    required
                                    class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-10 pr-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            </div>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">
                                Alamat Rumah Sakit
                            </label>
                            <textarea name="hospital_address" rows="2"
                                placeholder="Jalan, kota, provinsi..."
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('hospital_address') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Klinis --}}
                <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                    <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                            <i class="fas fa-notes-medical text-sm"></i>
                        </div>
                        <h3 class="font-semibold text-black dark:text-white">Informasi Klinis</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">
                                Diagnosis <span class="text-red-500">*</span>
                            </label>
                            <textarea name="diagnosis" rows="3" required
                                placeholder="Diagnosis klinis pasien..."
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('diagnosis') }}</textarea>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">
                                Alasan Rujukan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="reason" rows="3" required
                                placeholder="Alasan pasien perlu dirujuk ke rumah sakit..."
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('reason') }}</textarea>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">
                                Catatan Tambahan
                            </label>
                            <textarea name="notes" rows="2"
                                placeholder="Informasi tambahan (obat yang sedang dikonsumsi, kondisi khusus, dll)..."
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Right: Type + Status + Submit --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- Tipe Rujukan --}}
                <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                    <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-orange-100 text-orange-500">
                            <i class="fas fa-tag text-sm"></i>
                        </div>
                        <h3 class="font-semibold text-black dark:text-white">Tipe & Status</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Tipe Rujukan <span class="text-red-500">*</span>
                            </label>
                            <div class="space-y-2">
                                <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-stroke p-4 transition hover:border-primary has-[:checked]:border-blue-400 has-[:checked]:bg-blue-50 dark:border-strokedark dark:has-[:checked]:bg-blue-900/20">
                                    <input type="radio" name="referral_type" value="regular"
                                        {{ old('referral_type', 'regular') == 'regular' ? 'checked' : '' }}
                                        class="accent-blue-500 mt-0.5" />
                                    <div>
                                        <p class="font-medium text-sm text-black dark:text-white">📅 Reguler</p>
                                        <p class="text-xs text-gray-400">Rujukan terencana, tidak mendesak</p>
                                    </div>
                                </label>
                                <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-stroke p-4 transition hover:border-red-400 has-[:checked]:border-red-400 has-[:checked]:bg-red-50 dark:border-strokedark dark:has-[:checked]:bg-red-900/20">
                                    <input type="radio" name="referral_type" value="emergency"
                                        {{ old('referral_type') == 'emergency' ? 'checked' : '' }}
                                        class="accent-red-500 mt-0.5" />
                                    <div>
                                        <p class="font-medium text-sm text-red-600">🚨 Darurat</p>
                                        <p class="text-xs text-gray-400">Perlu penanganan segera</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">
                                Status Rujukan
                            </label>
                            <select name="status"
                                class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                <option value="pending"  {{ old('status', 'pending') == 'pending'  ? 'selected' : '' }}>⏳ Menunggu</option>
                                <option value="sent"     {{ old('status') == 'sent'     ? 'selected' : '' }}>📤 Sudah Dikirim</option>
                                <option value="received" {{ old('status') == 'received' ? 'selected' : '' }}>✅ Diterima RS</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="rounded-xl border border-blue-200 bg-blue-50 p-5 dark:bg-blue-900/20 dark:border-blue-800">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                        <div class="text-xs text-blue-700 dark:text-blue-300 space-y-1">
                            <p class="font-semibold">Panduan Surat Rujukan</p>
                            <p>Surat rujukan akan tersimpan di sistem dan dapat dicetak kapan saja.</p>
                            <p>Pastikan diagnosis dan alasan rujukan terisi dengan lengkap dan akurat.</p>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                    <i class="fas fa-paper-plane"></i> Buat Surat Rujukan
                </button>
            </div>

        </div>
    </form>
</div>
</x-admin-layout>
