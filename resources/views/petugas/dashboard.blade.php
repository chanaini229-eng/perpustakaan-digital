<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#0B2345] text-white shadow-md">
                <svg class="h-6 w-6" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="1.8"
                          d="M4 19.5A2.5 2.5 0 016.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
                </svg>
            </div>

            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-[#0B2345]">
                    Dashboard Petugas
                </h2>
                <p class="text-xs text-gray-500">
                    Pusat pengelolaan operasional perpustakaan
                </p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8 sm:py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Banner Sambutan --}}
            <div class="relative mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-[#0B2345] via-[#123D70] to-[#1769AA] p-6 text-white shadow-xl sm:p-9">
                <div class="absolute -right-10 -top-16 h-56 w-56 rounded-full border-[28px] border-white/5"></div>
                <div class="absolute -bottom-20 right-40 h-52 w-52 rounded-full bg-[#FFB629]/10"></div>

                <div class="relative z-10 max-w-2xl">
                    <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-xs font-semibold tracking-wide text-blue-100">
                        <span class="h-2 w-2 rounded-full bg-[#FFB629]"></span>
                        PANEL OPERASIONAL
                    </div>

                    <h1 class="text-2xl font-extrabold leading-tight sm:text-3xl lg:text-4xl">
                        Selamat Datang,
                        <span class="text-[#FFB629]">{{ Auth::user()->name }}</span>!
                    </h1>

                    <p class="mt-3 max-w-xl text-sm leading-6 text-blue-100 sm:text-base">
                        Kelola data anggota, peminjaman, pengembalian, dan koleksi buku
                        melalui satu dashboard yang terintegrasi.
                    </p>

                    <div class="mt-6 flex flex-wrap items-center gap-3 text-sm">
                        <span class="inline-flex items-center gap-2 rounded-lg bg-white/10 px-3 py-2">
                            <svg class="h-4 w-4 text-[#FFB629]" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Sistem Perpustakaan
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-lg bg-white/10 px-3 py-2">
                            <svg class="h-4 w-4 text-[#FFB629]" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 3a11.955 11.955 0 01-8.618 2.984A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.042-.133-2.053-.382-3.016z"/>
                            </svg>
                            Akses Petugas
                        </span>
                    </div>
                </div>
            </div>

            {{-- Judul Menu --}}
            <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h3 class="text-xl font-extrabold text-[#0B2345] sm:text-2xl">
                        Menu Pengelolaan
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Pilih menu untuk mulai menjalankan tugas.
                    </p>
                </div>

                <div class="inline-flex w-fit items-center gap-2 rounded-lg border border-amber-200 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-800">
                    <span class="h-2 w-2 rounded-full bg-[#FFB629]"></span>
                    Panel Petugas Aktif
                </div>
            </div>

            {{-- Kartu Menu --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

                @can('kelola data anggota')
                    <a href="{{ route('petugas.anggota.index') }}"
                       class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl">
                        <div class="absolute left-0 top-0 h-1 w-full bg-gradient-to-r from-[#0B2345] to-[#1769AA]"></div>

                        <div class="flex items-start justify-between">
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-50 text-[#1769AA] transition group-hover:bg-[#1769AA] group-hover:text-white">
                                <svg class="h-7 w-7" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M17 20h5v-2a3 3 0 00-5.196-2.04M17 20H7m10 0v-2c0-.728-.195-1.411-.536-2M7 20H2v-2a3 3 0 015.196-2.04M7 20v-2c0-.728.195-1.411.536-2m0 0a5.002 5.002 0 019.928 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-bold text-[#1769AA]">
                                Anggota
                            </span>
                        </div>

                        <h4 class="mt-5 text-lg font-extrabold text-[#0B2345]">
                            Kelola Data Anggota
                        </h4>
                        <p class="mt-2 min-h-[48px] text-sm leading-6 text-gray-500">
                            Tambah, perbarui, dan kelola data anggota perpustakaan.
                        </p>

                        <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4 text-sm font-bold text-[#1769AA]">
                            Buka menu
                            <svg class="h-5 w-5 transition group-hover:translate-x-1"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @endcan

                @can('kelola peminjaman')
                    <a href="{{ route('admin.peminjaman.index') }}"
                       class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl">
                        <div class="absolute left-0 top-0 h-1 w-full bg-gradient-to-r from-[#1769AA] to-cyan-400"></div>

                        <div class="flex items-start justify-between">
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-cyan-50 text-cyan-700 transition group-hover:bg-cyan-700 group-hover:text-white">
                                <svg class="h-7 w-7" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M8 7V3m8 4V3M5 11h14M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"/>
                                </svg>
                            </div>
                            <span class="rounded-full bg-cyan-50 px-2.5 py-1 text-xs font-bold text-cyan-700">
                                Transaksi
                            </span>
                        </div>

                        <h4 class="mt-5 text-lg font-extrabold text-[#0B2345]">
                            Kelola Peminjaman
                        </h4>
                        <p class="mt-2 min-h-[48px] text-sm leading-6 text-gray-500">
                            Periksa permohonan dan kelola transaksi peminjaman buku.
                        </p>

                        <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4 text-sm font-bold text-[#1769AA]">
                            Buka menu
                            <svg class="h-5 w-5 transition group-hover:translate-x-1"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @endcan

                @can('kelola pengembalian')
                    <a href="{{ route('admin.pengembalian.index') }}"
                       class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-amber-200 hover:shadow-xl">
                        <div class="absolute left-0 top-0 h-1 w-full bg-gradient-to-r from-[#FFB629] to-amber-500"></div>

                        <div class="flex items-start justify-between">
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-amber-50 text-amber-600 transition group-hover:bg-[#FFB629] group-hover:text-[#0B2345]">
                                <svg class="h-7 w-7" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M3 10h11m0 0l-4-4m4 4l-4 4m5-8h2a2 2 0 012 2v8a2 2 0 01-2 2h-2"/>
                                </svg>
                            </div>
                            <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-700">
                                Pengembalian
                            </span>
                        </div>

                        <h4 class="mt-5 text-lg font-extrabold text-[#0B2345]">
                            Kelola Pengembalian
                        </h4>
                        <p class="mt-2 min-h-[48px] text-sm leading-6 text-gray-500">
                            Catat pengembalian buku dan pantau transaksi yang selesai.
                        </p>

                        <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4 text-sm font-bold text-amber-600">
                            Buka menu
                            <svg class="h-5 w-5 transition group-hover:translate-x-1"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @endcan

                @can('lihat daftar buku')
                    <a href="{{ route('buku.index') }}"
                       class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl">
                        <div class="absolute left-0 top-0 h-1 w-full bg-gradient-to-r from-indigo-500 to-[#1769AA]"></div>

                        <div class="flex items-start justify-between">
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-50 text-indigo-700 transition group-hover:bg-indigo-700 group-hover:text-white">
                                <svg class="h-7 w-7" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M12 7v14m0-14C10.832 5.817 9.246 5 7.5 5S4.168 5.817 3 7v14c1.168-1.183 2.754-2 4.5-2s3.332.817 4.5 2m0-12c1.168-1.183 2.754-2 4.5-2S19.832 5.817 21 7v14c-1.168-1.183-2.754-2-4.5-2S13.168 19.817 12 21"/>
                                </svg>
                            </div>
                            <span class="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-bold text-indigo-700">
                                Koleksi
                            </span>
                        </div>

                        <h4 class="mt-5 text-lg font-extrabold text-[#0B2345]">
                            Daftar Buku
                        </h4>
                        <p class="mt-2 min-h-[48px] text-sm leading-6 text-gray-500">
                            Lihat koleksi buku dan informasi ketersediaan buku.
                        </p>

                        <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4 text-sm font-bold text-[#1769AA]">
                            Buka menu
                            <svg class="h-5 w-5 transition group-hover:translate-x-1"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @endcan

            </div>

            {{-- Informasi --}}
            <div class="mt-8 rounded-2xl border border-blue-100 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex items-start gap-4">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#0B2345] text-[#FFB629]">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 110-20 10 10 0 010 20z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#0B2345]">
                            Informasi Penggunaan
                        </h4>
                        <p class="mt-1 text-sm leading-6 text-gray-500">
                            Menu yang tampil menyesuaikan hak akses akun Anda.
                            Jika menu tertentu tidak muncul, periksa kembali role
                            dan permission yang diberikan kepada akun Petugas.
                        </p>
                    </div>
                </div>
            </div>

            <p class="mt-6 text-center text-xs text-gray-400">
                Sistem Informasi Perpustakaan
            </p>
        </div>
    </div>
</x-app-layout>
