<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel & Berita - Klinik Bidan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: { extend: { colors: { primary: '#3C50E0', secondary: '#80CAEE' } } }
        }
    </script>
    <style>
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold text-primary">
                <i class="fas fa-heartbeat"></i> Klinik Bidan
            </a>
            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary transition-colors">Beranda</a>
                <a href="{{ route('blog.index') }}" class="text-primary font-semibold">Blog</a>
                @auth
                <a href="{{ route('dashboard') }}" class="bg-primary text-white px-4 py-1.5 rounded-lg hover:bg-opacity-90 transition">Dashboard</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="bg-gradient-to-br from-primary to-blue-700 text-white py-16">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <div data-aos="fade-up">
                <span class="inline-block bg-white/20 text-white text-xs font-semibold px-4 py-1.5 rounded-full mb-4 uppercase tracking-wide">Artikel & Berita</span>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Informasi Kesehatan Terkini</h1>
                <p class="text-white/80 text-lg max-w-xl mx-auto">Tips, berita, dan panduan kesehatan dari tim profesional Klinik Bidan kami.</p>
            </div>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">

            <!-- Posts Grid -->
            <div class="flex-1">
                @if($posts->isEmpty())
                    <div class="text-center py-20 text-gray-400">
                        <i class="fas fa-newspaper text-5xl mb-4 block opacity-30"></i>
                        <p>Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($posts as $i => $post)
                        <article data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 80 }}"
                            class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow group">
                            <a href="{{ route('blog.show', $post->slug) }}">
                                @if($post->thumbnail)
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-primary/10 to-secondary/20 flex items-center justify-center">
                                        <i class="fas fa-newspaper text-4xl text-primary/30"></i>
                                    </div>
                                @endif
                            </a>
                            <div class="p-5">
                                <div class="flex items-center gap-2 mb-3">
                                    @if($post->category)
                                        <span class="bg-primary/10 text-primary text-xs px-2.5 py-0.5 rounded-full font-medium">{{ $post->category->name }}</span>
                                    @endif
                                    <span class="text-xs text-gray-400"><i class="fas fa-clock mr-1"></i>{{ $post->reading_time }} mnt</span>
                                </div>
                                <h2 class="font-bold text-gray-900 text-base mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                                    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h2>
                                @if($post->excerpt)
                                    <p class="text-gray-500 text-sm line-clamp-3 mb-4">{{ $post->excerpt }}</p>
                                @endif
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-xs text-gray-400">
                                        <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center"><i class="fas fa-user text-primary" style="font-size:9px"></i></div>
                                        {{ $post->author?->name ?? 'Admin' }}
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $post->published_at?->format('d M Y') }}</span>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="lg:w-72 space-y-6" data-aos="fade-left">
                <!-- Categories -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-tags text-primary"></i> Kategori
                    </h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('blog.index') }}" class="flex items-center justify-between text-sm text-gray-600 hover:text-primary transition-colors py-1">
                                <span>Semua Artikel</span>
                                <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded-full">{{ $posts->total() }}</span>
                            </a>
                        </li>
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('blog.index') }}?category={{ $cat->id }}" class="flex items-center justify-between text-sm text-gray-600 hover:text-primary transition-colors py-1">
                                <span>{{ $cat->name }}</span>
                                <span class="bg-primary/10 text-primary text-xs px-2 py-0.5 rounded-full">{{ $cat->posts_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Recent Posts -->
                @if($posts->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-fire text-orange-500"></i> Terbaru
                    </h3>
                    <ul class="space-y-4">
                        @foreach($posts->take(4) as $rp)
                        <li>
                            <a href="{{ route('blog.show', $rp->slug) }}" class="flex gap-3 group">
                                @if($rp->thumbnail)
                                    <img src="{{ asset('storage/' . $rp->thumbnail) }}" class="w-14 h-14 rounded-lg object-cover flex-shrink-0">
                                @else
                                    <div class="w-14 h-14 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0"><i class="fas fa-newspaper text-primary/40"></i></div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-gray-800 group-hover:text-primary transition-colors line-clamp-2">{{ $rp->title }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $rp->published_at?->format('d M Y') }}</p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </aside>

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-8">
        <div class="max-w-6xl mx-auto px-4 text-center text-sm text-gray-400">
            <p>© {{ date('Y') }} Klinik Bidan. Semua hak dilindungi.</p>
            <a href="{{ route('home') }}" class="text-primary hover:underline mt-1 inline-block">← Kembali ke Beranda</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>AOS.init({ duration: 600, easing: 'ease-out-cubic', once: true, offset: 60 });</script>
</body>
</html>
