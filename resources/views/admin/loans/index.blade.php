<x-layouts.app title="Pengajuan & Peminjaman">
    <h1 class="text-2xl font-bold mb-6">Pengajuan &amp; Peminjaman</h1>

    <form method="GET" class="mb-4">
        <select name="status" onchange="this.form.submit()"
            class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="pending" @selected(request('status') == 'pending')>Pending</option>
            <option value="approved" @selected(request('status') == 'approved')>Approved</option>
            <option value="rejected" @selected(request('status') == 'rejected')>Rejected</option>
            <option value="dipinjam" @selected(request('status') == 'dipinjam')>Dipinjam</option>
            <option value="dikembalikan" @selected(request('status') == 'dikembalikan')>Dikembalikan</option>
        </select>
    </form>

    <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto">
        <table class="tabel-kartu w-full text-sm">
            <thead>
                <tr class="text-left text-slate-500 border-b border-slate-100">
                    <th class="p-3 font-medium">Siswa</th>
                    <th class="p-3 font-medium">Buku</th>
                    <th class="p-3 font-medium">Tgl Pengajuan</th>
                    <th class="p-3 font-medium">Jatuh Tempo</th>
                    <th class="p-3 font-medium">Status</th>
                    <th class="p-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                    <tr class="border-b border-slate-50">
                        <td class="p-3" data-label="Siswa">{{ $loan->user->name }}</td>
                        <td class="p-3" data-label="Buku">{{ $loan->book->title }}</td>
                        <td class="p-3" data-label="Tgl Pengajuan">{{ $loan->loan_date->format('d/m/Y') }}</td>
                        <td class="p-3" data-label="Jatuh Tempo">
                            <div>{{ $loan->due_date?->format('d/m/Y') ?? '-' }}@if($loan->extension_count > 0)<span
                                class="block text-xs text-slate-400">Diperpanjang
                            {{ $loan->extension_count }}x</span>@endif</div>
                        </td>
                        <td class="p-3" data-label="Status">
                            @php
                                $badge = ['pending' => 'bg-amber-50 text-amber-600 border-amber-200', 'approved' => 'bg-blue-50 text-blue-600 border-blue-200', 'rejected' => 'bg-red-50 text-red-600 border-red-200', 'dipinjam' => 'bg-slate-100 text-slate-600 border-slate-200', 'dikembalikan' => 'bg-emerald-50 text-emerald-600 border-emerald-200'];
                            @endphp
                            <span
                                class="text-xs border rounded-full px-2 py-0.5 {{ $badge[$loan->status] }}">{{ ucfirst($loan->status) }}</span>
                        </td>
                        <td class="p-3 space-x-1" data-label="Aksi">
                            @if($loan->status === 'pending')
                                <form method="POST" action="{{ route('admin.loans.approve', $loan) }}" class="inline">
                                    @csrf @method('PATCH')
                                    <button
                                        class="text-emerald-600 border border-emerald-200 rounded-full px-3 py-1 text-xs hover:bg-emerald-50">Terima</button>
                                </form>
                                <form method="POST" action="{{ route('admin.loans.reject', $loan) }}"
                                    class="inline-flex items-center gap-1">
                                    @csrf @method('PATCH')
                                    <input type="text" name="notes" maxlength="255" placeholder="Alasan (opsional)"
                                        class="border border-slate-200 rounded-full px-2 py-1 text-xs w-36">
                                    <button
                                        class="text-red-600 border border-red-200 rounded-full px-3 py-1 text-xs hover:bg-red-50">Tolak</button>
                                </form>
                            @elseif($loan->status === 'rejected')
                                <form method="POST" action="{{ route('admin.loans.reprocess', $loan) }}" class="inline">
                                    @csrf @method('PATCH')
                                    <button
                                        class="text-slate-600 border border-slate-200 rounded-full px-3 py-1 text-xs hover:bg-slate-50">Proses
                                        Ulang</button>
                                </form>
                            @elseif($loan->status === 'approved')
                                <form method="POST" action="{{ route('admin.loans.hand-over', $loan) }}" class="inline">
                                    @csrf @method('PATCH')
                                    <button
                                        class="text-blue-600 border border-blue-200 rounded-full px-3 py-1 text-xs hover:bg-blue-50">Serahkan
                                        Buku</button>
                                </form>
                            @elseif($loan->status === 'dipinjam')
                                @if($loan->canExtend())
                                    <form method="POST" action="{{ route('admin.loans.extend', $loan) }}" class="inline"
                                        onsubmit="return confirm('Perpanjang masa peminjaman {{ \App\Models\Loan::EXTENSION_DAYS }} hari?')">
                                        @csrf @method('PATCH')
                                        <button
                                            class="text-blue-600 border border-blue-200 rounded-full px-3 py-1 text-xs hover:bg-blue-50">Perpanjang</button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('admin.loans.return', $loan) }}" class="inline">
                                    @csrf @method('PATCH')
                                    <button
                                        class="text-slate-600 border border-slate-200 rounded-full px-3 py-1 text-xs hover:bg-slate-50">Catat
                                        Kembali</button>
                                </form>
                            @else
                                <span class="text-slate-300 text-xs">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3 border-t border-slate-100">{{ $loans->links() }}</div>
    </div>
</x-layouts.app>