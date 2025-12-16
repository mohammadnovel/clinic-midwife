<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-black dark:text-white">Jadwal & Antrian</h2>
        <a href="{{ route('appointments.create') }}"
            class="inline-flex items-center justify-center rounded-md bg-primary px-6 py-2.5 text-center font-medium text-white hover:bg-opacity-90">
            <i class="fas fa-plus mr-2"></i> Buat Antrian Baru
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div
        class="rounded-sm border border-gray-200 bg-white px-5 pt-6 pb-2.5 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:px-7.5 xl:pb-1">
        <div class="max-w-full overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-left dark:bg-gray-700">
                        <th class="py-4 px-4 font-medium text-black dark:text-white">No. Antrian</th>
                        <th class="py-4 px-4 font-medium text-black dark:text-white">Waktu</th>
                        <th class="py-4 px-4 font-medium text-black dark:text-white">Pasien</th>
                        <th class="py-4 px-4 font-medium text-black dark:text-white">Bidan</th>
                        <th class="py-4 px-4 font-medium text-black dark:text-white">Layanan</th>
                        <th class="py-4 px-4 font-medium text-black dark:text-white">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $app)
                        <tr>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <h5 class="text-xl font-bold text-primary">{{ $app->queue_number }}</h5>
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <p class="text-black dark:text-white">{{ $app->appointment_date->format('d M Y H:i') }}</p>
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <h5 class="font-medium text-black dark:text-white">{{ $app->patient->name }}</h5>
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <p class="text-black dark:text-white">{{ $app->midwife->user->name ?? '-' }}</p>
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <span
                                    class="inline-block rounded bg-gray-100 px-2.5 py-0.5 text-sm font-medium text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                    {{ $app->service_category }}
                                </span>
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                @php
                                    $colors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'confirmed' => 'bg-blue-100 text-blue-800',
                                        'in_progress' => 'bg-purple-100 text-purple-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800'
                                    ];
                                    $color = $colors[$app->status] ?? 'bg-gray-100 text-gray-800';
                                 @endphp
                                <span class="inline-flex rounded-full {{ $color }} py-1 px-3 text-sm font-medium">
                                    {{ ucfirst(str_replace('_', ' ', $app->status)) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 pb-4">
            {{ $appointments->links() }}
        </div>
    </div>
</x-admin-layout>