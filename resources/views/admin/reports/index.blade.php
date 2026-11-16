<x-layouts.app title="Rekap & Laporan">
    <div class="flex items-center justify-between flex-wrap gap-3 mb-6">
        <h1 class="text-2xl font-bold">Rekap &amp; Laporan Transaksi</h1>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.reports.print', request()->query()) }}" target="_blank"
                class="border border-slate-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-slate-50">Cetak PDF</a>
            <a href="{{ route('admin.reports.export', request()->query()) }}"
                class="border border-slate-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-slate-50">Ekspor
                Excel</a>
        </div>
    </div>

    <form method="GET" class="flex flex-wrap gap-3 mb-4">
        <input type="date" name="from" value="{{ request('from') }}" aria-label="Dari tanggal"
            class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
        <input type="date" name="to" value="{{ request('to') }}" aria-label="Sampai tanggal"
            class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
        <select name="status" class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="pending" @selected(request('status') == 'pending')>Pending</option>
            <option value="approved" @selected(request('status') == 'approved')>Approved</option>
            <option value="rejected" @selected(request('status') == 'rejected')>Rejected</option>
            <option value="dipinjam" @selected(request('status') == 'dipinjam')>Dipinjam</option>
            <option value="dikembalikan" @selected(request('status') == 'dikembalikan')>Dikembalikan</option>
        </select>
        <button
            class="border border-slate-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-slate-50">Filter</button>
    </form>

    <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto">
        <table class="tabel-kartu w-full text-sm">
            <thead>
                <tr class="text-left text-slate-500 border-b border-slate-100">
                    <th class="p-3 font-medium">No.</th>
                    <th class="p-3 font-medium">Siswa</th>
                    <th class="p-3 font-medium">Buku</th>
                    <th class="p-3 font-medium">Tgl Pinjam</th>
                    <th class="p-3 font-medium">Tgl Kembali</th>
                    <th class="p-3 font-medium">Status</th>
                    <th class="p-3 font-medium">Denda</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $index => $loan)
                    <tr class="border-b border-slate-50">
                        <td class="p-3" data-label="No.">{{ $loans->firstItem() + $index }}</td>
                        <td class="p-3" data-label="Siswa">{{ $loan->user->name }}</td>
                        <td class="p-3" data-label="Buku">{{ $loan->book->title }}</td>
                        <td class="p-3" data-label="Tgl Pinjam">{{ $loan->loan_date->format('d/m/Y') }}</td>
                        <td class="p-3" data-label="Tgl Kembali">{{ $loan->returned_at?->format('d/m/Y') ?? '-' }}</td>
                        <td class="p-3 capitalize" data-label="Status">{{ $loan->status }}</td>
                        <td class="p-3" data-label="Denda">Rp {{ number_format($loan->fine->amount ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3 border-t border-slate-100">{{ $loans->links() }}</div>
    </div>
</x-layouts.app>