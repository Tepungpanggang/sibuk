<x-layouts.app title="Denda">
    <h1 class="text-2xl font-bold mb-6">Denda Keterlambatan</h1>

    <form method="GET" class="mb-4">
        <select name="status" onchange="this.form.submit()"
            class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="unpaid" @selected(request('status') == 'unpaid')>Belum Lunas</option>
            <option value="paid" @selected(request('status') == 'paid')>Lunas</option>
        </select>
    </form>

    <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto">
        <table class="tabel-kartu w-full text-sm">
            <thead>
                <tr class="text-left text-slate-500 border-b border-slate-100">
                    <th class="p-3 font-medium">Siswa</th>
                    <th class="p-3 font-medium">Buku</th>
                    <th class="p-3 font-medium">Telat (hari)</th>
                    <th class="p-3 font-medium">Denda</th>
                    <th class="p-3 font-medium">Status</th>
                    <th class="p-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fines as $fine)
                    <tr class="border-b border-slate-50">
                        <td class="p-3" data-label="Siswa">{{ $fine->loan->user->name }}</td>
                        <td class="p-3" data-label="Buku">{{ $fine->loan->book->title }}</td>
                        <td class="p-3" data-label="Telat (hari)">{{ $fine->days_late }}</td>
                        <td class="p-3" data-label="Denda">Rp {{ number_format($fine->amount, 0, ',', '.') }}</td>
                        <td class="p-3" data-label="Status">
                            <span
                                class="text-xs border rounded-full px-2 py-0.5 {{ $fine->status === 'paid' ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-red-50 text-red-600 border-red-200' }}">
                                {{ $fine->status === 'paid' ? 'Lunas' : 'Belum Lunas' }}
                            </span>
                        </td>
                        <td class="p-3" data-label="Aksi">
                            @if($fine->status === 'unpaid')
                                <form method="POST" action="{{ route('admin.fines.paid', $fine) }}">
                                    @csrf @method('PATCH')
                                    <button
                                        class="text-emerald-600 border border-emerald-200 rounded-full px-3 py-1 text-xs hover:bg-emerald-50">Tandai
                                        Lunas</button>
                                </form>
                            @else
                                <span class="text-slate-300 text-xs">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3 border-t border-slate-100">{{ $fines->links() }}</div>
    </div>
</x-layouts.app>