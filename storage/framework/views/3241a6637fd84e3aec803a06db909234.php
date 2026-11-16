<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.app','data' => ['title' => 'Pengaturan Akun']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pengaturan Akun']); ?>
    <h1 class="text-2xl font-bold mb-6">Pengaturan Akun</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl">
        <?php echo $__env->make('partials.profile-photo', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <h2 class="font-semibold mb-4">Profil</h2>
            <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Nama</label>
                    <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">No. Telepon</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Alamat</label>
                    <input type="text" name="address" value="<?php echo e(old('address', $user->address)); ?>"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <button
                    class="bg-slate-900 text-white rounded-lg px-5 py-2 text-sm font-semibold hover:bg-slate-800">Simpan
                    Profil</button>
            </form>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <h2 class="font-semibold mb-4">Ubah Password</h2>
            <form method="POST" action="<?php echo e(route('profile.password')); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Password Lama</label>
                    <input type="password" name="current_password" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Password Baru</label>
                    <input type="password" name="password" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <button
                    class="bg-slate-900 text-white rounded-lg px-5 py-2 text-sm font-semibold hover:bg-slate-800">Ubah
                    Password</button>
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
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/siswa/profile.blade.php ENDPATH**/ ?>