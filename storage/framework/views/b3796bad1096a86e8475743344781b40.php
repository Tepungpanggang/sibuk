<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.app','data' => ['title' => 'Peminjaman Saya']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Peminjaman Saya']); ?>
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
                <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b border-slate-50">
                        <td class="p-3" data-label="Buku"><?php echo e($loan->book->title); ?></td>
                        <td class="p-3" data-label="Tgl Pengajuan"><?php echo e($loan->loan_date->format('d/m/Y')); ?></td>
                        <td class="p-3" data-label="Jatuh Tempo">
                            <div><?php echo e($loan->due_date?->format('d/m/Y') ?? '-'); ?><?php if($loan->extension_count > 0): ?><span
                                class="block text-xs text-slate-400">Diperpanjang
                            <?php echo e($loan->extension_count); ?>x</span><?php endif; ?></div>
                        </td>
                        <td class="p-3" data-label="Status">
                            <?php
                                $badge = ['pending' => 'bg-amber-50 text-amber-600 border-amber-200', 'approved' => 'bg-blue-50 text-blue-600 border-blue-200', 'rejected' => 'bg-red-50 text-red-600 border-red-200', 'dipinjam' => 'bg-slate-100 text-slate-600 border-slate-200', 'dikembalikan' => 'bg-emerald-50 text-emerald-600 border-emerald-200'];
                            ?>
                            <span
                                class="text-xs border rounded-full px-2 py-0.5 <?php echo e($badge[$loan->status]); ?>"><?php echo e(ucfirst($loan->status)); ?></span>
                        </td>
                        <td class="p-3" data-label="Catatan"><?php echo e($loan->notes ?? '-'); ?></td>
                        <td class="p-3" data-label="Denda">Rp <?php echo e(number_format($loan->fine->amount ?? 0, 0, ',', '.')); ?>

                        </td>
                        <td class="p-3" data-label="Aksi">
                            <?php if($loan->canExtend()): ?>
                                <form method="POST" action="<?php echo e(route('siswa.loans.extend', $loan)); ?>" class="inline"
                                    onsubmit="return confirm('Perpanjang masa peminjaman <?php echo e(\App\Models\Loan::EXTENSION_DAYS); ?> hari?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <button
                                        class="text-blue-600 border border-blue-200 rounded-full px-3 py-1 text-xs hover:bg-blue-50">Perpanjang</button>
                                </form>
                            <?php elseif($loan->status === 'dipinjam'): ?>
                                <span class="text-xs text-slate-400"><?php echo e($loan->extensionError()); ?></span>
                            <?php else: ?>
                                <span class="text-slate-300 text-xs">-</span>
                            <?php endif; ?>
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
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/siswa/loans/index.blade.php ENDPATH**/ ?>