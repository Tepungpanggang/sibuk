<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.app','data' => ['title' => 'Rekap & Laporan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Rekap & Laporan']); ?>
    <div class="flex items-center justify-between flex-wrap gap-3 mb-6">
        <h1 class="text-2xl font-bold">Rekap &amp; Laporan Transaksi</h1>
        <div class="flex flex-wrap gap-2">
            <a href="<?php echo e(route('admin.reports.print', request()->query())); ?>" target="_blank"
                class="border border-slate-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-slate-50">Cetak PDF</a>
            <a href="<?php echo e(route('admin.reports.export', request()->query())); ?>"
                class="border border-slate-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-slate-50">Ekspor
                Excel</a>
        </div>
    </div>

    <form method="GET" class="flex flex-wrap gap-3 mb-4">
        <input type="date" name="from" value="<?php echo e(request('from')); ?>" aria-label="Dari tanggal"
            class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
        <input type="date" name="to" value="<?php echo e(request('to')); ?>" aria-label="Sampai tanggal"
            class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
        <select name="status" class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="pending" <?php if(request('status') == 'pending'): echo 'selected'; endif; ?>>Pending</option>
            <option value="approved" <?php if(request('status') == 'approved'): echo 'selected'; endif; ?>>Approved</option>
            <option value="rejected" <?php if(request('status') == 'rejected'): echo 'selected'; endif; ?>>Rejected</option>
            <option value="dipinjam" <?php if(request('status') == 'dipinjam'): echo 'selected'; endif; ?>>Dipinjam</option>
            <option value="dikembalikan" <?php if(request('status') == 'dikembalikan'): echo 'selected'; endif; ?>>Dikembalikan</option>
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
                <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b border-slate-50">
                        <td class="p-3" data-label="No."><?php echo e($loans->firstItem() + $index); ?></td>
                        <td class="p-3" data-label="Siswa"><?php echo e($loan->user->name); ?></td>
                        <td class="p-3" data-label="Buku"><?php echo e($loan->book->title); ?></td>
                        <td class="p-3" data-label="Tgl Pinjam"><?php echo e($loan->loan_date->format('d/m/Y')); ?></td>
                        <td class="p-3" data-label="Tgl Kembali"><?php echo e($loan->returned_at?->format('d/m/Y') ?? '-'); ?></td>
                        <td class="p-3 capitalize" data-label="Status"><?php echo e($loan->status); ?></td>
                        <td class="p-3" data-label="Denda">Rp <?php echo e(number_format($loan->fine->amount ?? 0, 0, ',', '.')); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="p-3 border-t border-slate-100"><?php echo e($loans->links()); ?></div>
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
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>