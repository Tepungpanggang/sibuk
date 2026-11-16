<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#0f172a">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <title>{{ $title ?? 'Dashboard' }} - SIBUK</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsif.css') }}">
</head>

<body class="bg-slate-50 text-slate-800">
    <div class="flex min-h-screen">
        <aside class="sidebar-tetap w-64 bg-white border-r border-slate-200 flex-shrink-0 hidden md:flex md:flex-col">
            <div class="h-16 flex items-center gap-2 px-6 border-b border-slate-200">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo SIBUK" class="w-8 h-8">
                <span class="font-bold text-xl tracking-tight">SIBUK</span>
            </div>
            <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
                @if(auth()->user()->role === 'admin')
                    @include('partials.admin-nav')
                @else
                    @include('partials.siswa-nav')
                @endif
            </nav>
            <div class="p-3 border-t border-slate-200 space-y-1">
                @include('partials.user-card')
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-500 hover:bg-slate-100"><x-icon
                            name="log-out" /><span>Logout</span></button>
                </form>
            </div>
        </aside>
        <div class="flex-1 flex flex-col min-w-0">
            <header
                class="topbar-sticky bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-6">
                <div class="md:hidden flex items-center gap-2">
                    <button type="button" id="menuToggle" aria-label="Buka menu" aria-controls="mobileNav"
                        aria-expanded="false"
                        class="tombol-ikon rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100"><x-icon
                            name="menu" class="ikon-lg" /></button>
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo SIBUK" class="w-7 h-7">
                    <span class="font-bold text-lg">SIBUK</span>
                </div>
                <div class="flex-1"></div>
                <div class="flex items-center gap-3">
                    <button type="button" id="soundToggle" aria-label="Aktifkan atau matikan suara notifikasi"
                        class="tombol-ikon rounded-full border border-slate-200 text-sm hover:bg-slate-100"></button>
                    <span class="text-sm text-slate-600 hidden sm:inline">{{ auth()->user()->name }}</span>
                    <a href="{{ route('profile.edit') }}" aria-label="Pengaturan akun"><x-avatar :user="auth()->user()"
                            size="sm" /></a>
                </div>
            </header>
            <main class="konten-utama flex-1 p-4 md:p-6 anim-fade-up">
                @if (session('status'))
                    <div
                        class="mb-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 text-sm anim-fade-up">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div
                        class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm anim-fade-up">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>

    <div id="mobileNav" class="drawer hidden md:hidden" role="dialog" aria-modal="true" aria-label="Menu navigasi">
        <div class="drawer-backdrop" id="drawerBackdrop"></div>
        <div class="drawer-panel">
            <div class="h-16 flex items-center justify-between gap-2 px-4 border-b border-slate-200 flex-shrink-0">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo SIBUK" class="w-8 h-8">
                    <span class="font-bold text-xl tracking-tight">SIBUK</span>
                </div>
                <button type="button" id="drawerClose" aria-label="Tutup menu"
                    class="tombol-ikon rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100"><x-icon
                        name="x" class="ikon-lg" /></button>
            </div>
            <div class="px-3 pt-3">
                @include('partials.user-card')
            </div>
            <nav class="drawer-nav flex-1 px-3 py-3 space-y-1 text-sm">
                @if(auth()->user()->role === 'admin')
                    @include('partials.admin-nav')
                @else
                    @include('partials.siswa-nav')
                @endif
            </nav>
            <div class="p-3 border-t border-slate-200 flex-shrink-0">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-500 hover:bg-slate-100"><x-icon
                            name="log-out" /><span>Logout</span></button>
                </form>
            </div>
        </div>
    </div>

    <audio id="notifSound" src="{{ asset('audio/notifikasi.wav') }}" preload="auto"></audio>

    <script>
        (function () {
            var menuToggle = document.getElementById('menuToggle');
            var mobileNav = document.getElementById('mobileNav');
            var drawerBackdrop = document.getElementById('drawerBackdrop');
            var drawerClose = document.getElementById('drawerClose');
            var soundToggle = document.getElementById('soundToggle');
            var notifSound = document.getElementById('notifSound');
            var menuOpen = false;
            var soundOn = true;

            try {
                soundOn = localStorage.getItem('sibukSound') !== 'off';
            } catch (e) {
                soundOn = true;
            }

            function setMenu(next) {
                if (next === menuOpen) {
                    return;
                }

                menuOpen = next;
                mobileNav.classList.toggle('hidden', !next);
                document.documentElement.classList.toggle('kunci-gulir', next);
                menuToggle.setAttribute('aria-expanded', String(next));

                if (next) {
                    drawerClose.focus();
                } else {
                    menuToggle.focus();
                }
            }

            function renderSound() {
                soundToggle.textContent = soundOn ? '🔔' : '🔕';
                soundToggle.title = soundOn ? 'Suara notifikasi aktif' : 'Suara notifikasi nonaktif';
                soundToggle.setAttribute('aria-pressed', String(soundOn));
            }

            function playSound() {
                if (!soundOn) {
                    return;
                }

                try {
                    notifSound.currentTime = 0;
                    var result = notifSound.play();

                    if (result && typeof result.catch === 'function') {
                        result.catch(function () { });
                    }
                } catch (e) { }
            }

            menuToggle.addEventListener('click', function () {
                setMenu(!menuOpen);
            });

            drawerClose.addEventListener('click', function () {
                setMenu(false);
            });

            drawerBackdrop.addEventListener('click', function () {
                setMenu(false);
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    setMenu(false);
                    return;
                }

                if (event.key === 'Tab' && menuOpen) {
                    var items = mobileNav.querySelectorAll('a[href], button:not([disabled])');

                    if (!items.length) {
                        return;
                    }

                    var first = items[0];
                    var last = items[items.length - 1];

                    if (event.shiftKey && document.activeElement === first) {
                        event.preventDefault();
                        last.focus();
                    } else if (!event.shiftKey && document.activeElement === last) {
                        event.preventDefault();
                        first.focus();
                    }
                }
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth >= 768) {
                    setMenu(false);
                }
            });

            soundToggle.addEventListener('click', function () {
                soundOn = !soundOn;

                try {
                    localStorage.setItem('sibukSound', soundOn ? 'on' : 'off');
                } catch (e) { }

                renderSound();
                playSound();
            });

            renderSound();

            @if (session('status') || $errors->any())
                playSound();
            @endif
        })();
    </script>
</body>

</html>