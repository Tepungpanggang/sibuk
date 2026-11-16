<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['user', 'size' => 'sm']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['user', 'size' => 'sm']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<span <?php echo e($attributes->merge(['class' => 'avatar avatar-' . $size])); ?>>
    <span class="avatar-inisial" aria-hidden="true"><?php echo e($user->initials); ?></span>
    <?php if($user->photo_url): ?>
        <img src="<?php echo e($user->photo_url); ?>" alt="Foto profil <?php echo e($user->username); ?>" class="avatar-foto"
            onerror="this.remove()">
    <?php endif; ?>
</span><?php /**PATH D:\Tugas\sibuk\resources\views/components/avatar.blade.php ENDPATH**/ ?>