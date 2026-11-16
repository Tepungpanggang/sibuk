<x-layouts.app title="Detail Buku">
    <a href="{{ route('siswa.catalog.index') }}" class="text-sm text-slate-500 hover:underline">← Kembali ke katalog</a>

    <div class="bg-white rounded-xl border border-slate-200 p-6 mt-4 max-w-3xl flex flex-col sm:flex-row gap-6">
        <img src="{{ $book->cover_url }}" alt="Sampul {{ $book->title }}" class="w-40 h-56 object-cover rounded-lg flex-shrink-0 mx-auto sm:mx-0">

        <div class="flex-1 min-w-0">
            <p class="text-xs text-slate-400 mb-1">{{ $book->category->name }} • Rak {{ $book->shelf->code }}</p>
            <h1 class="text-2xl font-bold mb-1">{{ $book->title }}</h1>
            <p class="text-slate-500 mb-4">{{ $book->author }}</p>

            <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                <div><span class="text-slate-400">ISBN:</span> {{ $book->isbn ?? '-' }}</div>
                <div><span class="text-slate-400">Tahun Terbit:</span> {{ $book->published_year ?? '-' }}</div>
                <div><span class="text-slate-400">Penerbit:</span> {{ $book->publisher ?? '-' }}</div>
                <div><span class="text-slate-400">Stok:</span> {{ $book->stock }}</div>
            </div>

            @if($book->description)
                <p class="text-sm text-slate-600 mb-6">{{ $book->description }}</p>
            @endif

            <span class="inline-block text-xs border rounded-full px-2 py-0.5 mb-4 {{ $book->status === 'tersedia' ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-red-50 text-red-600 border-red-200' }}">
                {{ $book->status === 'tersedia' ? 'Tersedia' : ucfirst($book->status) }}
            </span>

            <form method="POST" action="{{ route('siswa.loans.store', $book) }}">
                @csrf
                <button type="submit" @disabled($book->status !== 'tersedia' || $book->stock < 1)
                    class="bg-slate-900 text-white rounded-lg px-5 py-2 text-sm font-semibold hover:bg-slate-800 disabled:opacity-40 disabled:cursor-not-allowed">
                    Ajukan Peminjaman
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
