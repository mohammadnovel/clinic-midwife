<x-admin-layout>
<div class="mx-auto max-w-3xl">

    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white">
                <i class="fas fa-file-medical mr-2 text-primary"></i>Detail Surat Rujukan
            </h2>
        </div>
        <div class="flex gap-2">
            <button onclick="window.print()"
                class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white hover:bg-opacity-90 transition">
                <i class="fas fa-print"></i> Cetak
            </button>
            <a href="{{ route('referrals.edit', $referral) }}"
                class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('referrals.index') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    {{-- Referral Document --}}
    <div id="referral-print" class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">

        {{-- Letterhead --}}
        <div class="border-b-4 border-primary px-8 py-6">
            <div class="flex items-start justify-between">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-heartbeat text-primary text-2xl"></i>
                        <div>
                            <p class="text-xl font-bold text-black dark:text-white">Klinik Bidan</p>
                            <p class="text-xs text-gray-500">Fasilitas Kesehatan Primer</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Jl. Kesehatan No. 1 | Telp: (021) 000-0000</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400 uppercase tracking-wider">Surat Rujukan</p>
                    <p class="text-sm font-mono font-bold text-primary">REF-{{ str_pad($referral->id, 8, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $referral->referral_date->format('d F Y') }}</p>
                    @if($referral->referral_type === 'emergency')
                    <span class="mt-1 inline-flex items-center gap-1 rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                        🚨 RUJUKAN DARURAT
                    </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="px-8 py-6 space-y-6">

            {{-- Intro --}}
            <p class="text-sm text-gray-600 dark:text-gray-300">
                Dengan hormat, kami merujuk pasien berikut kepada Yth. Dokter Spesialis / Dokter Jaga di:
            </p>

            {{-- Hospital Info --}}
            <div class="rounded-xl border-2 border-dashed border-primary/30 bg-primary/5 p-5">
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-2">Fasilitas Tujuan</p>
                <p class="text-xl font-bold text-primary">{{ $referral->hospital_name }}</p>
                @if($referral->hospital_address)
                <p class="text-sm text-gray-500 mt-1">{{ $referral->hospital_address }}</p>
                @endif
            </div>

            {{-- Patient Info --}}
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-3">Data Pasien</p>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Nama Lengkap</p>
                        <p class="font-semibold text-black dark:text-white">{{ $referral->patient->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">NIK</p>
                        <p class="font-mono font-semibold text-black dark:text-white">{{ $referral->patient->nik }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Tanggal Lahir</p>
                        <p class="font-semibold text-black dark:text-white">
                            {{ \Carbon\Carbon::parse($referral->patient->date_of_birth)->format('d M Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500">No. Telepon</p>
                        <p class="font-semibold text-black dark:text-white">{{ $referral->patient->phone ?? '-' }}</p>
                    </div>
                    @if($referral->patient->bpjs_number)
                    <div>
                        <p class="text-gray-500">No. BPJS</p>
                        <p class="font-mono font-semibold text-black dark:text-white">{{ $referral->patient->bpjs_number }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Clinical Info --}}
            <div class="space-y-4">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-2">Diagnosis</p>
                    <div class="rounded-lg border border-stroke p-4 text-sm text-black dark:border-strokedark dark:text-white bg-gray-50 dark:bg-gray-800/30">
                        {{ $referral->diagnosis }}
                    </div>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-2">Alasan Rujukan</p>
                    <div class="rounded-lg border border-stroke p-4 text-sm text-black dark:border-strokedark dark:text-white bg-gray-50 dark:bg-gray-800/30">
                        {{ $referral->reason }}
                    </div>
                </div>
                @if($referral->notes)
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-2">Catatan Tambahan</p>
                    <div class="rounded-lg border border-stroke p-4 text-sm text-gray-600 dark:border-strokedark dark:text-gray-300 bg-gray-50 dark:bg-gray-800/30">
                        {{ $referral->notes }}
                    </div>
                </div>
                @endif
            </div>

            {{-- Signature + Status --}}
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-6 pt-4 border-t border-stroke dark:border-strokedark">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-2">Status Saat Ini</p>
                    @php
                        $statusClass = match($referral->status) {
                            'pending'  => 'bg-yellow-100 text-yellow-700',
                            'sent'     => 'bg-blue-100 text-blue-700',
                            'received' => 'bg-green-100 text-green-700',
                            default    => 'bg-gray-100 text-gray-600',
                        };
                        $statusLabel = match($referral->status) {
                            'pending'  => '⏳ Menunggu Pengiriman',
                            'sent'     => '📤 Sudah Dikirim',
                            'received' => '✅ Diterima Rumah Sakit',
                            default    => $referral->status,
                        };
                    @endphp
                    <span class="inline-flex items-center rounded-full px-3 py-1.5 text-sm font-semibold {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>
                </div>
                <div class="text-right text-sm">
                    <p class="text-gray-500">Dokter / Bidan Perujuk</p>
                    <p class="font-bold text-black dark:text-white mt-6 border-t border-black dark:border-gray-300 pt-2 px-6">
                        {{ $referral->midwife?->user?->name ?? 'Petugas Klinik' }}
                    </p>
                    <p class="text-xs text-gray-400">SIP: {{ $referral->midwife?->sip_number ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body * { visibility: hidden; }
    #referral-print, #referral-print * { visibility: visible; }
    #referral-print { position: fixed; top: 0; left: 0; width: 100%; }
}
</style>
</x-admin-layout>
