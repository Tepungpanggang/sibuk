<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.app','data' => ['title' => 'Tambah Akun']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Tambah Akun']); ?>
    <h1 class="text-2xl font-bold mb-6">Tambah Akun Baru</h1>
    <div class="bg-white rounded-xl border border-slate-200 p-6 max-w-2xl">
        <form method="POST" action="<?php echo e(route('admin.users.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Nama *</label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Username *</label>
                    <input type="text" name="username" value="<?php echo e(old('username')); ?>" required autocapitalize="none"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div id="nisField">
                    <label for="nis" class="block text-sm font-medium mb-1">NIS</label>
                    <input type="text" id="nis" name="nis" value="<?php echo e(old('nis')); ?>" inputmode="numeric" pattern="[0-9]*"
                        maxlength="20" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                    <p class="text-xs text-slate-400 mt-1">Khusus siswa. Opsional, hanya angka. Dapat dipakai untuk
                        login. Admin cukup menggunakan username dan email.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Email *</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Role *</label>
                    <select id="role" name="role" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                        <option value="siswa" <?php if(old('role') == 'siswa'): echo 'selected'; endif; ?>>Siswa</option>
                        <option value="admin" <?php if(old('role') == 'admin'): echo 'selected'; endif; ?>>Admin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">No. Telepon</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" inputmode="tel"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Alamat</label>
                    <input type="text" name="address" value="<?php echo e(old('address')); ?>"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Password *</label>
                    <input type="password" name="password" required autocomplete="new-password"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
            </div>
            <div class="flex gap-3">
                <a href="<?php echo e(route('admin.users.index')); ?>"
                    class="border border-slate-300 rounded-lg px-5 py-2 text-sm font-medium hover:bg-slate-50">Batal</a>
                <button type="submit"
                    class="bg-slate-900 text-white rounded-lg px-5 py-2 text-sm font-semibold hover:bg-slate-800">Simpan
                    Data</button>
            </div>
        </form>
    </div>

    <script>
        (function () {
            var role = document.getElementById('role');
            var nisField = document.getElementById('nisField');
            var nisInput = document.getElementById('nis');

            function sync() {
                var isAdmin = role.value === 'admin';

                nisField.classList.toggle('hidden', isAdmin);
                nisInput.disabled = isAdmin;
            }

            role.addEventListener('change', sync);
            sync();
        })();
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/admin/users/create.blade.php ENDPATH**/ ?>