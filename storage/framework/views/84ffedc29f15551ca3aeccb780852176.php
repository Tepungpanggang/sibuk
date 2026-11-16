<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.app','data' => ['title' => 'Data Buku']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Buku']); ?>
    <div class="flex items-center justify-between flex-wrap gap-3 mb-4">
        <div>
            <h1 class="text-2xl font-bold">Data Buku</h1>
            <p class="text-sm text-slate-500">Total <?php echo e($books->total()); ?> judul buku terdaftar</p>
        </div>
        <a href="<?php echo e(route('admin.books.create')); ?>"
            class="bg-slate-900 text-white rounded-lg px-4 py-2 text-sm font-semibold hover:bg-slate-800">+ Tambah
            Buku</a>
    </div>

    <form method="GET" class="flex flex-wrap gap-3 mb-4">
        <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="cari judul, pengarang, ISBN..."
            class="flex-1 min-w-[200px] border border-slate-300 rounded-lg px-3 py-2 text-sm">
        <select name="category_id" class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Kategori</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php if(request('category_id') == $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <select name="status" class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Status</option>
            <option value="tersedia" <?php if(request('status') == 'tersedia'): echo 'selected'; endif; ?>>Tersedia</option>
            <option value="dipinjam" <?php if(request('status') == 'dipinjam'): echo 'selected'; endif; ?>>Dipinjam</option>
            <option value="perbaikan" <?php if(request('status') == 'perbaikan'): echo 'selected'; endif; ?>>Perbaikan</option>
        </select>
        <button
            class="border border-slate-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-slate-50">Filter</button>
    </form>

    <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto">
        <table class="tabel-kartu w-full text-sm">
            <thead>
                <tr class="text-left text-slate-500 border-b border-slate-100">
                    <th class="p-3 font-medium">No.</th>
                    <th class="p-3 font-medium">Sampul</th>
                    <th class="p-3 font-medium">Judul Buku</th>
                    <th class="p-3 font-medium">Pengarang</th>
                    <th class="p-3 font-medium">Kategori</th>
                    <th class="p-3 font-medium">Stok</th>
                    <th class="p-3 font-medium">Status</th>
                    <th class="p-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b border-slate-50">
                        <td class="p-3" data-label="No."><?php echo e($books->firstItem() + $index); ?></td>
                        <td class="p-3" data-label="Sampul"><img src="<?php echo e($book->cover_url); ?>"
                                alt="Sampul <?php echo e($book->title); ?>" loading="lazy" class="w-10 h-14 object-cover rounded"></td>
                        <td class="p-3 font-medium" data-label="Judul Buku"><?php echo e($book->title); ?></td>
                        <td class="p-3" data-label="Pengarang"><?php echo e($book->author); ?></td>
                        <td class="p-3" data-label="Kategori"><?php echo e($book->category->name); ?></td>
                        <td class="p-3" data-label="Stok"><?php echo e($book->stock); ?></td>
                        <td class="p-3" data-label="Status">
                            <?php
                                $badge = ['tersedia' => 'bg-emerald-50 text-emerald-600 border-emerald-200', 'dipinjam' => 'bg-red-50 text-red-600 border-red-200', 'perbaikan' => 'bg-slate-100 text-slate-500 border-slate-200'];
                            ?>
                            <span
                                class="text-xs border rounded-full px-2 py-0.5 <?php echo e($badge[$book->status]); ?>"><?php echo e(ucfirst($book->status)); ?></span>
                        </td>
                        <td class="p-3 space-x-2" data-label="Aksi">
                            <a href="<?php echo e(route('admin.books.edit', $book)); ?>" aria-label="Ubah <?php echo e($book->title); ?>"
                                class="text-slate-500 hover:text-slate-900">✎</a>
                            <form method="POST" action="<?php echo e(route('admin.books.destroy', $book)); ?>" class="inline"
                                onsubmit="return confirm('Hapus buku ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button aria-label="Hapus <?php echo e($book->title); ?>"
                                    class="text-slate-500 hover:text-red-600">🗑</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div
            class="p-3 flex items-center justify-between flex-wrap gap-2 text-sm text-slate-500 border-t border-slate-100">
            <span>Menampilkan <?php echo e($books->firstItem() ?? 0); ?>-<?php echo e($books->lastItem() ?? 0); ?> dari <?php echo e($books->total()); ?>

                data</span>
            <div><?php echo e($books->links()); ?></div>
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
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/admin/books/index.blade.php ENDPATH**/ ?>