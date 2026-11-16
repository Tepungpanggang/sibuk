<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Fine;
use App\Models\Loan;

class DashboardController extends Controller
{
    public function index()
    {
        $activeLoans = Loan::where('status', 'dipinjam')->count();
        $totalBooks = Book::sum('stock') + $activeLoans;
        $availableBooks = Book::where('status', 'tersedia')->sum('stock');
        $lateLoans = Loan::where('status', 'dipinjam')->whereDate('due_date', '<', now())->count();
        $monthlyFine = Fine::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $pendingCount = Loan::where('status', 'pending')->count();

        $pendingLoans = Loan::with(['user', 'book'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        $recentLoans = Loan::with(['user', 'book', 'fine'])
            ->latest()
            ->take(5)
            ->get();

        $weeklyChart = Loan::selectRaw('DATE(loan_date) as tanggal, COUNT(*) as total')
            ->where('loan_date', '>=', now()->subDays(6)->toDateString())
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'availableBooks',
            'activeLoans',
            'lateLoans',
            'monthlyFine',
            'pendingLoans',
            'pendingCount',
            'recentLoans',
            'weeklyChart'
        ));
    }
}