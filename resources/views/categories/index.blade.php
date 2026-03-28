<x-admin-layout>
<div class="mx-auto max-w-4xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-tags mr-2 text-primary"></i>Kategori Artikel</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola kategori untuk artikel dan berita klinik.</p>
        </div>
        <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white hover:bg-opacity-90 shadow-sm">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
    </div>

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary"><i class="fas fa-tags text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Daftar Kategori</h3>
        </div>
        <div class="p-6">
            <table id="tbl-categories" class="w-full text-sm">
                <thead>
                    <tr class="border-b border-stroke text-left text-gray-500 dark:border-strokedark">
                        <th class="pb-3 font-semibold">#</th>
                        <th class="pb-3 font-semibold">Nama Kategori</th>
                        <th class="pb-3 font-semibold">Deskripsi</th>
                        <th class="pb-3 font-semibold text-center">Jumlah Artikel</th>
                        <th class="pb-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $i => $cat)
                    <tr class="border-b border-stroke/50 dark:border-strokedark/50 hover:bg-gray-50 dark:hover:bg-meta-4/20">
                        <td class="py-3 text-gray-500">{{ $i + 1 }}</td>
                        <td class="py-3 font-semibold text-black dark:text-white">{{ $cat->name }}</td>
                        <td class="py-3 text-gray-500 max-w-xs truncate">{{ $cat->description ?? '-' }}</td>
                        <td class="py-3 text-center">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-primary/10 text-primary text-xs font-bold">{{ $cat->posts_count }}</span>
                        </td>
                        <td class="py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('categories.edit', $cat->id) }}" class="inline-flex items-center gap-1 rounded-lg border border-stroke px-3 py-1.5 text-xs font-medium hover:bg-gray-50 dark:border-strokedark dark:hover:bg-meta-4">
                                    <i class="fas fa-edit text-primary"></i> Edit
                                </a>
                                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" data-confirm="Hapus kategori '{{ $cat->name }}'?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-red-200 px-3 py-1.5 text-xs font-medium text-red-500 hover:bg-red-50">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="py-10 text-center text-gray-400"><i class="fas fa-tags text-3xl mb-2 block opacity-30"></i>Belum ada kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        if ($('#tbl-categories tbody tr').length > 5) {
            $('#tbl-categories').DataTable({ language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' } });
        }
    });
</script>
</x-admin-layout>
