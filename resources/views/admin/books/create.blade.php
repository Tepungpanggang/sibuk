<x-layouts.app title="Tambah Buku">
    <p class="text-sm text-slate-400 mb-1">Data Buku / Tambah Buku Baru</p>
    <h1 class="text-2xl font-bold mb-6">Tambah Buku Baru</h1>

    <div class="bg-white rounded-xl border border-slate-200 p-6 max-w-4xl">
        <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Judul Buku *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Pengarang *</label>
                    <input type="text" name="author" value="{{ old('author') }}" required class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">ISBN</label>
                    <input type="text" name="isbn" value="{{ old('isbn') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Tahun Terbit</label>
                    <input type="text" name="published_year" value="{{ old('published_year') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Penerbit</label>
                    <input type="text" name="publisher" value="{{ old('publisher') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Kategori *</label>
                    <select name="category_id" required class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                        <option value="">Pilih kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Lokasi Rak *</label>
                    <select name="shelf_id" required class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                        <option value="">Pilih rak</option>
                        @foreach($shelves as $shelf)
                            <option value="{{ $shelf->id }}" @selected(old('shelf_id') == $shelf->id)>{{ $shelf->code }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Jumlah Eksemplar *</label>
                    <input type="number" name="stock" min="0" value="{{ old('stock', 0) }}" required class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Status *</label>
                    <select name="status" required class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                        <option value="tersedia">Tersedia untuk dipinjam</option>
                        <option value="perbaikan">Perbaikan</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Sampul Buku (opsional)</label>
                    <input type="file" name="cover" accept="image/*" class="w-full border border-dashed border-slate-300 rounded-lg px-3 py-6 text-sm text-slate-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Deskripsi / Sinopsis</label>
                    <textarea name="description" rows="4" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">{{ old('description') }}</textarea>
                </div>
            </div>

            <p class="text-xs text-red-500 mb-4">*note: field bertanda * wajib diisi</p>

            <div class="flex gap-3">
                <a href="{{ route('admin.books.index') }}" class="border border-slate-300 rounded-lg px-5 py-2 text-sm font-medium hover:bg-slate-50">Batal</a>
                <button type="submit" class="bg-slate-900 text-white rounded-lg px-5 py-2 text-sm font-semibold hover:bg-slate-800">Simpan Data</button>
            </div>
        </form>
    </div>
</x-layouts.app>