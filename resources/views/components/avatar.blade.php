@props(['user', 'size' => 'sm'])
<span {{ $attributes->merge(['class' => 'avatar avatar-' . $size]) }}>
    <span class="avatar-inisial" aria-hidden="true">{{ $user->initials }}</span>
    @if($user->photo_url)
        <img src="{{ $user->photo_url }}" alt="Foto profil {{ $user->username }}" class="avatar-foto"
            onerror="this.remove()">
    @endif
</span>