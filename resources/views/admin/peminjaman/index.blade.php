<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-start gap-4">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#0B2345] text-[#FFB629] shadow-lg">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M8 5H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M8 5a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2M8 5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2m-8 8h8m-8 4h8"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-700">
                            Administrasi Perpustakaan
                        </p>
                        <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-[#0B2345] sm:text-3xl">
                            Kelola Peminjaman
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">
                            Pantau transaksi peminjaman buku anggota perpustakaan.
                        </p>
                    </div>
                </div>

                <span class="inline-flex w-fit items-center gap-2 rounded-xl border border-blue-100 bg-white px-4 py-3 text-sm font-semibold text-[#0B2345] shadow-sm">
                    <span class="h-2.5 w-2.5 rounded-full bg-[#FFB629]"></span>
                    Data Peminjaman
                </span>
            </div>

            {{-- Notifikasi sukses dan error --}}
            @if (session('success'))
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                    <p class="font-bold">Pengajuan belum dapat diproses:</p>
                    <ul class="mt-2 list-inside list-disc">
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
                        LAYANAN SIRKULASI
                    </span>

                    <h2 class="mt-4 text-2xl font-extrabold tracking-tight sm:text-3xl">
                        Data Transaksi Peminjaman
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-blue-100 sm:text-base">
                        Lihat daftar anggota, buku yang dipinjam, tanggal peminjaman,
                        status pengajuan, serta proses persetujuan dan penolakan.
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
                                Total Transaksi
                            </p>
                            <p class="mt-3 text-4xl font-extrabold tracking-tight text-[#0B2345]">
                                {{ number_format($peminjamans->total(), 0, ',', '.') }}
                            </p>
                            <p class="mt-2 text-xs text-slate-500">
                                Seluruh data peminjaman
                            </p>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#0B2345] text-[#FFB629]">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">
                    <div class="absolute left-0 top-0 h-full w-1 bg-[#1769AA]"></div>

                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Transaksi di Halaman Ini
                            </p>
                            <p class="mt-3 text-4xl font-extrabold tracking-tight text-[#0B2345]">
                                {{ number_format($peminjamans->count(), 0, ',', '.') }}
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

            {{-- Tabel --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex flex-col gap-3 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="h-6 w-1 rounded-full bg-[#FFB629]"></span>
                            <h2 class="text-lg font-extrabold text-[#0B2345]">
                                Daftar Peminjaman Buku
                            </h2>
                        </div>
                        <p class="mt-2 text-sm text-slate-500">
                            Informasi transaksi dan status pengajuan peminjaman buku.
                        </p>
                    </div>

                    <span class="inline-flex w-fit items-center rounded-full bg-blue-50 px-3 py-1.5 text-xs font-bold text-[#1769AA]">
                        {{ $peminjamans->total() }} transaksi
                    </span>
                </div>

                @if ($peminjamans->isEmpty())
                    <div class="px-6 py-16 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-[#1769AA]">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 1 4 16.5v-11zM4 16.5A2.5 2.5 0 0 1 6.5 14H20"/>
                            </svg>
                        </div>

                        <h3 class="mt-4 text-base font-bold text-slate-800">
                            Belum Ada Data Peminjaman
                        </h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Data transaksi peminjaman akan ditampilkan di sini setelah tersedia.
                        </p>
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
                                        Anggota
                                    </th>
                                    <th scope="col" class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-blue-100">
                                        Buku
                                    </th>
                                    <th scope="col" class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-blue-100">
                                        Tanggal Pinjam
                                    </th>
                                    <th scope="col" class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-blue-100">
                                        Tanggal Kembali
                                    </th>
                                    <th scope="col" class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-blue-100">
                                        Status
                                    </th>
                                    <th scope="col" class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-blue-100">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @foreach ($peminjamans as $peminjaman)
                                    @php
                                        $status = $peminjaman->tanggal_kembali
                                            ? 'dikembalikan'
                                            : ($peminjaman->status ?? 'disetujui');
                                    @endphp

                                    <tr class="transition-colors duration-150 hover:bg-blue-50/60">
                                        <td class="whitespace-nowrap px-5 py-4 text-sm font-semibold text-slate-400">
                                            {{ $peminjamans->firstItem() + $loop->index }}
                                        </td>

                                        <td class="px-5 py-4">
                                            <div class="font-bold text-slate-800">
                                                {{ $peminjaman->anggota->nama ?? 'Anggota tidak ditemukan' }}
                                            </div>
                                            <div class="mt-1 text-xs text-slate-400">
                                                ID transaksi: #{{ $peminjaman->id }}
                                            </div>
                                        </td>

                                        <td class="px-5 py-4">
                                            <div class="max-w-xs font-medium leading-5 text-slate-700">
                                                {{ $peminjaman->buku->judul ?? 'Buku tidak ditemukan' }}
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                            {{ $peminjaman->tanggal_pinjam ?? '-' }}
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                            {{ $peminjaman->tanggal_kembali ?? '-' }}
                                        </td>

                                        {{-- Status --}}
                                        <td class="whitespace-nowrap px-5 py-4">
                                            @if ($status === 'menunggu')
                                                <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-800">
                                                    Menunggu
                                                </span>
                                            @elseif ($status === 'disetujui')
                                                <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-bold text-blue-800">
                                                    Disetujui
                                                </span>
                                            @elseif ($status === 'ditolak')
                                                <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-800">
                                                    Ditolak
                                                </span>
                                            @else
                                                <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-800">
                                                    Dikembalikan
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Aksi --}}
                                        <td class="px-5 py-4">
                                            @if ($status === 'menunggu')
                                                <div class="flex flex-wrap gap-2">
                                                    <form method="POST"
                                                        action="{{ route('admin.peminjaman.setujui', $peminjaman->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            onclick="return confirm('Setujui pengajuan peminjaman ini?')"
                                                            class="rounded-lg bg-emerald-600 px-3 py-2 text-xs font-bold text-white transition hover:bg-emerald-700">
                                                            Setujui
                                                        </button>
                                                    </form>

                                                    <form method="POST"
                                                        action="{{ route('admin.peminjaman.tolak', $peminjaman->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            onclick="return confirm('Yakin ingin menolak pengajuan ini?')"
                                                            class="rounded-lg bg-red-600 px-3 py-2 text-xs font-bold text-white transition hover:bg-red-700">
                                                            Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-xs text-slate-400">
                                                    Tidak ada tindakan
                                                </span>
                                            @endif
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
                            <span class="font-bold text-slate-700">{{ $peminjamans->firstItem() ?? 0 }}</span>
                            sampai
                            <span class="font-bold text-slate-700">{{ $peminjamans->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-bold text-slate-700">{{ $peminjamans->total() }}</span>
                            data
                        </p>

                        <div>
                            {{ $peminjamans->links() }}
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
