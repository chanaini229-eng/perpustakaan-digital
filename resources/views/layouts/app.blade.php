
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Perpustakaan') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 font-sans antialiased text-slate-800">
    <div class="min-h-screen">

        {{-- Navigasi utama --}}
        @include('layouts.navigation')

        {{-- Header halaman --}}
        @isset($header)
            <header class="border-b border-slate-200 bg-white shadow-sm">
                <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Konten halaman --}}
        <main class="min-h-[70vh]">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="mt-8 border-t border-slate-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 py-5 text-center text-sm text-slate-500 sm:px-6 lg:px-8">
                &copy; {{ date('Y') }} Perpustakaan. Semua hak dilindungi.
            </div>
        </footer>

    </div>
</body>
</html>
