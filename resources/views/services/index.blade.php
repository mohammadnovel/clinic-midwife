<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-black dark:text-white">Data Layanan</h2>
        <a href="{{ route('services.create') }}"
            class="inline-flex items-center justify-center rounded-md bg-primary px-6 py-2.5 text-center font-medium text-white hover:bg-opacity-90">
            <i class="fas fa-plus mr-2"></i> Tambah Layanan
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div
        class="rounded-sm border border-gray-200 bg-white px-5 pt-6 pb-2.5 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:px-7.5 xl:pb-1">
        <div class="max-w-full overflow-x-auto p-4">
            <table id="dataTable" class="w-full table-auto display">
                <thead>
                    <tr class="bg-gray-200 text-left dark:bg-gray-700">
                        <th class="py-4 px-4 font-medium text-black dark:text-white">Kode</th>
                        <th class="py-4 px-4 font-medium text-black dark:text-white">Nama Layanan</th>
                        <th class="py-4 px-4 font-medium text-black dark:text-white">Kategori</th>
                        <th class="py-4 px-4 font-medium text-black dark:text-white">Harga</th>
                        <th class="py-4 px-4 font-medium text-black dark:text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <p class="text-black dark:text-white font-mono">{{ $service->code }}</p>
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <h5 class="font-medium text-black dark:text-white">{{ $service->name }}</h5>
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <span
                                    class="inline-flex rounded-full bg-blue-100 text-blue-600 py-1 px-3 text-sm font-medium">
                                    {{ $service->category }}
                                </span>
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <p class="text-black dark:text-white">Rp {{ number_format($service->price, 0, ',', '.') }}
                                </p>
                            </td>
                            <td class="border-b border-gray-200 py-5 px-4 dark:border-gray-700">
                                <div class="flex items-center space-x-3.5">
                                    <a href="{{ route('services.edit', $service) }}" class="text-primary hover:underline"><i
                                            class="fas fa-edit"></i> Edit</a>
                                    <form action="{{ route('services.destroy', $service) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus layanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline"><i
                                                class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
</x-admin-layout>