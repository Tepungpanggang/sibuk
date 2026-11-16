<a href="{{ route('siswa.dashboard') }}" @if(request()->routeIs('siswa.dashboard')) aria-current="page" @endif
    class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('siswa.dashboard') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100' }}"><x-icon
        name="home" /><span>Dashboard</span></a>
<a href="{{ route('siswa.catalog.index') }}" @if(request()->routeIs('siswa.catalog.*')) aria-current="page" @endif
    class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('siswa.catalog.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100' }}"><x-icon
        name="book-open" /><span>Katalog Buku</span></a>
<a href="{{ route('siswa.loans.index') }}" @if(request()->routeIs('siswa.loans.*')) aria-current="page" @endif
    class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('siswa.loans.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100' }}"><x-icon
        name="bookmark" /><span>Peminjaman Saya</span></a>
<a href="{{ route('profile.edit') }}" @if(request()->routeIs('profile.*')) aria-current="page" @endif
    class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('profile.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100' }}"><x-icon
        name="user" /><span>Pengaturan Akun</span></a>