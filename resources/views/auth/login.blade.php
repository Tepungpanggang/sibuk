<x-layouts.auth>
    <div class="login-halaman">
        <section class="login-hero">
            <div class="login-merek">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo SIBUK" class="login-logo">
                <div>
                    <p class="login-nama">SIBUK</p>
                    <p class="login-singkatan">Sistem Informasi BUku dan Kepustakaan</p>
                </div>
            </div>

            <div class="login-pesan">
                <h1>Ajukan dari mana saja, ambil di perpustakaan.</h1>
                @if (config('sibuk.school_name'))
                    <p class="login-sekolah">Perpustakaan {{ config('sibuk.school_name') }}</p>
                @endif

                <dl class="login-aturan">
                    <div>
                        <dt>Masa pinjam</dt>
                        <dd>{{ \App\Models\Loan::LOAN_DAYS }} hari</dd>
                    </div>
                    <div>
                        <dt>Perpanjangan</dt>
                        <dd>{{ \App\Models\Loan::MAX_EXTENSIONS }} kali, {{ \App\Models\Loan::EXTENSION_DAYS }} hari
                        </dd>
                    </div>
                    <div>
                        <dt>Denda keterlambatan</dt>
                        <dd>Rp {{ number_format(\App\Models\Loan::FINE_PER_DAY, 0, ',', '.') }} per hari</dd>
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

                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.attempt') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="login" class="login-label">Username / Email / NIS</label>
                        <div class="login-input-wadah">
                            <span class="login-input-ikon"><x-icon name="user" /></span>
                            <input type="text" id="login" name="login" value="{{ old('login') }}" required
                                autocomplete="username" autocapitalize="none" autocorrect="off" spellcheck="false"
                                class="login-input" placeholder="Masukkan username, email, atau NIS">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="login-label">Kata Sandi</label>
                        <div class="login-input-wadah">
                            <span class="login-input-ikon"><x-icon name="lock" /></span>
                            <input type="password" id="password" name="password" required
                                autocomplete="current-password" class="login-input" placeholder="Masukkan kata sandi">
                            <button type="button" id="togglePassword" class="login-toggle"
                                aria-label="Tampilkan kata sandi" aria-pressed="false">
                                <span id="iconTampil"><x-icon name="eye" /></span>
                                <span id="iconSembunyi" class="hidden"><x-icon name="eye-off" /></span>
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
                &copy; {{ date('Y') }} SIBUK
                @if (config('sibuk.school_name'))
                    &middot; {{ config('sibuk.school_name') }}
                @endif
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
</x-layouts.auth>