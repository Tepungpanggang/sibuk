<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#0f172a">
    <title>Akses Ditolak</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsif.css') }}">
</head>

<body class="bg-slate-50 flex items-center justify-center min-h-screen">
    <div class="text-center px-4">
        <p class="text-6xl font-bold text-slate-300 mb-4">403</p>
        <p class="text-slate-600 mb-6">Anda tidak memiliki akses ke halaman ini.</p>
        <a href="{{ url('/') }}" class="bg-slate-900 text-white rounded-lg px-5 py-2 text-sm font-semibold">Kembali</a>
    </div>
</body>

</html>