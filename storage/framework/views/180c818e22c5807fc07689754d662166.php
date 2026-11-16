<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.app','data' => ['title' => 'Pengajuan & Peminjaman']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pengajuan & Peminjaman']); ?>
    <h1 class="text-2xl font-bold mb-6">Pengajuan &amp; Peminjaman</h1>

    <form method="GET" class="mb-4">
        <select name="status" onchange="this.form.submit()"
            class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="pending" <?php if(request('status') == 'pending'): echo 'selected'; endif; ?>>Pending</option>
            <option value="approved" <?php if(request('status') == 'approved'): echo 'selected'; endif; ?>>Approved</option>
            <option value="rejected" <?php if(request('status') == 'rejected'): echo 'selected'; endif; ?>>Rejected</option>
            <option value="dipinjam" <?php if(request('status') == 'dipinjam'): echo 'selected'; endif; ?>>Dipinjam</option>
            <option value="dikembalikan" <?php if(request('status') == 'dikembalikan'): echo 'selected'; endif; ?>>Dikembalikan</option>
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
                <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b border-slate-50">
                        <td class="p-3" data-label="Siswa"><?php echo e($loan->user->name); ?></td>
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
                        <td class="p-3 space-x-1" data-label="Aksi">
                            <?php if($loan->status === 'pending'): ?>
                                <form method="POST" action="<?php echo e(route('admin.loans.approve', $loan)); ?>" class="inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <button
                                        class="text-emerald-600 border border-emerald-200 rounded-full px-3 py-1 text-xs hover:bg-emerald-50">Terima</button>
                                </form>
                                <form method="POST" action="<?php echo e(route('admin.loans.reject', $loan)); ?>"
                                    class="inline-flex items-center gap-1">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <input type="text" name="notes" maxlength="255" placeholder="Alasan (opsional)"
                                        class="border border-slate-200 rounded-full px-2 py-1 text-xs w-36">
                                    <button
                                        class="text-red-600 border border-red-200 rounded-full px-3 py-1 text-xs hover:bg-red-50">Tolak</button>
                                </form>
                            <?php elseif($loan->status === 'rejected'): ?>
                                <form method="POST" action="<?php echo e(route('admin.loans.reprocess', $loan)); ?>" class="inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <button
                                        class="text-slate-600 border border-slate-200 rounded-full px-3 py-1 text-xs hover:bg-slate-50">Proses
                                        Ulang</button>
                                </form>
                            <?php elseif($loan->status === 'approved'): ?>
                                <form method="POST" action="<?php echo e(route('admin.loans.hand-over', $loan)); ?>" class="inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <button
                                        class="text-blue-600 border border-blue-200 rounded-full px-3 py-1 text-xs hover:bg-blue-50">Serahkan
                                        Buku</button>
                                </form>
                            <?php elseif($loan->status === 'dipinjam'): ?>
                                <?php if($loan->canExtend()): ?>
                                    <form method="POST" action="<?php echo e(route('admin.loans.extend', $loan)); ?>" class="inline"
                                        onsubmit="return confirm('Perpanjang masa peminjaman <?php echo e(\App\Models\Loan::EXTENSION_DAYS); ?> hari?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                        <button
                                            class="text-blue-600 border border-blue-200 rounded-full px-3 py-1 text-xs hover:bg-blue-50">Perpanjang</button>
                                    </form>
                                <?php endif; ?>
                                <form method="POST" action="<?php echo e(route('admin.loans.return', $loan)); ?>" class="inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <button
                                        class="text-slate-600 border border-slate-200 rounded-full px-3 py-1 text-xs hover:bg-slate-50">Catat
                                        Kembali</button>
                                </form>
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
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/admin/loans/index.blade.php ENDPATH**/ ?>