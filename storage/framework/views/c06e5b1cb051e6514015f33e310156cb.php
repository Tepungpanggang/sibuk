<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.app','data' => ['title' => 'Dashboard']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard']); ?>
    <h1 class="text-2xl font-bold mb-1">Selamat datang, <?php echo e(auth()->user()->name); ?></h1>
    <p class="text-sm text-slate-500 mb-6">Ringkasan aktivitas perpustakaan hari ini,
        <?php echo e(now()->translatedFormat('l, d F Y')); ?></p>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Total Buku</p>
            <p class="text-2xl font-bold"><?php echo e($totalBooks); ?></p>
            <p class="text-xs text-emerald-600 mt-1">tersedia: <?php echo e($availableBooks); ?></p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Peminjaman Aktif</p>
            <p class="text-2xl font-bold"><?php echo e($activeLoans); ?></p>
            <p class="text-xs text-slate-400 mt-1">sedang dipinjam siswa</p>
        </div>
        <div class="bg-white rounded-xl border border-red-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Keterlambatan</p>
            <p class="text-2xl font-bold text-red-600"><?php echo e($lateLoans); ?></p>
            <p class="text-xs text-red-500 mt-1">perlu tindak lanjut</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Total Denda Bulan Ini</p>
            <p class="text-2xl font-bold">Rp <?php echo e(number_format($monthlyFine, 0, ',', '.')); ?></p>
            <p class="text-xs text-slate-400 mt-1">otomatis dihitung sistem</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between gap-3 mb-3">
                <h2 class="font-semibold">Pengajuan Peminjaman Menunggu Verifikasi</h2>
                <a href="<?php echo e(route('admin.loans.index', ['status' => 'pending'])); ?>"
                    class="text-sm text-slate-500 hover:underline whitespace-nowrap">Lihat Semua →</a>
            </div>
            <?php if($pendingLoans->isEmpty()): ?>
                <p class="text-sm text-slate-400">Tidak ada pengajuan baru.</p>
            <?php else: ?>
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
                            <?php $__currentLoopData = $pendingLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-b border-slate-50">
                                    <td class="py-2" data-label="Nama Siswa"><?php echo e($loan->user->name); ?></td>
                                    <td class="py-2" data-label="Judul Buku"><?php echo e($loan->book->title); ?></td>
                                    <td class="py-2 text-right space-x-1" data-label="Aksi">
                                        <form method="POST" action="<?php echo e(route('admin.loans.approve', $loan)); ?>" class="inline">
                                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                            <button
                                                class="text-emerald-600 border border-emerald-200 rounded-full px-3 py-1 text-xs hover:bg-emerald-50">Terima</button>
                                        </form>
                                        <form method="POST" action="<?php echo e(route('admin.loans.reject', $loan)); ?>" class="inline">
                                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                            <button
                                                class="text-red-600 border border-red-200 rounded-full px-3 py-1 text-xs hover:bg-red-50">Tolak</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php if($pendingCount > $pendingLoans->count()): ?>
                    <p class="text-xs text-slate-400 mt-3">Menampilkan <?php echo e($pendingLoans->count()); ?> dari <?php echo e($pendingCount); ?>

                        pengajuan.</p>
                <?php endif; ?>
            <?php endif; ?>
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
            <a href="<?php echo e(route('admin.reports.index')); ?>" class="text-sm text-slate-500 hover:underline">Lihat semua
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
                    <?php $__currentLoopData = $recentLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b border-slate-50">
                            <td class="py-2" data-label="ID">#<?php echo e($loan->id); ?></td>
                            <td class="py-2" data-label="Siswa"><?php echo e($loan->user->name); ?></td>
                            <td class="py-2" data-label="Buku"><?php echo e($loan->book->title); ?></td>
                            <td class="py-2 capitalize" data-label="Status"><?php echo e($loan->status); ?></td>
                            <td class="py-2" data-label="Denda">Rp
                                <?php echo e(number_format($loan->fine->amount ?? 0, 0, ',', '.')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    labels: [<?php $__currentLoopData = $weeklyChart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> '<?php echo e(\Carbon\Carbon::parse($row->tanggal)->format('d/m')); ?>', <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                    datasets: [{
                        label: 'Peminjaman',
                        data: [<?php $__currentLoopData = $weeklyChart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($row->total); ?>, <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>