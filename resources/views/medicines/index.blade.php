<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-black dark:text-white">Data Obat & Stok</h2>
        <a href="#"
            class="inline-flex items-center justify-center rounded-md bg-primary px-6 py-2.5 text-center font-medium text-white hover:bg-opacity-90">
            <i class="fas fa-plus mr-2"></i> Tambah Obat
        </a>
    </div>

    <div
        class="rounded-sm border border-gray-200 bg-white px-5 pt-6 pb-2.5 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:px-7.5 xl:pb-1">
        <div class="max-w-full overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-left dark:bg-gray-700">
                        <th class="min-w-[120px] py-4 px-4 font-medium text-black dark:text-white">Kode</th>
                        <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white">Nama Obat</th>
                        <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">Jenis / Satuan</th>
                        <th class="min-w-[120px] py-4 px-4 font-medium text-black dark:text-white">Harga</th>
                        <th class="min-w-[120px] py-4 px-4 font-medium text-black dark:text-white">Stok</th>
                        <th class="py-4 px-4 font-medium text-black dark:text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicines as $medicine)
                        <tr>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <p class="text-black dark:text-white font-mono">{{ $medicine->code }}</p>
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <h5 class="font-medium text-black dark:text-white">{{ $medicine->name }}</h5>
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <p class="text-sm text-black dark:text-white">{{ $medicine->type }} ({{ $medicine->unit }})
                                </p>
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <p class="text-black dark:text-white">Rp {{ number_format($medicine->price, 0, ',', '.') }}
                                </p>
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                @if($medicine->stock <= $medicine->min_stock)
                                    <span
                                        class="inline-flex rounded-full bg-red-100 text-red-600 py-1 px-3 text-sm font-medium">
                                        {{ $medicine->stock }} (Low)
                                    </span>
                                @else
                                    <span
                                        class="inline-flex rounded-full bg-green-100 text-green-600 py-1 px-3 text-sm font-medium">
                                        {{ $medicine->stock }}
                                    </span>
                                @endif
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <div class="flex items-center space-x-3.5">
                                    <a href="#" class="hover:text-primary"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="hover:text-red-500"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 pb-4">
            {{ $medicines->links() }}
        </div>
    </div>
</x-admin-layout>