<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.app','data' => ['title' => 'Data Anggota']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Anggota']); ?>
    <div class="flex items-center justify-between flex-wrap gap-3 mb-4">
        <h1 class="text-2xl font-bold">Data Anggota</h1>
        <a href="<?php echo e(route('admin.users.create')); ?>"
            class="bg-slate-900 text-white rounded-lg px-4 py-2 text-sm font-semibold hover:bg-slate-800">+ Tambah
            Akun</a>
    </div>

    <form method="GET" class="mb-4">
        <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="cari nama, username, NIS, email..."
            class="w-full max-w-sm border border-slate-300 rounded-lg px-3 py-2 text-sm">
    </form>

    <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto">
        <table class="tabel-kartu w-full text-sm">
            <thead>
                <tr class="text-left text-slate-500 border-b border-slate-100">
                    <th class="p-3 font-medium">Nama</th>
                    <th class="p-3 font-medium">Username</th>
                    <th class="p-3 font-medium">NIS</th>
                    <th class="p-3 font-medium">Email</th>
                    <th class="p-3 font-medium">Role</th>
                    <th class="p-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b border-slate-50">
                        <td class="p-3 font-medium" data-label="Nama"><?php echo e($user->name); ?></td>
                        <td class="p-3" data-label="Username"><?php echo e($user->username); ?></td>
                        <td class="p-3" data-label="NIS"><?php echo e($user->nis ?? '-'); ?></td>
                        <td class="p-3" data-label="Email"><?php echo e($user->email); ?></td>
                        <td class="p-3 capitalize" data-label="Role"><?php echo e($user->role); ?></td>
                        <td class="p-3 space-x-2" data-label="Aksi">
                            <a href="<?php echo e(route('admin.users.edit', $user)); ?>" aria-label="Ubah <?php echo e($user->name); ?>"
                                class="text-slate-500 hover:text-slate-900">✎</a>
                            <form method="POST" action="<?php echo e(route('admin.users.destroy', $user)); ?>" class="inline"
                                onsubmit="return confirm('Hapus akun ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button aria-label="Hapus <?php echo e($user->name); ?>"
                                    class="text-slate-500 hover:text-red-600">🗑</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="p-3 border-t border-slate-100"><?php echo e($users->links()); ?></div>
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
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/admin/users/index.blade.php ENDPATH**/ ?>