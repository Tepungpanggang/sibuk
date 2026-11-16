<x-layouts.app title="Data Buku">
    <div class="flex items-center justify-between flex-wrap gap-3 mb-4">
        <div>
            <h1 class="text-2xl font-bold">Data Buku</h1>
            <p class="text-sm text-slate-500">Total {{ $books->total() }} judul buku terdaftar</p>
        </div>
        <a href="{{ route('admin.books.create') }}"
            class="bg-slate-900 text-white rounded-lg px-4 py-2 text-sm font-semibold hover:bg-slate-800">+ Tambah
            Buku</a>
    </div>

    <form method="GET" class="flex flex-wrap gap-3 mb-4">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="cari judul, pengarang, ISBN..."
            class="flex-1 min-w-[200px] border border-slate-300 rounded-lg px-3 py-2 text-sm">
        <select name="category_id" class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}
                </option>
            @endforeach
        </select>
        <select name="status" class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Status</option>
            <option value="tersedia" @selected(request('status') == 'tersedia')>Tersedia</option>
            <option value="dipinjam" @selected(request('status') == 'dipinjam')>Dipinjam</option>
            <option value="perbaikan" @selected(request('status') == 'perbaikan')>Perbaikan</option>
        </select>
        <button
            class="border border-slate-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-slate-50">Filter</button>
    </form>

    <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto">
        <table class="tabel-kartu w-full text-sm">
            <thead>
                <tr class="text-left text-slate-500 border-b border-slate-100">
                    <th class="p-3 font-medium">No.</th>
                    <th class="p-3 font-medium">Sampul</th>
                    <th class="p-3 font-medium">Judul Buku</th>
                    <th class="p-3 font-medium">Pengarang</th>
                    <th class="p-3 font-medium">Kategori</th>
                    <th class="p-3 font-medium">Stok</th>
                    <th class="p-3 font-medium">Status</th>
                    <th class="p-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $index => $book)
                    <tr class="border-b border-slate-50">
                        <td class="p-3" data-label="No.">{{ $books->firstItem() + $index }}</td>
                        <td class="p-3" data-label="Sampul"><img src="{{ $book->cover_url }}"
                                alt="Sampul {{ $book->title }}" loading="lazy" class="w-10 h-14 object-cover rounded"></td>
                        <td class="p-3 font-medium" data-label="Judul Buku">{{ $book->title }}</td>
                        <td class="p-3" data-label="Pengarang">{{ $book->author }}</td>
                        <td class="p-3" data-label="Kategori">{{ $book->category->name }}</td>
                        <td class="p-3" data-label="Stok">{{ $book->stock }}</td>
                        <td class="p-3" data-label="Status">
                            @php
                                $badge = ['tersedia' => 'bg-emerald-50 text-emerald-600 border-emerald-200', 'dipinjam' => 'bg-red-50 text-red-600 border-red-200', 'perbaikan' => 'bg-slate-100 text-slate-500 border-slate-200'];
                            @endphp
                            <span
                                class="text-xs border rounded-full px-2 py-0.5 {{ $badge[$book->status] }}">{{ ucfirst($book->status) }}</span>
                        </td>
                        <td class="p-3 space-x-2" data-label="Aksi">
                            <a href="{{ route('admin.books.edit', $book) }}" aria-label="Ubah {{ $book->title }}"
                                class="text-slate-500 hover:text-slate-900">✎</a>
                            <form method="POST" action="{{ route('admin.books.destroy', $book) }}" class="inline"
                                onsubmit="return confirm('Hapus buku ini?')">
                                @csrf @method('DELETE')
                                <button aria-label="Hapus {{ $book->title }}"
                                    class="text-slate-500 hover:text-red-600">🗑</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div
            class="p-3 flex items-center justify-between flex-wrap gap-2 text-sm text-slate-500 border-t border-slate-100">
            <span>Menampilkan {{ $books->firstItem() ?? 0 }}-{{ $books->lastItem() ?? 0 }} dari {{ $books->total() }}
                data</span>
            <div>{{ $books->links() }}</div>
        </div>
    </div>
</x-layouts.app>