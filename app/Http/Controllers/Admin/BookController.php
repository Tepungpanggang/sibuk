<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Shelf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::with(['category', 'shelf'])
            ->when($request->q, function ($query, $q) {
                $query->where(function ($search) use ($q) {
                    $search->where('title', 'like', "%{$q}%")
                        ->orWhere('author', 'like', "%{$q}%")
                        ->orWhere('isbn', 'like', "%{$q}%");
                });
            })
            ->when($request->category_id, fn($query, $v) => $query->where('category_id', $v))
            ->when($request->status, fn($query, $v) => $query->where('status', $v))
            ->orderBy('title')
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('admin.books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $shelves = Shelf::orderBy('code')->get();

        return view('admin.books.create', compact('categories', 'shelves'));
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('cover')) {
            $validated['cover_path'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($validated);

        return redirect()->route('admin.books.index')->with('status', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        $shelves = Shelf::orderBy('code')->get();

        return view('admin.books.edit', compact('book', 'categories', 'shelves'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('cover')) {
            if ($book->cover_path) {
                Storage::disk('public')->delete($book->cover_path);
            }
            $validated['cover_path'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($validated);

        return redirect()->route('admin.books.index')->with('status', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        if ($book->loans()->exists()) {
            return back()->withErrors(['book' => 'Buku memiliki riwayat peminjaman dan tidak dapat dihapus.']);
        }

        if ($book->cover_path) {
            Storage::disk('public')->delete($book->cover_path);
        }

        $book->delete();

        return back()->with('status', 'Buku berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'isbn' => ['nullable', 'string', 'max:50'],
            'published_year' => ['nullable', 'integer', 'between:1901,2155'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'shelf_id' => ['required', 'exists:shelves,id'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'in:tersedia,dipinjam,perbaikan'],
        ]);

        unset($validated['cover']);

        if ($validated['status'] !== 'perbaikan') {
            $validated['status'] = $validated['stock'] > 0 ? 'tersedia' : 'dipinjam';
        }

        return $validated;
    }
}