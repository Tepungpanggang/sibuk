<x-layouts.app title="Peminjaman Saya">
    <h1 class="text-2xl font-bold mb-6">Peminjaman Saya</h1>

    <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto">
        <table class="tabel-kartu w-full text-sm">
            <thead>
                <tr class="text-left text-slate-500 border-b border-slate-100">
                    <th class="p-3 font-medium">Buku</th>
                    <th class="p-3 font-medium">Tgl Pengajuan</th>
                    <th class="p-3 font-medium">Jatuh Tempo</th>
                    <th class="p-3 font-medium">Status</th>
                    <th class="p-3 font-medium">Catatan</th>
                    <th class="p-3 font-medium">Denda</th>
                    <th class="p-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                    <tr class="border-b border-slate-50">
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
                        <td class="p-3" data-label="Catatan">{{ $loan->notes ?? '-' }}</td>
                        <td class="p-3" data-label="Denda">Rp {{ number_format($loan->fine->amount ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="p-3" data-label="Aksi">
                            @if($loan->canExtend())
                                <form method="POST" action="{{ route('siswa.loans.extend', $loan) }}" class="inline"
                                    onsubmit="return confirm('Perpanjang masa peminjaman {{ \App\Models\Loan::EXTENSION_DAYS }} hari?')">
                                    @csrf @method('PATCH')
                                    <button
                                        class="text-blue-600 border border-blue-200 rounded-full px-3 py-1 text-xs hover:bg-blue-50">Perpanjang</button>
                                </form>
                            @elseif($loan->status === 'dipinjam')
                                <span class="text-xs text-slate-400">{{ $loan->extensionError() }}</span>
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