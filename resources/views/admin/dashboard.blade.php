
<x-app-layout>
    {{-- Header halaman --}}
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <span>Perpustakaan</span>
                <span>/</span>
                <span class="font-medium text-blue-900">Dashboard</span>
            </div>

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Dashboard Admin
            </h2>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-100">
        <div class="mx-auto max-w-7xl space-y-8 px-4 py-8 sm:px-6 lg:px-8">

            {{-- Hero / Sambutan --}}
            <section class="relative overflow-hidden rounded-2xl bg-[#0B2345] shadow-lg">
                {{-- Aksen dekoratif --}}
                <div class="absolute -right-16 -top-24 h-64 w-64 rounded-full border-[30px] border-white/5"></div>
                <div class="absolute -bottom-24 right-36 h-48 w-48 rounded-full bg-blue-500/10"></div>
                <div class="absolute right-0 top-0 h-full w-2 bg-[#FFB629]"></div>

                <div class="relative flex flex-col gap-6 p-7 sm:p-10 md:flex-row md:items-center md:justify-between">
                    <div class="max-w-2xl">
                        <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-amber-300/30 bg-white/10 px-3 py-1.5 text-xs font-semibold tracking-wide text-amber-300">
                            <span class="h-2 w-2 rounded-full bg-[#FFB629]"></span>
                            SISTEM INFORMASI PERPUSTAKAAN
                        </div>

                        <h1 class="text-3xl font-bold leading-tight text-white sm:text-4xl">
                            Selamat Datang,
                            <span class="text-[#FFB629]">{{ Auth::user()->name }}!</span>
                        </h1>

                        <p class="mt-4 max-w-xl text-sm leading-7 text-blue-100 sm:text-base">
                            Kelola operasional perpustakaan dengan lebih mudah.
                            Pantau data pengguna, peminjaman, pengembalian,
                            dan koleksi buku melalui satu dashboard.
                        </p>

                        <div class="mt-6 flex flex-wrap gap-3">
                            @can('kelola data pengguna')
                                <a href="{{ route('admin.users.index') }}"
                                   class="inline-flex items-center gap-2 rounded-lg bg-[#FFB629] px-5 py-3 text-sm font-bold text-[#0B2345] transition hover:bg-amber-300">
                                    Kelola Pengguna
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7 7 7-7 7"/>
                                    </svg>
                                </a>
                            @endcan

                            @can('akses dashboard admin')
                                <a href="{{ route('admin.laporan-peminjaman') }}"
                                   class="inline-flex items-center gap-2 rounded-lg border border-white/30 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                                    Lihat Laporan
                                </a>
                            @endcan
                        </div>
                    </div>

                    {{-- Ilustrasi logo sederhana --}}
                    <div class="hidden shrink-0 items-center justify-center md:flex">
                        <div class="flex h-36 w-36 items-center justify-center rounded-full border border-amber-300/40 bg-white/5">
                            <svg class="h-20 w-20 text-[#FFB629]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3"
                                      d="M12 7v14m0-14C10.5 5.8 8.5 5 5 5H3v14h3c2.5 0 4.5.8 6 2m0-14c1.5-1.2 3.5-2 7-2h2v14h-3c-2.5 0-4.5.8-6 2"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3"
                                      d="M6 9h3M6 12h3m6-3h3m-3 3h3"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Judul menu --}}
            <section>
                <div class="mb-5">
                    <h3 class="text-xl font-bold text-slate-900">
                        Menu Pengelolaan
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Pilih layanan yang ingin Anda kelola.
                    </p>
                </div>

                {{-- Kartu menu --}}
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">

                    {{-- Kelola Pengguna --}}
                    @can('kelola data pengguna')
                        <a href="{{ route('admin.users.index') }}"
                           class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg">
                            <div class="flex items-start justify-between">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-[#1769AA] transition group-hover:bg-[#0B2345] group-hover:text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a4 4 0 00-5.5-3.7M17 20H7m10 0v-2c0-.7-.1-1.4-.4-2M7 20H2v-2a4 4 0 015.5-3.7M7 20v-2c0-.7.1-1.4.4-2m0 0a6 6 0 0110.2 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>

                                <span class="text-slate-300 transition group-hover:text-[#FFB629]">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M7 7h10v10"/>
                                    </svg>
                                </span>
                            </div>

                            <h4 class="mt-5 text-lg font-bold text-slate-900">
                                Kelola Pengguna
                            </h4>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Tambah, edit, dan kelola akun pengguna beserta hak aksesnya.
                            </p>

                            <div class="mt-5 flex items-center gap-2 text-sm font-semibold text-[#1769AA] group-hover:text-[#0B2345]">
                                Buka menu
                                <span class="transition group-hover:translate-x-1">→</span>
                            </div>

                            <div class="mt-5 h-1 w-12 rounded-full bg-[#FFB629] transition-all group-hover:w-full"></div>
                        </a>
                    @endcan

                    {{-- Laporan Peminjaman --}}
                    @can('akses dashboard admin')
                        <a href="{{ route('admin.laporan-peminjaman') }}"
                           class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg">
                            <div class="flex items-start justify-between">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600 transition group-hover:bg-[#0B2345] group-hover:text-[#FFB629]">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17v-6m3 6V7m3 10v-4M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span class="text-slate-300 transition group-hover:text-[#FFB629]">↗</span>
                            </div>

                            <h4 class="mt-5 text-lg font-bold text-slate-900">
                                Laporan Peminjaman
                            </h4>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Akses halaman laporan untuk meninjau informasi peminjaman buku.
                            </p>

                            <div class="mt-5 flex items-center gap-2 text-sm font-semibold text-[#1769AA] group-hover:text-[#0B2345]">
                                Buka menu <span class="transition group-hover:translate-x-1">→</span>
                            </div>

                            <div class="mt-5 h-1 w-12 rounded-full bg-[#FFB629] transition-all group-hover:w-full"></div>
                        </a>
                    @endcan

                    {{-- Kelola Peminjaman --}}
                    @can('kelola peminjaman')
                        <a href="{{ route('admin.peminjaman.index') }}"
                           class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg">
                            <div class="flex items-start justify-between">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 transition group-hover:bg-[#0B2345] group-hover:text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1zm3 10h3m-3 3h7"/>
                                    </svg>
                                </div>
                                <span class="text-slate-300 transition group-hover:text-[#FFB629]">↗</span>
                            </div>

                            <h4 class="mt-5 text-lg font-bold text-slate-900">
                                Kelola Peminjaman
                            </h4>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Kelola transaksi peminjaman buku oleh anggota perpustakaan.
                            </p>

                            <div class="mt-5 flex items-center gap-2 text-sm font-semibold text-[#1769AA] group-hover:text-[#0B2345]">
                                Buka menu <span class="transition group-hover:translate-x-1">→</span>
                            </div>

                            <div class="mt-5 h-1 w-12 rounded-full bg-[#FFB629] transition-all group-hover:w-full"></div>
                        </a>
                    @endcan

                    {{-- Kelola Pengembalian --}}
                    @can('kelola pengembalian')
                        <a href="{{ route('admin.pengembalian.index') }}"
                           class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition group-hover:bg-[#0B2345] group-hover:text-[#FFB629]">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5-3v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h12a2 2 0 012 2zM9 5V3h6v2"/>
                                </svg>
                            </div>

                            <h4 class="mt-5 text-lg font-bold text-slate-900">
                                Kelola Pengembalian
                            </h4>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Catat dan pantau proses pengembalian buku oleh anggota.
                            </p>

                            <div class="mt-5 flex items-center gap-2 text-sm font-semibold text-[#1769AA] group-hover:text-[#0B2345]">
                                Buka menu <span class="transition group-hover:translate-x-1">→</span>
                            </div>

                            <div class="mt-5 h-1 w-12 rounded-full bg-[#FFB629] transition-all group-hover:w-full"></div>
                        </a>
                    @endcan

                    {{-- Daftar Buku --}}
                    @can('lihat daftar buku')
                        <a href="{{ route('buku.index') }}"
                           class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-50 text-sky-700 transition group-hover:bg-[#0B2345] group-hover:text-[#FFB629]">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 19.5A2.5 2.5 0 016.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2zM8 6h8M8 10h8"/>
                                </svg>
                            </div>

                            <h4 class="mt-5 text-lg font-bold text-slate-900">
                                Daftar Buku
                            </h4>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Lihat koleksi buku yang tersedia di perpustakaan.
                            </p>

                            <div class="mt-5 flex items-center gap-2 text-sm font-semibold text-[#1769AA] group-hover:text-[#0B2345]">
                                Buka menu <span class="transition group-hover:translate-x-1">→</span>
                            </div>

                            <div class="mt-5 h-1 w-12 rounded-full bg-[#FFB629] transition-all group-hover:w-full"></div>
                        </a>
                    @endcan

                </div>
            </section>

            {{-- Informasi bawah --}}
            <footer class="flex flex-col gap-2 border-t border-slate-200 pt-5 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p>
                    <span class="font-semibold text-[#0B2345]">Perpustakaan</span>
                    <span class="mx-1">·</span>
                    Sistem Informasi Perpustakaan
                </p>
                <p>Panel Administrasi</p>
            </footer>

        </div>
    </div>
</x-app-layout>
