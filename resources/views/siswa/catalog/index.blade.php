<x-layouts.app title="Katalog Buku">
    <h1 class="text-2xl font-bold mb-6">Katalog Buku</h1>

    <form method="GET" class="flex flex-wrap gap-3 mb-6">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="cari judul atau pengarang..."
            class="flex-1 min-w-[200px] border border-slate-300 rounded-lg px-3 py-2 text-sm">
        <select name="category_id" class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <button class="border border-slate-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-slate-50">Cari</button>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($books as $book)
            <a href="{{ route('siswa.catalog.show', $book) }}" class="anim-card bg-white rounded-xl border border-slate-200 p-4">
                <img src="{{ $book->cover_url }}" alt="Sampul {{ $book->title }}" loading="lazy" class="w-full h-48 object-cover rounded-lg mb-3">
                <p class="text-xs text-slate-400 mb-1">{{ $book->category->name }}</p>
                <h3 class="font-semibold mb-1">{{ $book->title }}</h3>
                <p class="text-sm text-slate-500 mb-3">{{ $book->author }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-xs border rounded-full px-2 py-0.5 {{ $book->status === 'tersedia' ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-red-50 text-red-600 border-red-200' }}">
                        {{ $book->status === 'tersedia' ? 'Tersedia' : ucfirst($book->status) }}
                    </span>
                    <span class="text-xs text-slate-400">Stok: {{ $book->stock }}</span>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-6">{{ $books->links() }}</div>
</x-layouts.app>