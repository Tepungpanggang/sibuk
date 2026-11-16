<x-layouts.app title="Ubah Akun">
    <h1 class="text-2xl font-bold mb-6">Ubah Akun</h1>
    <div class="bg-white rounded-xl border border-slate-200 p-6 max-w-2xl">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Nama *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Username *</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                        autocapitalize="none" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div id="nisField">
                    <label for="nis" class="block text-sm font-medium mb-1">NIS</label>
                    <input type="text" id="nis" name="nis" value="{{ old('nis', $user->nis) }}" inputmode="numeric"
                        pattern="[0-9]*" maxlength="20"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                    <p class="text-xs text-slate-400 mt-1">Khusus siswa. Opsional, hanya angka. Dapat dipakai untuk
                        login. Admin cukup menggunakan username dan email.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Role *</label>
                    <select id="role" name="role" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                        <option value="siswa" @selected(old('role', $user->role) == 'siswa')>Siswa</option>
                        <option value="admin" @selected(old('role', $user->role) == 'admin')>Admin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">No. Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" inputmode="tel"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Alamat</label>
                    <input type="text" name="address" value="{{ old('address', $user->address) }}"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" autocomplete="new-password"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.users.index') }}"
                    class="border border-slate-300 rounded-lg px-5 py-2 text-sm font-medium hover:bg-slate-50">Batal</a>
                <button type="submit"
                    class="bg-slate-900 text-white rounded-lg px-5 py-2 text-sm font-semibold hover:bg-slate-800">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>

    <script>
        (function () {
            var role = document.getElementById('role');
            var nisField = document.getElementById('nisField');
            var nisInput = document.getElementById('nis');

            function sync() {
                var isAdmin = role.value === 'admin';

                nisField.classList.toggle('hidden', isAdmin);
                nisInput.disabled = isAdmin;
            }

            role.addEventListener('change', sync);
            sync();
        })();
    </script>
</x-layouts.app>