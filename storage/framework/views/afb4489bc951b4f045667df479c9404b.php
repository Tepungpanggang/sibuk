<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.app','data' => ['title' => 'Kategori / Rak']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kategori / Rak']); ?>
    <h1 class="text-2xl font-bold mb-6">Kategori &amp; Lokasi Rak</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <h2 class="font-semibold mb-3">Kategori</h2>
            <form method="POST" action="<?php echo e(route('admin.categories.store')); ?>" class="flex gap-2 mb-4">
                <?php echo csrf_field(); ?>
                <input type="text" name="name" placeholder="Nama kategori baru" required
                    class="flex-1 min-w-0 border border-slate-300 rounded-lg px-3 py-2 text-sm">
                <button
                    class="bg-slate-900 text-white rounded-lg px-4 py-2 text-sm font-semibold hover:bg-slate-800">Tambah</button>
            </form>
            <div class="overflow-x-auto">
                <table class="tabel-kartu w-full text-sm">
                    <thead>
                        <tr class="text-left text-slate-500 border-b border-slate-100">
                            <th class="pb-2 font-medium">Nama</th>
                            <th class="pb-2 font-medium">Jumlah Buku</th>
                            <th class="pb-2 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b border-slate-50">
                                <td class="py-2" data-label="Nama">
                                    <form method="POST" action="<?php echo e(route('admin.categories.update', $category)); ?>"
                                        class="flex items-center gap-2">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                        <input type="text" name="name" value="<?php echo e($category->name); ?>"
                                            aria-label="Nama kategori"
                                            class="border border-transparent hover:border-slate-200 rounded px-1 py-0.5 w-full">
                                        <button
                                            class="text-slate-500 hover:text-slate-900 text-xs whitespace-nowrap">Simpan</button>
                                    </form>
                                </td>
                                <td class="py-2" data-label="Jumlah Buku"><?php echo e($category->books_count); ?></td>
                                <td class="py-2" data-label="Aksi">
                                    <form method="POST" action="<?php echo e(route('admin.categories.destroy', $category)); ?>"
                                        class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="text-slate-500 hover:text-red-600 text-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <h2 class="font-semibold mb-3">Lokasi Rak</h2>
            <form method="POST" action="<?php echo e(route('admin.shelves.store')); ?>" class="flex gap-2 mb-4">
                <?php echo csrf_field(); ?>
                <input type="text" name="code" placeholder="Kode rak" required
                    class="w-28 min-w-0 border border-slate-300 rounded-lg px-3 py-2 text-sm">
                <input type="text" name="location" placeholder="Lokasi"
                    class="flex-1 min-w-0 border border-slate-300 rounded-lg px-3 py-2 text-sm">
                <button
                    class="bg-slate-900 text-white rounded-lg px-4 py-2 text-sm font-semibold hover:bg-slate-800">Tambah</button>
            </form>
            <div class="overflow-x-auto">
                <table class="tabel-kartu w-full text-sm">
                    <thead>
                        <tr class="text-left text-slate-500 border-b border-slate-100">
                            <th class="pb-2 font-medium">Kode</th>
                            <th class="pb-2 font-medium">Lokasi</th>
                            <th class="pb-2 font-medium">Jumlah Buku</th>
                            <th class="pb-2 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $shelves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shelf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b border-slate-50">
                                <td class="py-2" data-label="Kode">
                                    <form id="shelf-form-<?php echo e($shelf->id); ?>" method="POST" class="hidden"
                                        action="<?php echo e(route('admin.shelves.update', $shelf)); ?>">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                    </form>
                                    <input type="text" name="code" value="<?php echo e($shelf->code); ?>" aria-label="Kode rak"
                                        form="shelf-form-<?php echo e($shelf->id); ?>"
                                        class="border border-transparent hover:border-slate-200 rounded px-1 py-0.5 w-full">
                                </td>
                                <td class="py-2" data-label="Lokasi">
                                    <input type="text" name="location" value="<?php echo e($shelf->location); ?>"
                                        aria-label="Lokasi rak" form="shelf-form-<?php echo e($shelf->id); ?>"
                                        class="border border-transparent hover:border-slate-200 rounded px-1 py-0.5 w-full">
                                </td>
                                <td class="py-2" data-label="Jumlah Buku"><?php echo e($shelf->books_count); ?></td>
                                <td class="py-2 space-x-2 whitespace-nowrap" data-label="Aksi">
                                    <button type="submit" form="shelf-form-<?php echo e($shelf->id); ?>"
                                        class="text-slate-500 hover:text-slate-900 text-xs">Simpan</button>
                                    <form method="POST" action="<?php echo e(route('admin.shelves.destroy', $shelf)); ?>" class="inline"
                                        onsubmit="return confirm('Hapus rak ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="text-slate-500 hover:text-red-600 text-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
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
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>