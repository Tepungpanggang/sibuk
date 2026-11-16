<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Shelf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('books')->orderBy('name')->get();
        $shelves = Shelf::withCount('books')->orderBy('code')->get();

        return view('admin.categories.index', compact('categories', 'shelves'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
        ]);

        Category::create($validated);

        return back()->with('status', 'Kategori berhasil ditambahkan.');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($category->id)],
        ]);

        $category->update($validated);

        return back()->with('status', 'Kategori berhasil diperbarui.');
    }

    public function destroyCategory(Category $category)
    {
        if ($category->books()->exists()) {
            return back()->withErrors(['category' => 'Kategori masih digunakan oleh buku dan tidak dapat dihapus.']);
        }

        $category->delete();

        return back()->with('status', 'Kategori berhasil dihapus.');
    }

    public function storeShelf(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:shelves,code'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        Shelf::create($validated);

        return back()->with('status', 'Rak berhasil ditambahkan.');
    }

    public function updateShelf(Request $request, Shelf $shelf)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('shelves', 'code')->ignore($shelf->id)],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        $shelf->update($validated);

        return back()->with('status', 'Rak berhasil diperbarui.');
    }

    public function destroyShelf(Shelf $shelf)
    {
        if ($shelf->books()->exists()) {
            return back()->withErrors(['shelf' => 'Rak masih digunakan oleh buku dan tidak dapat dihapus.']);
        }

        $shelf->delete();

        return back()->with('status', 'Rak berhasil dihapus.');
    }
}