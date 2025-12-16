<x-admin-layout>
    <div class="p-6 bg-white rounded-lg shadow-sm border border-gray-200">
        <h2 class="text-2xl font-bold mb-4">{{ $title ?? 'Module' }}</h2>
        <div class="p-4 bg-yellow-50 text-yellow-800 rounded border border-yellow-200">
            <i class="fas fa-hammer mr-2"></i> Modul ini sedang dalam pengembangan tahap lanjut.
        </div>

        <div class="mt-4">
            <p class="mb-4 text-gray-600">Fitur CRUD untuk modul ini sudah disiapkan controller dan routingnya. Silakan
                kembangkan view sesuai kebutuhan spesifik.</p>

            <a href="{{ route('dashboard') }}" class="text-primary hover:underline">Kembali ke Dashboard</a>
        </div>
    </div>
</x-admin-layout>