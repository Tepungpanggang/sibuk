<x-layouts.app title="Data Anggota">
    <div class="flex items-center justify-between flex-wrap gap-3 mb-4">
        <h1 class="text-2xl font-bold">Data Anggota</h1>
        <a href="{{ route('admin.users.create') }}"
            class="bg-slate-900 text-white rounded-lg px-4 py-2 text-sm font-semibold hover:bg-slate-800">+ Tambah
            Akun</a>
    </div>

    <form method="GET" class="mb-4">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="cari nama, username, NIS, email..."
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
                @foreach($users as $user)
                    <tr class="border-b border-slate-50">
                        <td class="p-3 font-medium" data-label="Nama">{{ $user->name }}</td>
                        <td class="p-3" data-label="Username">{{ $user->username }}</td>
                        <td class="p-3" data-label="NIS">{{ $user->nis ?? '-' }}</td>
                        <td class="p-3" data-label="Email">{{ $user->email }}</td>
                        <td class="p-3 capitalize" data-label="Role">{{ $user->role }}</td>
                        <td class="p-3 space-x-2" data-label="Aksi">
                            <a href="{{ route('admin.users.edit', $user) }}" aria-label="Ubah {{ $user->name }}"
                                class="text-slate-500 hover:text-slate-900">✎</a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline"
                                onsubmit="return confirm('Hapus akun ini?')">
                                @csrf @method('DELETE')
                                <button aria-label="Hapus {{ $user->name }}"
                                    class="text-slate-500 hover:text-red-600">🗑</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3 border-t border-slate-100">{{ $users->links() }}</div>
    </div>
</x-layouts.app>