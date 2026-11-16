<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.app','data' => ['title' => 'Tambah Buku']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Tambah Buku']); ?>
    <p class="text-sm text-slate-400 mb-1">Data Buku / Tambah Buku Baru</p>
    <h1 class="text-2xl font-bold mb-6">Tambah Buku Baru</h1>

    <div class="bg-white rounded-xl border border-slate-200 p-6 max-w-4xl">
        <form method="POST" action="<?php echo e(route('admin.books.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Judul Buku *</label>
                    <input type="text" name="title" value="<?php echo e(old('title')); ?>" required class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Pengarang *</label>
                    <input type="text" name="author" value="<?php echo e(old('author')); ?>" required class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">ISBN</label>
                    <input type="text" name="isbn" value="<?php echo e(old('isbn')); ?>" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Tahun Terbit</label>
                    <input type="text" name="published_year" value="<?php echo e(old('published_year')); ?>" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Penerbit</label>
                    <input type="text" name="publisher" value="<?php echo e(old('publisher')); ?>" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Kategori *</label>
                    <select name="category_id" required class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                        <option value="">Pilih kategori</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php if(old('category_id') == $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Lokasi Rak *</label>
                    <select name="shelf_id" required class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                        <option value="">Pilih rak</option>
                        <?php $__currentLoopData = $shelves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shelf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($shelf->id); ?>" <?php if(old('shelf_id') == $shelf->id): echo 'selected'; endif; ?>><?php echo e($shelf->code); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Jumlah Eksemplar *</label>
                    <input type="number" name="stock" min="0" value="<?php echo e(old('stock', 0)); ?>" required class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Status *</label>
                    <select name="status" required class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                        <option value="tersedia">Tersedia untuk dipinjam</option>
                        <option value="perbaikan">Perbaikan</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Sampul Buku (opsional)</label>
                    <input type="file" name="cover" accept="image/*" class="w-full border border-dashed border-slate-300 rounded-lg px-3 py-6 text-sm text-slate-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Deskripsi / Sinopsis</label>
                    <textarea name="description" rows="4" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"><?php echo e(old('description')); ?></textarea>
                </div>
            </div>

            <p class="text-xs text-red-500 mb-4">*note: field bertanda * wajib diisi</p>

            <div class="flex gap-3">
                <a href="<?php echo e(route('admin.books.index')); ?>" class="border border-slate-300 rounded-lg px-5 py-2 text-sm font-medium hover:bg-slate-50">Batal</a>
                <button type="submit" class="bg-slate-900 text-white rounded-lg px-5 py-2 text-sm font-semibold hover:bg-slate-800">Simpan Data</button>
            </div>
        </form>
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
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/admin/books/create.blade.php ENDPATH**/ ?>