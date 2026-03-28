<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Klinik Bidan</title>
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
        .article-content { line-height: 1.9; }
        .article-content p { margin-bottom: 1rem; }
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
                <a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-primary transition-colors">Blog</a>
                @auth
                <a href="{{ route('dashboard') }}" class="bg-primary text-white px-4 py-1.5 rounded-lg hover:bg-opacity-90 transition">Dashboard</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-10">
        <div class="flex flex-col lg:flex-row gap-8">

            <!-- Article -->
            <article class="flex-1" data-aos="fade-up">
                <!-- Breadcrumb -->
                <nav class="text-sm text-gray-400 mb-6 flex items-center gap-2">
                    <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <a href="{{ route('blog.index') }}" class="hover:text-primary">Blog</a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <span class="text-gray-600 line-clamp-1">{{ $post->title }}</span>
                </nav>

                <!-- Category & Meta -->
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    @if($post->category)
                        <a href="{{ route('blog.index') }}?category={{ $post->category->id }}"
                            class="bg-primary/10 text-primary text-xs font-semibold px-3 py-1 rounded-full hover:bg-primary/20 transition">
                            <i class="fas fa-tag mr-1"></i>{{ $post->category->name }}
                        </a>
                    @endif
                    <span class="text-xs text-gray-400"><i class="fas fa-clock mr-1"></i>{{ $post->reading_time }} menit baca</span>
                    <span class="text-xs text-gray-400"><i class="fas fa-calendar mr-1"></i>{{ $post->published_at?->translatedFormat('d F Y') }}</span>
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-5 leading-tight">{{ $post->title }}</h1>

                <!-- Author -->
                <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-200">
                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                        <i class="fas fa-user text-primary"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ $post->author?->name ?? 'Tim Klinik Bidan' }}</p>
                        <p class="text-xs text-gray-400">Penulis</p>
                    </div>
                </div>

                <!-- Thumbnail -->
                @if($post->thumbnail)
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                        class="w-full rounded-2xl object-cover mb-8 max-h-96">
                @endif

                <!-- Excerpt -->
                @if($post->excerpt)
                    <blockquote class="bg-primary/5 border-l-4 border-primary text-gray-600 italic px-5 py-4 rounded-r-xl mb-6 text-sm leading-relaxed">
                        {{ $post->excerpt }}
                    </blockquote>
                @endif

                <!-- Content -->
                <div class="article-content text-gray-700 text-base whitespace-pre-wrap">{{ $post->content }}</div>

                <!-- Share -->
                <div class="mt-10 pt-6 border-t border-gray-200 flex items-center gap-3">
                    <span class="text-sm text-gray-500 font-medium">Bagikan:</span>
                    <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank"
                        class="inline-flex items-center gap-1.5 text-xs bg-green-100 text-green-700 px-3 py-1.5 rounded-full hover:bg-green-200 transition">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <button onclick="navigator.clipboard.writeText(window.location.href);this.textContent='Tersalin!';setTimeout(()=>this.textContent='Salin Link',2000)"
                        class="inline-flex items-center gap-1.5 text-xs bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full hover:bg-gray-200 transition">
                        <i class="fas fa-link"></i> Salin Link
                    </button>
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="lg:w-72 space-y-6" data-aos="fade-left">
                <!-- Back -->
                <a href="{{ route('blog.index') }}" class="flex items-center gap-2 text-sm text-primary font-medium hover:underline">
                    <i class="fas fa-arrow-left"></i> Semua Artikel
                </a>

                <!-- Related Posts -->
                @if($related->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-bookmark text-primary"></i> Artikel Terkait
                    </h3>
                    <ul class="space-y-4">
                        @foreach($related as $rel)
                        <li>
                            <a href="{{ route('blog.show', $rel->slug) }}" class="flex gap-3 group">
                                @if($rel->thumbnail)
                                    <img src="{{ asset('storage/' . $rel->thumbnail) }}" class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
                                @else
                                    <div class="w-16 h-16 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-newspaper text-primary/40 text-lg"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-gray-800 group-hover:text-primary transition-colors line-clamp-2">{{ $rel->title }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $rel->published_at?->format('d M Y') }}</p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Info Card -->
                <div class="bg-gradient-to-br from-primary to-blue-700 text-white rounded-2xl p-5">
                    <i class="fas fa-heartbeat text-2xl mb-3 block"></i>
                    <h3 class="font-bold text-lg mb-2">Butuh Konsultasi?</h3>
                    <p class="text-white/80 text-sm mb-4">Tim bidan kami siap membantu pertanyaan kesehatan Anda.</p>
                    <a href="{{ route('home') }}#layanan" class="inline-block bg-white text-primary font-semibold text-sm px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        Lihat Layanan
                    </a>
                </div>
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
