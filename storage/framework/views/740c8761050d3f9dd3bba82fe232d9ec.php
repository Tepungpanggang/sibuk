<div class="bg-white rounded-xl border border-slate-200 p-6 md:col-span-2">
    <h2 class="font-semibold mb-4">Foto Profil</h2>
    <div class="foto-profil">
        <?php if (isset($component)) { $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar','data' => ['user' => $user,'size' => 'lg','id' => 'photoPreview']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user),'size' => 'lg','id' => 'photoPreview']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b)): ?>
<?php $attributes = $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b; ?>
<?php unset($__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b)): ?>
<?php $component = $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b; ?>
<?php unset($__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b); ?>
<?php endif; ?>
        <div class="foto-profil-aksi">
            <form method="POST" action="<?php echo e(route('profile.photo.update')); ?>" enctype="multipart/form-data"
                class="flex flex-wrap items-center gap-3">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <input type="file" id="photoInput" name="photo" accept="image/jpeg,image/png,image/webp" required
                    class="text-sm min-w-0">
                <button type="submit"
                    class="bg-slate-900 text-white rounded-lg px-5 py-2 text-sm font-semibold hover:bg-slate-800">Simpan
                    Foto</button>
            </form>
            <p class="text-xs text-slate-400 mt-3">Format JPG, PNG, atau WEBP. Ukuran maksimal 2 MB.</p>
            <p class="text-xs text-slate-400 mt-1">Tanpa foto, sistem menampilkan inisial username
                (<?php echo e($user->initials); ?>).</p>
            <p id="photoError" class="text-xs text-red-600 mt-1 hidden"></p>
            <?php if($user->photo_path): ?>
                <form method="POST" action="<?php echo e(route('profile.photo.destroy')); ?>" class="mt-3"
                    onsubmit="return confirm('Hapus foto profil dan kembali ke inisial username?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit"
                        class="text-red-600 border border-red-200 rounded-lg px-4 py-2 text-sm hover:bg-red-50">Hapus
                        Foto</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script>
        (function () {
            var input = document.getElementById('photoInput');
            var preview = document.getElementById('photoPreview');
            var error = document.getElementById('photoError');
            var objectUrl = null;

            input.addEventListener('change', function () {
                var file = input.files && input.files[0];

                error.classList.add('hidden');
                error.textContent = '';

                if (!file) {
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    input.value = '';
                    error.textContent = 'Ukuran foto melebihi 2 MB. Pilih foto lain.';
                    error.classList.remove('hidden');
                    return;
                }

                if (objectUrl) {
                    URL.revokeObjectURL(objectUrl);
                }

                objectUrl = URL.createObjectURL(file);

                var image = preview.querySelector('img');

                if (!image) {
                    image = document.createElement('img');
                    image.className = 'avatar-foto';
                    image.alt = 'Pratinjau foto profil';
                    preview.appendChild(image);
                }

                image.src = objectUrl;
            });
        })();
    </script>
</div><?php /**PATH D:\Tugas\sibuk\resources\views/partials/profile-photo.blade.php ENDPATH**/ ?>