<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LoansExport;
use App\Http\Controllers\Controller;
use App\Models\Loan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $loans = $this->filteredLoans($request)->paginate(15)->withQueryString();

        return view('admin.reports.index', compact('loans'));
    }

    public function print(Request $request)
    {
        $loans = $this->filteredLoans($request)->get();

        $pdf = Pdf::loadView('admin.reports.print', compact('loans'));

        return $pdf->stream('laporan-transaksi.pdf');
    }

    public function exportExcel(Request $request)
    {
        $loans = $this->filteredLoans($request)->get();

        return Excel::download(new LoansExport($loans), 'laporan-transaksi.xlsx');
    }

    private function filteredLoans(Request $request)
    {
        $filters = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
            'status' => ['nullable', 'in:pending,approved,rejected,dipinjam,dikembalikan'],
        ]);

        return Loan::with(['user', 'book', 'fine'])
            ->when($filters['from'] ?? null, fn($query, $v) => $query->whereDate('loan_date', '>=', $v))
            ->when($filters['to'] ?? null, fn($query, $v) => $query->whereDate('loan_date', '<=', $v))
            ->when($filters['status'] ?? null, fn($query, $v) => $query->where('status', $v))
            ->latest();
    }
}