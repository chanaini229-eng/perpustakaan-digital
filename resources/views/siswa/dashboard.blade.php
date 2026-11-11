<x-app-layout>
    {{-- Header Dashboard --}}
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-bold text-[#0B2345]">
                    Dashboard Siswa
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Portal layanan perpustakaan
                </p>
            </div>

            <span class="inline-flex w-fit items-center rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-[#1769AA]">
                Portal Siswa
            </span>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-100 py-8">
        <div class="mx-auto max-w-7xl space-y-8 px-4 sm:px-6 lg:px-8">

            {{-- Banner Sambutan --}}
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#0B2345] to-[#1769AA] p-6 text-white shadow-lg sm:p-9">
                <div class="absolute -right-10 -top-10 h-48 w-48 rounded-full bg-white opacity-5"></div>
                <div class="absolute -bottom-16 right-32 h-48 w-48 rounded-full bg-[#FFB629] opacity-10"></div>

                <div class="relative z-10 max-w-2xl">
                    <span class="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-bold uppercase tracking-widest text-amber-300">
                        Selamat Datang
                    </span>

                    <h1 class="mt-4 text-2xl font-extrabold sm:text-3xl">
                        Halo, {{ auth()->user()->name }}!
                    </h1>

                    <p class="mt-3 text-sm leading-7 text-blue-100 sm:text-base">
                        Selamat datang di Portal Perpustakaan.
                        Temukan buku favoritmu, ajukan peminjaman, dan
                        pantau status peminjaman dengan mudah.
                    </p>

                    @can('lihat daftar buku')
                        <a href="{{ route('buku.index') }}"
                           class="mt-6 inline-flex items-center rounded-lg bg-[#FFB629] px-5 py-3 text-sm font-bold text-[#0B2345] shadow-sm transition hover:-translate-y-0.5 hover:bg-amber-400">
                            Jelajahi Buku
                            <span class="ml-2 text-lg">&rarr;</span>
                        </a>
                    @endcan
                </div>
            </section>

            {{-- Menu Utama --}}
            <section>
                <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-[#0B2345]">
                            Menu Utama
                        </h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Pilih layanan perpustakaan yang ingin kamu gunakan.
                        </p>
                    </div>

                    <div class="h-1 w-16 rounded-full bg-[#FFB629]"></div>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

                    {{-- Card Daftar Buku --}}
                    @can('lihat daftar buku')
                        <a href="{{ route('buku.index') }}"
                           class="group flex min-h-60 flex-col rounded-xl border border-slate-200 border-t-4 border-t-[#1769AA] bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-2xl">
                                📚
                            </div>

                            <h4 class="mt-4 text-lg font-bold text-[#0B2345] group-hover:text-[#1769AA]">
                                Daftar Buku
                            </h4>

                            <p class="mt-2 flex-grow text-sm leading-6 text-slate-500">
                                Lihat koleksi buku dan periksa ketersediaan stok.
                            </p>

                            <span class="mt-4 text-sm font-bold text-[#1769AA]">
                                Lihat koleksi &rarr;
                            </span>
                        </a>
                    @endcan

                    {{-- Card Ajukan Buku --}}
                    @can('mengajukan peminjaman buku')
                        <a href="{{ route('peminjaman.saya.create') }}"
                           class="group flex min-h-60 flex-col rounded-xl border border-slate-200 border-t-4 border-t-[#FFB629] bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-2xl">
                                📝
                            </div>

                            <h4 class="mt-4 text-lg font-bold text-[#0B2345] group-hover:text-[#1769AA]">
                                Ajukan Buku
                            </h4>

                            <p class="mt-2 flex-grow text-sm leading-6 text-slate-500">
                                Ajukan peminjaman buku yang tersedia di perpustakaan.
                            </p>

                            <span class="mt-4 text-sm font-bold text-[#1769AA]">
                                Ajukan sekarang &rarr;
                            </span>
                        </a>
                    @endcan

                    {{-- Card Status Saya --}}
                    @can('melihat status peminjaman sendiri')
                        <a href="{{ route('peminjaman.saya.status') }}"
                           class="group flex min-h-60 flex-col rounded-xl border border-slate-200 border-t-4 border-t-violet-500 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-2xl">
                                🔎
                            </div>

                            <h4 class="mt-4 text-lg font-bold text-[#0B2345] group-hover:text-[#1769AA]">
                                Status Saya
                            </h4>

                            <p class="mt-2 flex-grow text-sm leading-6 text-slate-500">
                                Pantau status pengajuan peminjamanmu.
                            </p>

                            <span class="mt-4 text-sm font-bold text-[#1769AA]">
                                Periksa status &rarr;
                            </span>
                        </a>
                    @endcan

                    {{-- Card Riwayat --}}
                    @can('melihat riwayat peminjaman sendiri')
                        <a href="{{ route('peminjaman.saya.riwayat') }}"
                           class="group flex min-h-60 flex-col rounded-xl border border-slate-200 border-t-4 border-t-emerald-500 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-2xl">
                                📋
                            </div>

                            <h4 class="mt-4 text-lg font-bold text-[#0B2345] group-hover:text-[#1769AA]">
                                Riwayat
                            </h4>

                            <p class="mt-2 flex-grow text-sm leading-6 text-slate-500">
                                Lihat seluruh catatan peminjaman yang pernah kamu ajukan.
                            </p>

                            <span class="mt-4 text-sm font-bold text-[#1769AA]">
                                Lihat riwayat &rarr;
                            </span>
                        </a>
                    @endcan

                </div>

                {{-- Pesan jika tidak memiliki izin menu --}}
                @if (
                    !auth()->user()->can('lihat daftar buku') &&
                    !auth()->user()->can('mengajukan peminjaman buku') &&
                    !auth()->user()->can('melihat status peminjaman sendiri') &&
                    !auth()->user()->can('melihat riwayat peminjaman sendiri')
                )
                    <div class="mt-5 rounded-xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-800">
                        Akunmu belum memiliki izin untuk mengakses menu siswa.
                        Silakan hubungi administrator.
                    </div>
                @endif
            </section>

            {{-- Footer --}}
            <footer class="border-t border-slate-200 py-5 text-center text-sm text-slate-500">
                <span class="font-semibold text-[#0B2345]">
                    Portal Perpustakaan
                </span>

                <span class="mx-2">•</span>

                &copy; {{ date('Y') }} Semua hak dilindungi.
            </footer>

        </div>
    </div>
</x-app-layout>
