<x-layouts.app title="Kategori / Rak">
    <h1 class="text-2xl font-bold mb-6">Kategori &amp; Lokasi Rak</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <h2 class="font-semibold mb-3">Kategori</h2>
            <form method="POST" action="{{ route('admin.categories.store') }}" class="flex gap-2 mb-4">
                @csrf
                <input type="text" name="name" placeholder="Nama kategori baru" required
                    class="flex-1 min-w-0 border border-slate-300 rounded-lg px-3 py-2 text-sm">
                <button
                    class="bg-slate-900 text-white rounded-lg px-4 py-2 text-sm font-semibold hover:bg-slate-800">Tambah</button>
            </form>
            <div class="overflow-x-auto">
                <table class="tabel-kartu w-full text-sm">
                    <thead>
                        <tr class="text-left text-slate-500 border-b border-slate-100">
                            <th class="pb-2 font-medium">Nama</th>
                            <th class="pb-2 font-medium">Jumlah Buku</th>
                            <th class="pb-2 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr class="border-b border-slate-50">
                                <td class="py-2" data-label="Nama">
                                    <form method="POST" action="{{ route('admin.categories.update', $category) }}"
                                        class="flex items-center gap-2">
                                        @csrf @method('PUT')
                                        <input type="text" name="name" value="{{ $category->name }}"
                                            aria-label="Nama kategori"
                                            class="border border-transparent hover:border-slate-200 rounded px-1 py-0.5 w-full">
                                        <button
                                            class="text-slate-500 hover:text-slate-900 text-xs whitespace-nowrap">Simpan</button>
                                    </form>
                                </td>
                                <td class="py-2" data-label="Jumlah Buku">{{ $category->books_count }}</td>
                                <td class="py-2" data-label="Aksi">
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                        class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-slate-500 hover:text-red-600 text-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <h2 class="font-semibold mb-3">Lokasi Rak</h2>
            <form method="POST" action="{{ route('admin.shelves.store') }}" class="flex gap-2 mb-4">
                @csrf
                <input type="text" name="code" placeholder="Kode rak" required
                    class="w-28 min-w-0 border border-slate-300 rounded-lg px-3 py-2 text-sm">
                <input type="text" name="location" placeholder="Lokasi"
                    class="flex-1 min-w-0 border border-slate-300 rounded-lg px-3 py-2 text-sm">
                <button
                    class="bg-slate-900 text-white rounded-lg px-4 py-2 text-sm font-semibold hover:bg-slate-800">Tambah</button>
            </form>
            <div class="overflow-x-auto">
                <table class="tabel-kartu w-full text-sm">
                    <thead>
                        <tr class="text-left text-slate-500 border-b border-slate-100">
                            <th class="pb-2 font-medium">Kode</th>
                            <th class="pb-2 font-medium">Lokasi</th>
                            <th class="pb-2 font-medium">Jumlah Buku</th>
                            <th class="pb-2 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shelves as $shelf)
                            <tr class="border-b border-slate-50">
                                <td class="py-2" data-label="Kode">
                                    <form id="shelf-form-{{ $shelf->id }}" method="POST" class="hidden"
                                        action="{{ route('admin.shelves.update', $shelf) }}">
                                        @csrf @method('PUT')
                                    </form>
                                    <input type="text" name="code" value="{{ $shelf->code }}" aria-label="Kode rak"
                                        form="shelf-form-{{ $shelf->id }}"
                                        class="border border-transparent hover:border-slate-200 rounded px-1 py-0.5 w-full">
                                </td>
                                <td class="py-2" data-label="Lokasi">
                                    <input type="text" name="location" value="{{ $shelf->location }}"
                                        aria-label="Lokasi rak" form="shelf-form-{{ $shelf->id }}"
                                        class="border border-transparent hover:border-slate-200 rounded px-1 py-0.5 w-full">
                                </td>
                                <td class="py-2" data-label="Jumlah Buku">{{ $shelf->books_count }}</td>
                                <td class="py-2 space-x-2 whitespace-nowrap" data-label="Aksi">
                                    <button type="submit" form="shelf-form-{{ $shelf->id }}"
                                        class="text-slate-500 hover:text-slate-900 text-xs">Simpan</button>
                                    <form method="POST" action="{{ route('admin.shelves.destroy', $shelf) }}" class="inline"
                                        onsubmit="return confirm('Hapus rak ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-slate-500 hover:text-red-600 text-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>