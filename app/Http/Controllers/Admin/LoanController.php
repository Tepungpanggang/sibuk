<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $loans = Loan::with(['user', 'book'])
            ->when($request->status, fn($query, $v) => $query->where('status', $v))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.loans.index', compact('loans'));
    }

    public function approve(Loan $loan)
    {
        $error = DB::transaction(function () use ($loan) {
            $loan = Loan::lockForUpdate()->findOrFail($loan->id);

            if ($loan->status !== 'pending') {
                return 'Pengajuan sudah diproses.';
            }

            $book = Book::lockForUpdate()->findOrFail($loan->book_id);
            $reserved = Loan::where('book_id', $book->id)->where('status', 'approved')->count();

            if ($book->status !== 'tersedia' || ($book->stock - $reserved) < 1) {
                return 'Stok buku tidak tersedia.';
            }

            $loan->update([
                'status' => 'approved',
                'approved_at' => now(),
            ]);

            return null;
        });

        return $error
            ? back()->withErrors(['status' => $error])
            : back()->with('status', 'Pengajuan disetujui.');
    }

    public function reject(Request $request, Loan $loan)
    {
        $validated = $request->validate([
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        $error = DB::transaction(function () use ($loan, $validated) {
            $loan = Loan::lockForUpdate()->findOrFail($loan->id);

            if ($loan->status !== 'pending') {
                return 'Pengajuan sudah diproses.';
            }

            $loan->update([
                'status' => 'rejected',
                'notes' => $validated['notes'] ?? null,
            ]);

            return null;
        });

        return $error
            ? back()->withErrors(['status' => $error])
            : back()->with('status', 'Pengajuan ditolak.');
    }

    public function reprocess(Loan $loan)
    {
        if ($loan->status !== 'rejected') {
            return back()->withErrors(['status' => 'Hanya pengajuan rejected yang dapat diproses ulang.']);
        }

        $loan->update(['status' => 'pending', 'notes' => null]);

        return back()->with('status', 'Pengajuan diproses ulang.');
    }

    public function handOver(Loan $loan)
    {
        $error = DB::transaction(function () use ($loan) {
            $loan = Loan::lockForUpdate()->findOrFail($loan->id);

            if ($loan->status !== 'approved') {
                return 'Pengajuan belum disetujui.';
            }

            $book = Book::lockForUpdate()->findOrFail($loan->book_id);

            if ($book->stock < 1 || $book->status === 'perbaikan') {
                return 'Stok buku tidak tersedia.';
            }

            $today = now()->startOfDay();

            $loan->update([
                'status' => 'dipinjam',
                'handed_over_at' => $today,
                'due_date' => $today->copy()->addDays(Loan::LOAN_DAYS),
            ]);

            $book->decrement('stock');

            if ($book->stock < 1) {
                $book->update(['status' => 'dipinjam']);
            }

            return null;
        });

        return $error
            ? back()->withErrors(['status' => $error])
            : back()->with('status', 'Penyerahan buku dicatat.');
    }

    public function extend(Loan $loan)
    {
        $error = DB::transaction(function () use ($loan) {
            $loan = Loan::lockForUpdate()->findOrFail($loan->id);

            $message = $loan->extensionError();

            if ($message !== null) {
                return $message;
            }

            $loan->extend();

            return null;
        });

        return $error
            ? back()->withErrors(['status' => $error])
            : back()->with('status', 'Masa peminjaman diperpanjang.');
    }

    public function returnBook(Loan $loan)
    {
        $error = DB::transaction(function () use ($loan) {
            $loan = Loan::lockForUpdate()->findOrFail($loan->id);

            if ($loan->status !== 'dipinjam') {
                return 'Buku belum berstatus dipinjam.';
            }

            $today = now()->startOfDay();

            $loan->update([
                'status' => 'dikembalikan',
                'returned_at' => $today,
            ]);

            $book = Book::lockForUpdate()->findOrFail($loan->book_id);
            $book->increment('stock');

            if ($book->status === 'dipinjam') {
                $book->update(['status' => 'tersedia']);
            }

            if ($loan->due_date && $today->gt($loan->due_date)) {
                $daysLate = (int) $loan->due_date->diffInDays($today);

                $loan->fine()->create([
                    'days_late' => $daysLate,
                    'amount' => $daysLate * Loan::FINE_PER_DAY,
                    'status' => 'unpaid',
                ]);
            }

            return null;
        });

        return $error
            ? back()->withErrors(['status' => $error])
            : back()->with('status', 'Pengembalian buku dicatat.');
    }
}