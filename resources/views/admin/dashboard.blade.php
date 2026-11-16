<x-layouts.app title="Dashboard">
    <h1 class="text-2xl font-bold mb-1">Selamat datang, {{ auth()->user()->name }}</h1>
    <p class="text-sm text-slate-500 mb-6">Ringkasan aktivitas perpustakaan hari ini,
        {{ now()->translatedFormat('l, d F Y') }}</p>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Total Buku</p>
            <p class="text-2xl font-bold">{{ $totalBooks }}</p>
            <p class="text-xs text-emerald-600 mt-1">tersedia: {{ $availableBooks }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Peminjaman Aktif</p>
            <p class="text-2xl font-bold">{{ $activeLoans }}</p>
            <p class="text-xs text-slate-400 mt-1">sedang dipinjam siswa</p>
        </div>
        <div class="bg-white rounded-xl border border-red-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Keterlambatan</p>
            <p class="text-2xl font-bold text-red-600">{{ $lateLoans }}</p>
            <p class="text-xs text-red-500 mt-1">perlu tindak lanjut</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Total Denda Bulan Ini</p>
            <p class="text-2xl font-bold">Rp {{ number_format($monthlyFine, 0, ',', '.') }}</p>
            <p class="text-xs text-slate-400 mt-1">otomatis dihitung sistem</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between gap-3 mb-3">
                <h2 class="font-semibold">Pengajuan Peminjaman Menunggu Verifikasi</h2>
                <a href="{{ route('admin.loans.index', ['status' => 'pending']) }}"
                    class="text-sm text-slate-500 hover:underline whitespace-nowrap">Lihat Semua →</a>
            </div>
            @if($pendingLoans->isEmpty())
                <p class="text-sm text-slate-400">Tidak ada pengajuan baru.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="tabel-kartu w-full text-sm">
                        <thead>
                            <tr class="text-left text-slate-500 border-b border-slate-100">
                                <th class="pb-2 font-medium">Nama Siswa</th>
                                <th class="pb-2 font-medium">Judul Buku</th>
                                <th class="pb-2 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingLoans as $loan)
                                <tr class="border-b border-slate-50">
                                    <td class="py-2" data-label="Nama Siswa">{{ $loan->user->name }}</td>
                                    <td class="py-2" data-label="Judul Buku">{{ $loan->book->title }}</td>
                                    <td class="py-2 text-right space-x-1" data-label="Aksi">
                                        <form method="POST" action="{{ route('admin.loans.approve', $loan) }}" class="inline">
                                            @csrf @method('PATCH')
                                            <button
                                                class="text-emerald-600 border border-emerald-200 rounded-full px-3 py-1 text-xs hover:bg-emerald-50">Terima</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.loans.reject', $loan) }}" class="inline">
                                            @csrf @method('PATCH')
                                            <button
                                                class="text-red-600 border border-red-200 rounded-full px-3 py-1 text-xs hover:bg-red-50">Tolak</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($pendingCount > $pendingLoans->count())
                    <p class="text-xs text-slate-400 mt-3">Menampilkan {{ $pendingLoans->count() }} dari {{ $pendingCount }}
                        pengajuan.</p>
                @endif
            @endif
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <h2 class="font-semibold mb-3">Grafik Peminjaman (7 Hari Terakhir)</h2>
            <div class="grafik-wadah">
                <canvas id="loanChart"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <div class="flex items-center justify-between mb-3">
            <h2 class="font-semibold">Rekap Transaksi Terbaru</h2>
            <a href="{{ route('admin.reports.index') }}" class="text-sm text-slate-500 hover:underline">Lihat semua
                →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="tabel-kartu w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b border-slate-100">
                        <th class="pb-2 font-medium">ID</th>
                        <th class="pb-2 font-medium">Siswa</th>
                        <th class="pb-2 font-medium">Buku</th>
                        <th class="pb-2 font-medium">Status</th>
                        <th class="pb-2 font-medium">Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentLoans as $loan)
                        <tr class="border-b border-slate-50">
                            <td class="py-2" data-label="ID">#{{ $loan->id }}</td>
                            <td class="py-2" data-label="Siswa">{{ $loan->user->name }}</td>
                            <td class="py-2" data-label="Buku">{{ $loan->book->title }}</td>
                            <td class="py-2 capitalize" data-label="Status">{{ $loan->status }}</td>
                            <td class="py-2" data-label="Denda">Rp
                                {{ number_format($loan->fine->amount ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <script>
        const chartCanvas = document.getElementById('loanChart');

        if (typeof Chart !== 'undefined') {
            new Chart(chartCanvas, {
                type: 'line',
                data: {
                    labels: [@foreach($weeklyChart as $row) '{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m') }}', @endforeach],
                    datasets: [{
                        label: 'Peminjaman',
                        data: [@foreach($weeklyChart as $row) {{ $row->total }}, @endforeach],
                        borderColor: '#0f172a',
                        borderDash: [4, 4],
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                }
            });
        } else {
            chartCanvas.parentNode.textContent = 'Grafik tidak dapat dimuat. Periksa koneksi internet.';
        }
    </script>
</x-layouts.app>