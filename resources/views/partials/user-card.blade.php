<a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-100">
    <x-avatar :user="auth()->user()" size="md" />
    <span class="min-w-0">
        <span class="block text-sm font-medium teks-potong">{{ auth()->user()->name }}</span>
        <span class="block text-xs text-slate-400 capitalize">{{ auth()->user()->role }}</span>
    </span>
</a>