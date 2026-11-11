
<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-start gap-4">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#0B2345] text-[#FFB629] shadow-lg">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m16 0v-2a4 4 0 0 0-3-3.87M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7-7.87a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-700">
                            Administrasi Perpustakaan
                        </p>
                        <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-[#0B2345] sm:text-3xl">
                            Kelola Data Anggota
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">
                            Kelola informasi anggota perpustakaan dengan mudah.
                        </p>
                    </div>
                </div>

                <a href="{{ route('petugas.anggota.create') }}"
                   class="inline-flex w-fit items-center gap-2 rounded-xl bg-[#0B2345] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#103B6B]">
                    <svg class="h-5 w-5 text-[#FFB629]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v14m-7-7h14"/>
                    </svg>
                    Tambah Anggota
                </a>
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-800">
                    <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 12 4 4L19 6"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                    <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 18 6M6 6l12 12"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                    <p class="font-bold">Terjadi kesalahan:</p>
                    <ul class="mt-2 list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Banner --}}
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#0B2345] via-[#103B6B] to-[#1769AA] p-6 text-white shadow-lg sm:p-8">
                <div class="absolute right-0 top-0 h-full w-2 bg-[#FFB629]"></div>
                <div class="pointer-events-none absolute -right-10 -top-16 h-48 w-48 rounded-full border-[24px] border-white/5"></div>
                <div class="pointer-events-none absolute -bottom-20 right-32 h-44 w-44 rounded-full border-[20px] border-white/5"></div>

                <div class="relative z-10 max-w-2xl">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-blue-100">
                        <span class="h-2 w-2 rounded-full bg-[#FFB629]"></span>
                        MANAJEMEN ANGGOTA
                    </span>

                    <h2 class="mt-4 text-2xl font-extrabold tracking-tight sm:text-3xl">
                        Data Anggota Perpustakaan
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-blue-100 sm:text-base">
                        Lihat dan kelola informasi anggota yang terdaftar,
                        mulai dari nama, alamat email, hingga nomor telepon.
                    </p>
                </div>
            </section>

            {{-- Ringkasan --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">
                    <div class="absolute left-0 top-0 h-full w-1 bg-[#FFB629]"></div>

                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Total Anggota
                            </p>
                            <p class="mt-3 text-4xl font-extrabold tracking-tight text-[#0B2345]">
                                {{ number_format($anggotas->total(), 0, ',', '.') }}
                            </p>
                            <p class="mt-2 text-xs text-slate-500">
                                Seluruh anggota terdaftar
                            </p>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#0B2345] text-[#FFB629]">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m16 0v-2a4 4 0 0 0-3-3.87M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7-7.87a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">
                    <div class="absolute left-0 top-0 h-full w-1 bg-[#1769AA]"></div>

                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Anggota di Halaman Ini
                            </p>
                            <p class="mt-3 text-4xl font-extrabold tracking-tight text-[#0B2345]">
                                {{ number_format($anggotas->count(), 0, ',', '.') }}
                            </p>
                            <p class="mt-2 text-xs text-slate-500">
                                Data pada halaman saat ini
                            </p>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-[#1769AA]">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Anggota --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex flex-col gap-3 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="h-6 w-1 rounded-full bg-[#FFB629]"></span>
                            <h2 class="text-lg font-extrabold text-[#0B2345]">
                                Daftar Anggota
                            </h2>
                        </div>
                        <p class="mt-2 text-sm text-slate-500">
                            Informasi anggota yang tersimpan dalam sistem.
                        </p>
                    </div>

                    <span class="inline-flex w-fit items-center rounded-full bg-blue-50 px-3 py-1.5 text-xs font-bold text-[#1769AA]">
                        {{ $anggotas->total() }} anggota
                    </span>
                </div>

                @if ($anggotas->isEmpty())
                    <div class="px-6 py-16 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-[#1769AA]">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m16 0v-2a4 4 0 0 0-3-3.87M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/>
                            </svg>
                        </div>

                        <h3 class="mt-4 text-base font-bold text-slate-800">
                            Belum Ada Data Anggota
                        </h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Tambahkan anggota untuk mulai mengelola data perpustakaan.
                        </p>

                        <a href="{{ route('petugas.anggota.create') }}"
                           class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[#0B2345] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#103B6B]">
                            <span class="text-[#FFB629]">+</span>
                            Tambah Anggota
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-[#0B2345]">
                                <tr>
                                    <th scope="col" class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-blue-100">
                                        No.
                                    </th>
                                    <th scope="col" class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-blue-100">
                                        Nama Anggota
                                    </th>
                                    <th scope="col" class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-blue-100">
                                        Email
                                    </th>
                                    <th scope="col" class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-blue-100">
                                        No. Telepon
                                    </th>
                                    <th scope="col" class="whitespace-nowrap px-5 py-4 text-center text-xs font-bold uppercase tracking-wider text-blue-100">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @foreach ($anggotas as $anggota)
                                    <tr class="transition-colors duration-150 hover:bg-blue-50/60">
                                        <td class="whitespace-nowrap px-5 py-4 text-sm font-semibold text-slate-400">
                                            {{ $anggotas->firstItem() + $loop->index }}
                                        </td>

                                        <td class="px-5 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#0B2345] text-sm font-extrabold text-[#FFB629]">
                                                    {{ strtoupper(substr($anggota->nama, 0, 1)) }}
                                                </div>
                                                <div class="font-bold text-slate-800">
                                                    {{ $anggota->nama }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-5 py-4 text-sm text-slate-600">
                                            {{ $anggota->email }}
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                            {{ $anggota->no_telepon ?: '-' }}
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('petugas.anggota.edit', $anggota) }}"
                                                   class="inline-flex items-center gap-1.5 rounded-lg bg-amber-100 px-3 py-2 text-xs font-bold text-amber-800 transition hover:bg-amber-200">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                            d="m14.5 5.5 4 4M4 20l4.5-1 10.8-10.8a2.1 2.1 0 0 0-3-3L5.5 16 4 20Z"/>
                                                    </svg>
                                                    Edit
                                                </a>

                                                <form action="{{ route('petugas.anggota.destroy', $anggota) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus anggota {{ addslashes($anggota->nama) }}?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1.5 rounded-lg bg-red-100 px-3 py-2 text-xs font-bold text-red-700 transition hover:bg-red-200">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                                d="M4 7h16m-10 4v6m4-6v6M6 7l1 14h10l1-14M9 7V4h6v3"/>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="flex flex-col gap-3 border-t border-slate-100 bg-slate-50 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                        <p class="text-sm text-slate-500">
                            Menampilkan
                            <span class="font-bold text-slate-700">{{ $anggotas->firstItem() ?? 0 }}</span>
                            sampai
                            <span class="font-bold text-slate-700">{{ $anggotas->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-bold text-slate-700">{{ $anggotas->total() }}</span>
                            anggota
                        </p>

                        <div>
                            {{ $anggotas->links() }}
                        </div>
                    </div>
                @endif
            </section>

            {{-- Footer --}}
            <div class="flex items-center justify-center gap-2 pb-2 text-xs text-slate-400">
                <span class="h-1.5 w-1.5 rounded-full bg-[#FFB629]"></span>
                Sistem Informasi Perpustakaan
            </div>
        </div>
    </div>
</x-app-layout>
