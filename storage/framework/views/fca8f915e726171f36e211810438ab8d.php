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
    <p class="text-sm text-slate-500 mb-6">Ringkasan status peminjaman Anda</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="anim-card bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Peminjaman Aktif</p>
            <p class="text-2xl font-bold"><?php echo e($activeLoans); ?></p>
        </div>
        <div class="anim-card bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Menunggu Verifikasi</p>
            <p class="text-2xl font-bold"><?php echo e($pendingLoans); ?></p>
        </div>
        <div class="anim-card bg-white rounded-xl border border-red-200 p-4">
            <p class="text-xs text-slate-500 mb-1">Total Denda Belum Lunas</p>
            <p class="text-2xl font-bold text-red-600">Rp <?php echo e(number_format($totalFine, 0, ',', '.')); ?></p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4 mb-6">
        <h2 class="font-semibold mb-3">Notifikasi Pengajuan</h2>
        <?php if($notifications->isEmpty()): ?>
            <p class="text-sm text-slate-400">Belum ada notifikasi.</p>
        <?php else: ?>
            <ul class="space-y-2 text-sm">
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex items-start gap-2">
                        <?php if($loan->status === 'approved'): ?>
                            <span class="text-xs border rounded-full px-2 py-0.5 bg-blue-50 text-blue-600 border-blue-200">Approved</span>
                            <span>Pengajuan buku "<?php echo e($loan->book->title); ?>" disetujui. Silakan ambil buku di perpustakaan.</span>
                        <?php else: ?>
                            <span class="text-xs border rounded-full px-2 py-0.5 bg-red-50 text-red-600 border-red-200">Rejected</span>
                            <span>
                                Pengajuan buku "<?php echo e($loan->book->title); ?>" ditolak.
                                <?php if($loan->notes): ?>
                                    Alasan: <?php echo e($loan->notes); ?>

                                <?php endif; ?>
                            </span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4 mb-6">
        <h2 class="font-semibold mb-1">Video Panduan SIBUK</h2>
        <p class="text-sm text-slate-500 mb-3">Tonton panduan penggunaan sistem peminjaman buku.</p>
        <?php if($guideVideoUrl): ?>
            <div class="video-wadah">
                <video class="w-full rounded-lg bg-black aspect-video" style="object-fit: contain;" controls
                    playsinline preload="metadata" controlslist="nodownload">
                    <source src="<?php echo e($guideVideoUrl); ?>" type="video/mp4">
                    Browser Anda tidak mendukung pemutaran video.
                </video>
            </div>
        <?php else: ?>
            <div class="w-full max-w-2xl aspect-video rounded-lg border-2 border-dashed border-slate-300 bg-slate-50 flex items-center justify-center text-center text-sm text-slate-400 px-4">
                Video panduan belum tersedia. Petugas dapat menempatkan berkas video di storage/app/private/videos/panduan.mp4.
            </div>
        <?php endif; ?>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <h2 class="font-semibold mb-3">Riwayat Peminjaman Terbaru</h2>
        <?php if($recentLoans->isEmpty()): ?>
            <p class="text-sm text-slate-400">Belum ada riwayat peminjaman.</p>
        <?php else: ?>
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
                        <?php $__currentLoopData = $recentLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b border-slate-50">
                                <td class="py-2" data-label="Buku"><?php echo e($loan->book->title); ?></td>
                                <td class="py-2 capitalize" data-label="Status"><?php echo e($loan->status); ?></td>
                                <td class="py-2" data-label="Denda">Rp <?php echo e(number_format($loan->fine->amount ?? 0, 0, ',', '.')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/siswa/dashboard.blade.php ENDPATH**/ ?>