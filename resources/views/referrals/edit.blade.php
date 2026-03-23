<x-admin-layout>
<div class="mx-auto max-w-4xl">

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white">
                <i class="fas fa-edit mr-2 text-primary"></i>Edit Surat Rujukan
            </h2>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('referrals.show', $referral) }}"
                class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
                <i class="fas fa-eye"></i> Lihat
            </a>
            <a href="{{ route('referrals.index') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4">
        <ul class="list-disc pl-5 text-sm text-red-600">
            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('referrals.update', $referral) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

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
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">Pasien <span class="text-red-500">*</span></label>
                            <select name="patient_id" required class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                @foreach($patients as $p)
                                <option value="{{ $p->id }}" {{ $referral->patient_id == $p->id ? 'selected' : '' }}>{{ $p->name }} — NIK {{ $p->nik }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Bidan Perujuk</label>
                                <select name="referred_by" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                    <option value="">-- Pilih Bidan --</option>
                                    @foreach($midwives as $m)
                                    <option value="{{ $m->id }}" {{ $referral->referred_by == $m->id ? 'selected' : '' }}>{{ $m->user->name ?? 'Bidan' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-black dark:text-white">Tgl Rujukan <span class="text-red-500">*</span></label>
                                <input type="date" name="referral_date" value="{{ old('referral_date', $referral->referral_date->format('Y-m-d')) }}" required class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RS Tujuan --}}
                <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                    <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-red-100 text-red-500"><i class="fas fa-hospital text-sm"></i></div>
                        <h3 class="font-semibold text-black dark:text-white">Rumah Sakit Tujuan</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">Nama RS <span class="text-red-500">*</span></label>
                            <input type="text" name="hospital_name" value="{{ old('hospital_name', $referral->hospital_name) }}" required class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">Alamat RS</label>
                            <textarea name="hospital_address" rows="2" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('hospital_address', $referral->hospital_address) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Klinis --}}
                <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                    <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-blue-600"><i class="fas fa-notes-medical text-sm"></i></div>
                        <h3 class="font-semibold text-black dark:text-white">Informasi Klinis</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">Diagnosis <span class="text-red-500">*</span></label>
                            <textarea name="diagnosis" rows="3" required class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('diagnosis', $referral->diagnosis) }}</textarea>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">Alasan Rujukan <span class="text-red-500">*</span></label>
                            <textarea name="reason" rows="3" required class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('reason', $referral->reason) }}</textarea>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">Catatan Tambahan</label>
                            <textarea name="notes" rows="2" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ old('notes', $referral->notes) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
                    <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-orange-100 text-orange-500"><i class="fas fa-tag text-sm"></i></div>
                        <h3 class="font-semibold text-black dark:text-white">Tipe & Status</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">Tipe Rujukan</label>
                            <div class="space-y-2">
                                <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-stroke p-3 transition has-[:checked]:border-blue-400 has-[:checked]:bg-blue-50 dark:border-strokedark dark:has-[:checked]:bg-blue-900/20">
                                    <input type="radio" name="referral_type" value="regular" {{ $referral->referral_type == 'regular' ? 'checked' : '' }} class="accent-blue-500" />
                                    <span class="text-sm font-medium text-black dark:text-white">📅 Reguler</span>
                                </label>
                                <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-stroke p-3 transition has-[:checked]:border-red-400 has-[:checked]:bg-red-50 dark:border-strokedark dark:has-[:checked]:bg-red-900/20">
                                    <input type="radio" name="referral_type" value="emergency" {{ $referral->referral_type == 'emergency' ? 'checked' : '' }} class="accent-red-500" />
                                    <span class="text-sm font-medium text-red-600">🚨 Darurat</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-black dark:text-white">Status Rujukan</label>
                            <select name="status" class="w-full rounded-lg border border-stroke bg-transparent py-3 px-4 text-sm outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                <option value="pending"  {{ $referral->status == 'pending'  ? 'selected' : '' }}>⏳ Menunggu</option>
                                <option value="sent"     {{ $referral->status == 'sent'     ? 'selected' : '' }}>📤 Sudah Dikirim</option>
                                <option value="received" {{ $referral->status == 'received' ? 'selected' : '' }}>✅ Diterima RS</option>
                            </select>
                        </div>
                        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-3.5 text-sm font-semibold text-white transition hover:bg-opacity-90 active:scale-95">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
</x-admin-layout>
