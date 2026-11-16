<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function index(Request $request)
    {
        $fines = Fine::with(['loan.user', 'loan.book'])
            ->when($request->status, fn($query, $v) => $query->where('status', $v))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.fines.index', compact('fines'));
    }

    public function markPaid(Fine $fine)
    {
        if ($fine->status === 'paid') {
            return back()->withErrors(['status' => 'Denda sudah berstatus lunas.']);
        }

        $fine->update(['status' => 'paid', 'paid_at' => now()]);

        return back()->with('status', 'Denda ditandai lunas.');
    }
}