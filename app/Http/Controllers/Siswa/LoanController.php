<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $loans = $request->user()->loans()
            ->with(['book', 'fine'])
            ->latest()
            ->paginate(10);

        return view('siswa.loans.index', compact('loans'));
    }

    public function store(Request $request, Book $book)
    {
        $error = DB::transaction(function () use ($request, $book) {
            $book = Book::lockForUpdate()->findOrFail($book->id);

            if ($book->status !== 'tersedia' || $book->stock < 1) {
                return 'Buku tidak tersedia untuk dipinjam.';
            }

            $existing = $request->user()->loans()
                ->where('book_id', $book->id)
                ->whereIn('status', ['pending', 'approved', 'dipinjam'])
                ->exists();

            if ($existing) {
                return 'Anda sudah memiliki pengajuan aktif untuk buku ini.';
            }

            Loan::create([
                'user_id' => $request->user()->id,
                'book_id' => $book->id,
                'status' => 'pending',
                'loan_date' => now(),
            ]);

            return null;
        });

        return $error
            ? back()->withErrors(['book' => $error])
            : redirect()->route('siswa.loans.index')->with('status', 'Pengajuan peminjaman berhasil dikirim.');
    }

    public function extend(Request $request, Loan $loan)
    {
        $error = DB::transaction(function () use ($request, $loan) {
            $loan = Loan::lockForUpdate()
                ->where('user_id', $request->user()->id)
                ->findOrFail($loan->id);

            $message = $loan->extensionError();

            if ($message !== null) {
                return $message;
            }

            $loan->extend();

            return null;
        });

        return $error
            ? back()->withErrors(['status' => $error])
            : back()->with('status', 'Masa peminjaman berhasil diperpanjang.');
    }
}