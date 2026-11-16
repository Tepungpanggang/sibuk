<x-layouts.app title="Dashboard">
    <h1 class="text-2xl font-bold mb-1">Selamat datang, {{ auth()->user()->name }}</h1>
    <p class="text-sm text-slate-500 mb-6">Ringkasan status peminjaman Anda</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="anim-card bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Peminjaman Aktif</p>
            <p class="text-2xl font-bold">{{ $activeLoans }}</p>
        </div>
        <div class="anim-card bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Menunggu Verifikasi</p>
            <p class="text-2xl font-bold">{{ $pendingLoans }}</p>
        </div>
        <div class="anim-card bg-white rounded-xl border border-red-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Total Denda Belum Lunas</p>
            <p class="text-2xl font-bold text-red-600">Rp {{ number_format($totalFine, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4 mb-6">
        <h2 class="font-semibold mb-3">Notifikasi Pengajuan</h2>
        @if($notifications->isEmpty())
            <p class="text-sm text-slate-400">Belum ada notifikasi.</p>
        @else
            <ul class="space-y-2 text-sm">
                @foreach($notifications as $loan)
                    <li class="flex items-start gap-2">
                        @if($loan->status === 'approved')
                            <span class="text-xs border rounded-full px-2 py-0.5 bg-blue-50 text-blue-600 border-blue-200">Approved</span>
                            <span>Pengajuan buku "{{ $loan->book->title }}" disetujui. Silakan ambil buku di perpustakaan.</span>
                        @else
                            <span class="text-xs border rounded-full px-2 py-0.5 bg-red-50 text-red-600 border-red-200">Rejected</span>
                            <span>
                                Pengajuan buku "{{ $loan->book->title }}" ditolak.
                                @if($loan->notes)
                                    Alasan: {{ $loan->notes }}
                                @endif
                            </span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4 mb-6">
        <h2 class="font-semibold mb-1">Video Panduan SIBUK</h2>
        <p class="text-sm text-slate-500 mb-3">Tonton panduan penggunaan sistem peminjaman buku.</p>
        @if($guideVideoUrl)
            <div class="video-wadah">
                <video class="w-full rounded-lg bg-black aspect-video" style="object-fit: contain;" controls
                    playsinline preload="metadata" controlslist="nodownload">
                    <source src="{{ $guideVideoUrl }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutaran video.
                </video>
            </div>
        @else
            <div class="w-full max-w-2xl aspect-video rounded-lg border-2 border-dashed border-slate-300 bg-slate-50 flex items-center justify-center text-center text-sm text-slate-400 px-4">
                Video panduan belum tersedia. Petugas dapat menempatkan berkas video di storage/app/private/videos/panduan.mp4.
            </div>
        @endif
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <h2 class="font-semibold mb-3">Riwayat Peminjaman Terbaru</h2>
        @if($recentLoans->isEmpty())
            <p class="text-sm text-slate-400">Belum ada riwayat peminjaman.</p>
        @else
            <div class="overflow-x-auto">
                <table class="tabel-kartu w-full text-sm">
                    <thead>
                        <tr class="text-left text-slate-500 border-b border-slate-100">
                            <th class="pb-2 font-medium">Buku</th>
                            <th class="pb-2 font-medium">Status</th>
                            <th class="pb-2 font-medium">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentLoans as $loan)
                            <tr class="border-b border-slate-50">
                                <td class="py-2" data-label="Buku">{{ $loan->book->title }}</td>
                                <td class="py-2 capitalize" data-label="Status">{{ $loan->status }}</td>
                                <td class="py-2" data-label="Denda">Rp {{ number_format($loan->fine->amount ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layouts.app>