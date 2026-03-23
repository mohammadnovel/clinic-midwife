<x-admin-layout>
    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white">
                <i class="fas fa-ambulance mr-2 text-red-500"></i>Surat Rujukan
            </h2>
            <p class="text-sm text-gray-500 mt-1">Manajemen rujukan pasien ke rumah sakit.</p>
        </div>
        <a href="{{ route('referrals.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white hover:bg-opacity-90 transition shadow-sm">
            <i class="fas fa-plus"></i> Buat Rujukan Baru
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 flex items-center gap-3 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700 dark:bg-green-900/20 dark:border-green-800 dark:text-green-400">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    {{-- Stats --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        @php
            $col = $referrals->getCollection();
            $statusCounts = [
                'total'    => $referrals->total(),
                'pending'  => $col->where('status','pending')->count(),
                'sent'     => $col->where('status','sent')->count(),
                'received' => $col->where('status','received')->count(),
            ];
        @endphp
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark">
            <p class="text-xs text-gray-500">Total Rujukan</p>
            <p class="text-2xl font-bold text-black dark:text-white mt-1">{{ $statusCounts['total'] }}</p>
        </div>
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark">
            <p class="text-xs text-gray-500">Menunggu</p>
            <p class="text-2xl font-bold text-yellow-500 mt-1">{{ $statusCounts['pending'] }}</p>
        </div>
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark">
            <p class="text-xs text-gray-500">Dikirim</p>
            <p class="text-2xl font-bold text-blue-500 mt-1">{{ $statusCounts['sent'] }}</p>
        </div>
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark">
            <p class="text-xs text-gray-500">Diterima RS</p>
            <p class="text-2xl font-bold text-green-600 mt-1">{{ $statusCounts['received'] }}</p>
        </div>
    </div>

    {{-- Table --}}
    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark overflow-hidden">
        <div class="overflow-x-auto">
            <table id="referralTable" class="w-full text-sm">
                <thead>
                    <tr class="border-b border-stroke dark:border-strokedark bg-gray-50 dark:bg-gray-800/50">
                        <th class="py-3.5 px-5 text-left font-semibold text-gray-600 dark:text-gray-300">Pasien</th>
                        <th class="py-3.5 px-5 text-left font-semibold text-gray-600 dark:text-gray-300">Rumah Sakit Tujuan</th>
                        <th class="py-3.5 px-5 text-left font-semibold text-gray-600 dark:text-gray-300">Tanggal</th>
                        <th class="py-3.5 px-5 text-center font-semibold text-gray-600 dark:text-gray-300">Tipe</th>
                        <th class="py-3.5 px-5 text-center font-semibold text-gray-600 dark:text-gray-300">Status</th>
                        <th class="py-3.5 px-5 text-center font-semibold text-gray-600 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stroke dark:divide-strokedark">
                    @forelse($referrals as $ref)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition">
                        <td class="py-4 px-5">
                            <p class="font-medium text-black dark:text-white">{{ $ref->patient->name }}</p>
                            <p class="text-xs text-gray-400">{{ $ref->patient->nik }}</p>
                        </td>
                        <td class="py-4 px-5">
                            <p class="font-medium text-black dark:text-white">{{ $ref->hospital_name }}</p>
                            @if($ref->hospital_address)
                            <p class="text-xs text-gray-400 truncate max-w-[200px]">{{ $ref->hospital_address }}</p>
                            @endif
                        </td>
                        <td class="py-4 px-5 text-gray-600 dark:text-gray-300">
                            {{ $ref->referral_date->format('d M Y') }}
                        </td>
                        <td class="py-4 px-5 text-center">
                            @if($ref->referral_type === 'emergency')
                            <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                <i class="fas fa-exclamation-triangle text-[10px]"></i> DARURAT
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                <i class="fas fa-calendar text-[10px]"></i> Reguler
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-5 text-center">
                            @php
                                $statusClass = match($ref->status) {
                                    'pending'  => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                                    'sent'     => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                    'received' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                    default    => 'bg-gray-100 text-gray-600',
                                };
                                $statusLabel = match($ref->status) {
                                    'pending'  => 'Menunggu',
                                    'sent'     => 'Dikirim',
                                    'received' => 'Diterima',
                                    default    => $ref->status,
                                };
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                        <td class="py-4 px-5">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('referrals.show', $ref) }}"
                                    class="rounded-lg p-2 text-blue-500 hover:bg-blue-50 transition" title="Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                <a href="{{ route('referrals.edit', $ref) }}"
                                    class="rounded-lg p-2 text-primary hover:bg-primary/10 transition" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <form action="{{ route('referrals.destroy', $ref) }}" method="POST"
                                    onsubmit="return confirm('Hapus data rujukan ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="rounded-lg p-2 text-red-400 hover:bg-red-50 transition" title="Hapus">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-16 text-center text-gray-400">
                            <i class="fas fa-ambulance text-4xl opacity-20 mb-3 block"></i>
                            Belum ada data rujukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $referrals->links() }}
    </div>

    <script>
        $(document).ready(function () {
            $('#referralTable').DataTable({ paging: false, info: false, searching: true, language: { search: "Cari:" } });
        });
    </script>
</x-admin-layout>
