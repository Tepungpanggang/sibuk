<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.app','data' => ['title' => 'Katalog Buku']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Katalog Buku']); ?>
    <h1 class="text-2xl font-bold mb-6">Katalog Buku</h1>

    <form method="GET" class="flex flex-wrap gap-3 mb-6">
        <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="cari judul atau pengarang..."
            class="flex-1 min-w-[200px] border border-slate-300 rounded-lg px-3 py-2 text-sm">
        <select name="category_id" class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php if(request('category_id') == $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button class="border border-slate-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-slate-50">Cari</button>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('siswa.catalog.show', $book)); ?>" class="anim-card bg-white rounded-xl border border-slate-200 p-4">
                <img src="<?php echo e($book->cover_url); ?>" alt="Sampul <?php echo e($book->title); ?>" loading="lazy" class="w-full h-48 object-cover rounded-lg mb-3">
                <p class="text-xs text-slate-400 mb-1"><?php echo e($book->category->name); ?></p>
                <h3 class="font-semibold mb-1"><?php echo e($book->title); ?></h3>
                <p class="text-sm text-slate-500 mb-3"><?php echo e($book->author); ?></p>
                <div class="flex items-center justify-between">
                    <span class="text-xs border rounded-full px-2 py-0.5 <?php echo e($book->status === 'tersedia' ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-red-50 text-red-600 border-red-200'); ?>">
                        <?php echo e($book->status === 'tersedia' ? 'Tersedia' : ucfirst($book->status)); ?>

                    </span>
                    <span class="text-xs text-slate-400">Stok: <?php echo e($book->stock); ?></span>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-6"><?php echo e($books->links()); ?></div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/siswa/catalog/index.blade.php ENDPATH**/ ?>