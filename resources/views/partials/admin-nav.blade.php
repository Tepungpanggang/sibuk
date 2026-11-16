<a href="{{ route('admin.dashboard') }}" @if(request()->routeIs('admin.dashboard')) aria-current="page" @endif
    class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100' }}"><x-icon
        name="home" /><span>Dashboard</span></a>
<a href="{{ route('admin.books.index') }}" @if(request()->routeIs('admin.books.*')) aria-current="page" @endif
    class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.books.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100' }}"><x-icon
        name="book" /><span>Data Buku</span></a>
<a href="{{ route('admin.users.index') }}" @if(request()->routeIs('admin.users.*')) aria-current="page" @endif
    class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100' }}"><x-icon
        name="users" /><span>Data Anggota</span></a>
<a href="{{ route('admin.categories.index') }}" @if(request()->routeIs('admin.categories.*')) aria-current="page" @endif
    class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100' }}"><x-icon
        name="layers" /><span>Kategori / Rak</span></a>
<div class="pt-3 mt-3 border-t border-slate-100 text-xs font-semibold text-slate-400 px-3">Transaksi</div>
<a href="{{ route('admin.loans.index') }}" @if(request()->routeIs('admin.loans.*')) aria-current="page" @endif
    class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.loans.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100' }}"><x-icon
        name="clipboard" /><span>Pengajuan &amp; Peminjaman</span></a>
<a href="{{ route('admin.fines.index') }}" @if(request()->routeIs('admin.fines.*')) aria-current="page" @endif
    class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.fines.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100' }}"><x-icon
        name="dollar" /><span>Denda</span></a>
<div class="pt-3 mt-3 border-t border-slate-100 text-xs font-semibold text-slate-400 px-3">Laporan</div>
<a href="{{ route('admin.reports.index') }}" @if(request()->routeIs('admin.reports.*')) aria-current="page" @endif
    class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.reports.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100' }}"><x-icon
        name="file-text" /><span>Rekap &amp; Laporan</span></a>
<a href="{{ route('profile.edit') }}" @if(request()->routeIs('profile.*')) aria-current="page" @endif
    class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('profile.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-100' }}"><x-icon
        name="user" /><span>Pengaturan Akun</span></a>