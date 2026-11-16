<?php if (isset($component)) { $__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'layouts.auth','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.auth'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="login-halaman">
        <section class="login-hero">
            <div class="login-merek">
                <img src="<?php echo e(asset('images/logo.svg')); ?>" alt="Logo SIBUK" class="login-logo">
                <div>
                    <p class="login-nama">SIBUK</p>
                    <p class="login-singkatan">Sistem Informasi BUku dan Kepustakaan</p>
                </div>
            </div>

            <div class="login-pesan">
                <h1>Ajukan dari mana saja, ambil di perpustakaan.</h1>
                <?php if(config('sibuk.school_name')): ?>
                    <p class="login-sekolah">Perpustakaan <?php echo e(config('sibuk.school_name')); ?></p>
                <?php endif; ?>

                <dl class="login-aturan">
                    <div>
                        <dt>Masa pinjam</dt>
                        <dd><?php echo e(\App\Models\Loan::LOAN_DAYS); ?> hari</dd>
                    </div>
                    <div>
                        <dt>Perpanjangan</dt>
                        <dd><?php echo e(\App\Models\Loan::MAX_EXTENSIONS); ?> kali, <?php echo e(\App\Models\Loan::EXTENSION_DAYS); ?> hari
                        </dd>
                    </div>
                    <div>
                        <dt>Denda keterlambatan</dt>
                        <dd>Rp <?php echo e(number_format(\App\Models\Loan::FINE_PER_DAY, 0, ',', '.')); ?> per hari</dd>
                    </div>
                </dl>
            </div>

            <div class="login-rak" aria-hidden="true">
                <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
            </div>
        </section>

        <section class="login-form-area">
            <div class="login-kartu anim-fade-up">
                <h2>Masuk ke Akun</h2>
                <p class="login-pengantar">Login untuk Admin (Petugas) atau Siswa (User)</p>

                <?php if($errors->any()): ?>
                    <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('login.attempt')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label for="login" class="login-label">Username / Email / NIS</label>
                        <div class="login-input-wadah">
                            <span class="login-input-ikon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'user']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'user']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span>
                            <input type="text" id="login" name="login" value="<?php echo e(old('login')); ?>" required
                                autocomplete="username" autocapitalize="none" autocorrect="off" spellcheck="false"
                                class="login-input" placeholder="Masukkan username, email, atau NIS">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="login-label">Kata Sandi</label>
                        <div class="login-input-wadah">
                            <span class="login-input-ikon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'lock']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lock']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span>
                            <input type="password" id="password" name="password" required
                                autocomplete="current-password" class="login-input" placeholder="Masukkan kata sandi">
                            <button type="button" id="togglePassword" class="login-toggle"
                                aria-label="Tampilkan kata sandi" aria-pressed="false">
                                <span id="iconTampil"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'eye']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'eye']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span>
                                <span id="iconSembunyi" class="hidden"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'eye-off']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'eye-off']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-5 text-sm">
                        <label class="flex items-center gap-2 text-slate-600">
                            <input type="checkbox" name="remember" class="rounded border-slate-300"> Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="login-tombol">Masuk</button>
                </form>

                <p class="login-info">Admin masuk dengan username atau email. Siswa dapat masuk dengan username, email,
                    atau NIS. Belum punya akun? Hubungi petugas perpustakaan.</p>
            </div>
            <p class="login-footer">
                &copy; <?php echo e(date('Y')); ?> SIBUK
                <?php if(config('sibuk.school_name')): ?>
                    &middot; <?php echo e(config('sibuk.school_name')); ?>

                <?php endif; ?>
            </p>
        </section>
    </div>

    <script>
        (function () {
            var toggle = document.getElementById('togglePassword');
            var input = document.getElementById('password');
            var iconTampil = document.getElementById('iconTampil');
            var iconSembunyi = document.getElementById('iconSembunyi');

            toggle.addEventListener('click', function () {
                var tampil = input.type === 'password';

                input.type = tampil ? 'text' : 'password';
                iconTampil.classList.toggle('hidden', tampil);
                iconSembunyi.classList.toggle('hidden', !tampil);
                toggle.setAttribute('aria-pressed', String(tampil));
                toggle.setAttribute('aria-label', tampil ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
            });
        })();
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162)): ?>
<?php $attributes = $__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162; ?>
<?php unset($__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162)): ?>
<?php $component = $__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162; ?>
<?php unset($__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162); ?>
<?php endif; ?><?php /**PATH D:\Tugas\sibuk\resources\views/auth/login.blade.php ENDPATH**/ ?>