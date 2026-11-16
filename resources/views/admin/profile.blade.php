<x-layouts.app title="Pengaturan Akun">
    <h1 class="text-2xl font-bold mb-6">Pengaturan Akun</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl">
        @include('partials.profile-photo')

        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <h2 class="font-semibold mb-4">Profil</h2>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">No. Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Alamat</label>
                    <input type="text" name="address" value="{{ old('address', $user->address) }}"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <button
                    class="bg-slate-900 text-white rounded-lg px-5 py-2 text-sm font-semibold hover:bg-slate-800">Simpan
                    Profil</button>
            </form>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <h2 class="font-semibold mb-4">Ubah Password</h2>
            <form method="POST" action="{{ route('profile.password') }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Password Lama</label>
                    <input type="password" name="current_password" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Password Baru</label>
                    <input type="password" name="password" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                </div>
                <button
                    class="bg-slate-900 text-white rounded-lg px-5 py-2 text-sm font-semibold hover:bg-slate-800">Ubah
                    Password</button>
            </form>
        </div>
    </div>
</x-layouts.app>