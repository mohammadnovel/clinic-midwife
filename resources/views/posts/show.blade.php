<x-admin-layout>
<div class="mx-auto max-w-3xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-bold text-black dark:text-white"><i class="fas fa-eye mr-2 text-primary"></i>Preview Artikel</h2>
        <div class="flex gap-2">
            <a href="{{ route('posts.edit', $post->id) }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
                <i class="fas fa-edit text-primary"></i> Edit
            </a>
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-stroke bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-50 dark:bg-meta-4 dark:text-white dark:border-strokedark shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="rounded-xl border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark overflow-hidden">
        @if($post->thumbnail)
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
        @else
            <div class="w-full h-48 bg-gradient-to-br from-primary/10 to-secondary/10 flex items-center justify-center">
                <i class="fas fa-newspaper text-5xl text-primary/30"></i>
            </div>
        @endif

        <div class="p-6 md:p-8">
            <!-- Meta -->
            <div class="flex flex-wrap items-center gap-3 mb-4">
                @if($post->status === 'published')
                    <span class="inline-block rounded-full bg-green-100 text-green-700 text-xs px-3 py-1 font-semibold">Published</span>
                @else
                    <span class="inline-block rounded-full bg-yellow-100 text-yellow-700 text-xs px-3 py-1 font-semibold">Draft</span>
                @endif
                @if($post->category)
                    <span class="inline-block rounded-full bg-primary/10 text-primary text-xs px-3 py-1 font-medium">{{ $post->category->name }}</span>
                @endif
                <span class="text-xs text-gray-400"><i class="fas fa-clock mr-1"></i>{{ $post->reading_time }} menit baca</span>
            </div>

            <h1 class="text-2xl font-bold text-black dark:text-white mb-3">{{ $post->title }}</h1>

            @if($post->excerpt)
            <p class="text-gray-500 text-sm italic border-l-4 border-primary/30 pl-4 mb-5">{{ $post->excerpt }}</p>
            @endif

            <div class="flex items-center gap-3 mb-6 pb-6 border-b border-stroke dark:border-strokedark text-sm text-gray-500">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center"><i class="fas fa-user text-primary text-xs"></i></div>
                    <span>{{ $post->author?->name ?? 'Admin' }}</span>
                </div>
                <span>•</span>
                <span><i class="fas fa-calendar mr-1"></i>{{ $post->created_at->translatedFormat('d F Y') }}</span>
                @if($post->published_at)
                <span>•</span>
                <span><i class="fas fa-rss mr-1 text-green-500"></i>Published {{ $post->published_at->diffForHumans() }}</span>
                @endif
            </div>

            <!-- Content -->
            <div class="prose prose-sm max-w-none text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $post->content }}</div>
        </div>
    </div>
</div>
</x-admin-layout>
