<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::with(['category', 'shelf'])
            ->when($request->q, function ($query, $q) {
                $query->where(function ($search) use ($q) {
                    $search->where('title', 'like', "%{$q}%")
                        ->orWhere('author', 'like', "%{$q}%");
                });
            })
            ->when($request->category_id, fn($query, $v) => $query->where('category_id', $v))
            ->orderBy('title')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('siswa.catalog.index', compact('books', 'categories'));
    }

    public function show(Book $book)
    {
        return view('siswa.catalog.show', compact('book'));
    }
}