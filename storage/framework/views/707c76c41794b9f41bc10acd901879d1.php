<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.app','data' => ['title' => 'Detail Buku']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Detail Buku']); ?>
    <a href="<?php echo e(route('siswa.catalog.index')); ?>" class="text-sm text-slate-500 hover:underline">← Kembali ke katalog</a>

    <div class="bg-white rounded-xl border border-slate-200 p-6 mt-4 max-w-3xl flex flex-col sm:flex-row gap-6">
        <img src="<?php echo e($book->cover_url); ?>" alt="Sampul <?php echo e($book->title); ?>" class="w-40 h-56 object-cover rounded-lg flex-shrink-0 mx-auto sm:mx-0">

        <div class="flex-1 min-w-0">
            <p class="text-xs text-slate-400 mb-1"><?php echo e($book->category->name); ?> • Rak <?php echo e($book->shelf->code); ?></p>
            <h1 class="text-2xl font-bold mb-1"><?php echo e($book->title); ?></h1>
            <p class="text-slate-500 mb-4"><?php echo e($book->author); ?></p>

            <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                <div><span class="text-slate-400">ISBN:</span> <?php echo e($book->isbn ?? '-'); ?></div>
                <div><span class="text-slate-400">Tahun Terbit:</span> <?php echo e($book->published_year ?? '-'); ?></div>
                <div><span class="text-slate-400">Penerbit:</span> <?php echo e($book->publisher ?? '-'); ?></div>
                <div><span class="text-slate-400">Stok:</span> <?php echo e($book->stock); ?></div>
            </div>

            <?php if($book->description): ?>
                <p class="text-sm text-slate-600 mb-6"><?php echo e($book->description); ?></p>
            <?php endif; ?>

            <span class="inline-block text-xs border rounded-full px-2 py-0.5 mb-4 <?php echo e($book->status === 'tersedia' ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-red-50 text-red-600 border-red-200'); ?>">
                <?php echo e($book->status === 'tersedia' ? 'Tersedia' : ucfirst($book->status)); ?>

            </span>

            <form method="POST" action="<?php echo e(route('siswa.loans.store', $book)); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" <?php if($book->status !== 'tersedia' || $book->stock < 1): echo 'disabled'; endif; ?>
                    class="bg-slate-900 text-white rounded-lg px-5 py-2 text-sm font-semibold hover:bg-slate-800 disabled:opacity-40 disabled:cursor-not-allowed">
                    Ajukan Peminjaman
                </button>
            </form>
        </div>
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
<?php endif; ?>
<?php /**PATH D:\Tugas\sibuk\resources\views/siswa/catalog/show.blade.php ENDPATH**/ ?>