<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.app','data' => ['title' => 'Denda']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Denda']); ?>
    <h1 class="text-2xl font-bold mb-6">Denda Keterlambatan</h1>

    <form method="GET" class="mb-4">
        <select name="status" onchange="this.form.submit()"
            class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="unpaid" <?php if(request('status') == 'unpaid'): echo 'selected'; endif; ?>>Belum Lunas</option>
            <option value="paid" <?php if(request('status') == 'paid'): echo 'selected'; endif; ?>>Lunas</option>
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
                <?php $__currentLoopData = $fines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b border-slate-50">
                        <td class="p-3" data-label="Siswa"><?php echo e($fine->loan->user->name); ?></td>
                        <td class="p-3" data-label="Buku"><?php echo e($fine->loan->book->title); ?></td>
                        <td class="p-3" data-label="Telat (hari)"><?php echo e($fine->days_late); ?></td>
                        <td class="p-3" data-label="Denda">Rp <?php echo e(number_format($fine->amount, 0, ',', '.')); ?></td>
                        <td class="p-3" data-label="Status">
                            <span
                                class="text-xs border rounded-full px-2 py-0.5 <?php echo e($fine->status === 'paid' ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-red-50 text-red-600 border-red-200'); ?>">
                                <?php echo e($fine->status === 'paid' ? 'Lunas' : 'Belum Lunas'); ?>

                            </span>
                        </td>
                        <td class="p-3" data-label="Aksi">
                            <?php if($fine->status === 'unpaid'): ?>
                                <form method="POST" action="<?php echo e(route('admin.fines.paid', $fine)); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <button
                                        class="text-emerald-600 border border-emerald-200 rounded-full px-3 py-1 text-xs hover:bg-emerald-50">Tandai
                                        Lunas</button>
                                </form>
                            <?php else: ?>
                                <span class="text-slate-300 text-xs">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="p-3 border-t border-slate-100"><?php echo e($fines->links()); ?></div>
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
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/admin/fines/index.blade.php ENDPATH**/ ?>