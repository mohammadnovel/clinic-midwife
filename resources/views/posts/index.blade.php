<x-admin-layout>
<div class="mx-auto max-w-6xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-newspaper mr-2 text-primary"></i>Artikel & Berita</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola konten artikel dan berita kesehatan klinik.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
                <i class="fas fa-tags text-primary"></i> Kategori
            </a>
            <a href="{{ route('posts.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white hover:bg-opacity-90 shadow-sm">
                <i class="fas fa-plus"></i> Tulis Artikel
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        @php
            $total     = $posts->count();
            $published = $posts->where('status','published')->count();
            $draft     = $posts->where('status','draft')->count();
        @endphp
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark">
            <p class="text-xs text-gray-500 mb-1">Total Artikel</p>
            <p class="text-2xl font-bold text-black dark:text-white">{{ $total }}</p>
        </div>
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark">
            <p class="text-xs text-gray-500 mb-1">Published</p>
            <p class="text-2xl font-bold text-green-600">{{ $published }}</p>
        </div>
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark">
            <p class="text-xs text-gray-500 mb-1">Draft</p>
            <p class="text-2xl font-bold text-yellow-500">{{ $draft }}</p>
        </div>
        <div class="rounded-xl border border-stroke bg-white p-4 shadow-sm dark:border-strokedark dark:bg-boxdark">
            <p class="text-xs text-gray-500 mb-1">Kategori</p>
            <p class="text-2xl font-bold text-primary">{{ \App\Models\Category::count() }}</p>
        </div>
    </div>

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
        <div class="flex items-center gap-3 border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary"><i class="fas fa-newspaper text-sm"></i></div>
            <h3 class="font-semibold text-black dark:text-white">Daftar Artikel</h3>
        </div>
        <div class="p-6">
            <table id="tbl-posts" class="w-full text-sm">
                <thead>
                    <tr class="border-b border-stroke text-left text-gray-500 dark:border-strokedark">
                        <th class="pb-3 font-semibold">Thumbnail</th>
                        <th class="pb-3 font-semibold">Judul</th>
                        <th class="pb-3 font-semibold">Kategori</th>
                        <th class="pb-3 font-semibold">Penulis</th>
                        <th class="pb-3 font-semibold text-center">Status</th>
                        <th class="pb-3 font-semibold">Tanggal</th>
                        <th class="pb-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr class="border-b border-stroke/50 dark:border-strokedark/50 hover:bg-gray-50 dark:hover:bg-meta-4/20">
                        <td class="py-3">
                            @if($post->thumbnail)
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-14 h-10 object-cover rounded-lg">
                            @else
                                <div class="w-14 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-300">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-3 max-w-xs">
                            <p class="font-semibold text-black dark:text-white line-clamp-1">{{ $post->title }}</p>
                            <p class="text-xs text-gray-400 line-clamp-1">{{ $post->excerpt }}</p>
                        </td>
                        <td class="py-3">
                            @if($post->category)
                                <span class="inline-block rounded-full bg-primary/10 text-primary text-xs px-2 py-0.5 font-medium">{{ $post->category->name }}</span>
                            @else
                                <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="py-3 text-gray-600 dark:text-gray-300">{{ $post->author?->name ?? '—' }}</td>
                        <td class="py-3 text-center">
                            @if($post->status === 'published')
                                <span class="inline-block rounded-full bg-green-100 text-green-700 text-xs px-2.5 py-0.5 font-semibold">Published</span>
                            @else
                                <span class="inline-block rounded-full bg-yellow-100 text-yellow-700 text-xs px-2.5 py-0.5 font-semibold">Draft</span>
                            @endif
                        </td>
                        <td class="py-3 text-gray-500 text-xs">{{ $post->created_at->format('d M Y') }}</td>
                        <td class="py-3 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('posts.show', $post->id) }}" class="inline-flex items-center gap-1 rounded-lg border border-stroke px-2.5 py-1.5 text-xs hover:bg-gray-50 dark:border-strokedark">
                                    <i class="fas fa-eye text-blue-500"></i>
                                </a>
                                <a href="{{ route('posts.edit', $post->id) }}" class="inline-flex items-center gap-1 rounded-lg border border-stroke px-2.5 py-1.5 text-xs hover:bg-gray-50 dark:border-strokedark">
                                    <i class="fas fa-edit text-primary"></i>
                                </a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" data-confirm="Hapus artikel '{{ addslashes($post->title) }}'?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-red-200 px-2.5 py-1.5 text-xs text-red-500 hover:bg-red-50">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="py-10 text-center text-gray-400"><i class="fas fa-newspaper text-3xl mb-2 block opacity-30"></i>Belum ada artikel.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tbl-posts').DataTable({
            order: [[5, 'desc']],
            language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' }
        });
    });
</script>
</x-admin-layout>
