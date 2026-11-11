<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-600">
                    Administrasi Perpustakaan
                </p>
                <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-slate-900">
                    Kelola Pengembalian
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Pantau dan catat pengembalian buku anggota.
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-amber-400 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M12 3l7.5 4.5v5.25c0 4.25-3.1 7.15-7.5 9-4.4-1.85-7.5-4.75-7.5-9V7.5L12 3Z" />
                </svg>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Banner --}}
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-blue-950 to-blue-800 p-6 text-white shadow-xl sm:p-8">
                <div class="absolute -right-10 -top-16 h-56 w-56 rounded-full border-[28px] border-white/5"></div>
                <div class="absolute -bottom-20 right-36 h-48 w-48 rounded-full bg-amber-400/10 blur-2xl"></div>

                <div class="relative z-10 max-w-2xl">
                    <span class="inline-flex items-center gap-2 rounded-full border border-amber-300/30 bg-amber-300/10 px-3 py-1 text-xs font-semibold text-amber-300">
                        <span class="h-2 w-2 rounded-full bg-amber-400"></span>
                        Layanan Sirkulasi
                    </span>

                    <h3 class="mt-4 text-2xl font-extrabold sm:text-3xl">
                        Pengembalian Buku
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-blue-100 sm:text-base">
                        Kelola buku yang telah disetujui untuk dipinjam dan pastikan
                        setiap transaksi pengembalian tercatat dengan baik.
                    </p>
                </div>
            </div>

            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 shadow-sm"
                    role="status">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m5 12 4 4L19 6" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Berhasil</p>
                        <p class="mt-1 text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Notifikasi gagal --}}
            @if (session('error'))
                <div class="flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 text-red-800 shadow-sm"
                    role="alert">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Pengembalian gagal</p>
                        <p class="mt-1 text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            {{-- Notifikasi validasi --}}
            @if ($errors->any())
                <div class="rounded-2xl border border-red-200 bg-red-50 p-4 text-red-800 shadow-sm"
                    role="alert">
                    <p class="font-bold">Transaksi tidak dapat diproses</p>
                    <ul class="mt-2 list-inside list-disc space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Statistik --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Total Transaksi
                            </p>
                            <p class="mt-2 text-3xl font-extrabold text-slate-900">
                                {{ $totalTransaksi ?? $peminjamans->total() }}
                            </p>
                            <p class="mt-1 text-xs text-slate-400">
                                Seluruh data peminjaman
                            </p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 0 1 1 1v13H4V6a1 1 0 0 1 1-1Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-amber-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Belum Dikembalikan
                            </p>
                            <p class="mt-2 text-3xl font-extrabold text-amber-600">
                                {{ $belumDikembalikan ?? $peminjamans->getCollection()->where('status', 'disetujui')->whereNull('tanggal_kembali')->count() }}
                            </p>
                            <p class="mt-1 text-xs text-slate-400">
                                Peminjaman aktif
                            </p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.8">
                                <circle cx="12" cy="12" r="9" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 7v5l3 2" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-emerald-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Sudah Dikembalikan
                            </p>
                            <p class="mt-2 text-3xl font-extrabold text-emerald-600">
                                {{ $sudahDikembalikan ?? $peminjamans->getCollection()->whereNotNull('tanggal_kembali')->count() }}
                            </p>
                            <p class="mt-1 text-xs text-slate-400">
                                Transaksi selesai
                            </p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m5 12 4 4L19 6" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Tabel data --}}
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div class="flex flex-col gap-3 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900">
                            Data Pengembalian Buku
                        </h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Hanya peminjaman yang telah disetujui dapat diproses pengembaliannya.
                        </p>
                    </div>

                    <span class="inline-flex w-fit items-center rounded-full bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-800">
                        {{ $peminjamans->total() }} transaksi
                    </span>
                </div>

                @if ($peminjamans->isEmpty())
                    <div class="px-6 py-16 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 6.5A2.5 2.5 0 0 1 6.5 4H20v16H6.5A2.5 2.5 0 0 1 4 17.5v-11Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 17.5A2.5 2.5 0 0 1 6.5 15H20" />
                            </svg>
                        </div>
                        <h4 class="mt-4 text-base font-bold text-slate-800">
                            Belum ada data peminjaman
                        </h4>
                        <p class="mt-1 text-sm text-slate-500">
                            Data transaksi akan ditampilkan di sini jika tersedia.
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                        No.
                                    </th>
                                    <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                        Anggota
                                    </th>
                                    <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                        Buku
                                    </th>
                                    <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                        Tanggal Pinjam
                                    </th>
                                    <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                        Tanggal Kembali
                                    </th>
                                    <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                        Status
                                    </th>
                                    <th class="whitespace-nowrap px-5 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @foreach ($peminjamans as $peminjaman)
                                    @php
                                        $status = $peminjaman->status ?? 'disetujui';

                                        if ($peminjaman->tanggal_kembali !== null) {
                                            $labelStatus = 'Sudah Dikembalikan';
                                            $warnaStatus = 'emerald';
                                        } elseif ($status === 'menunggu') {
                                            $labelStatus = 'Menunggu Persetujuan';
                                            $warnaStatus = 'amber';
                                        } elseif ($status === 'ditolak') {
                                            $labelStatus = 'Ditolak';
                                            $warnaStatus = 'red';
                                        } elseif ($status === 'disetujui') {
                                            $labelStatus = 'Belum Dikembalikan';
                                            $warnaStatus = 'blue';
                                        } else {
                                            $labelStatus = ucfirst($status);
                                            $warnaStatus = 'slate';
                                        }
                                    @endphp

                                    <tr class="transition hover:bg-blue-50/40">
                                        <td class="whitespace-nowrap px-5 py-4 text-sm font-semibold text-slate-500">
                                            {{ $peminjamans->firstItem() + $loop->index }}
                                        </td>

                                        <td class="px-5 py-4">
                                            <div class="font-semibold text-slate-800">
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
                                            {{ $peminjaman->tanggal_pinjam?->format('d/m/Y') ?? $peminjaman->tanggal_pinjam ?? '-' }}
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                            {{ $peminjaman->tanggal_kembali?->format('d/m/Y') ?? $peminjaman->tanggal_kembali ?? '-' }}
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4">
                                            @if ($warnaStatus === 'emerald')
                                                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                    {{ $labelStatus }}
                                                </span>
                                            @elseif ($warnaStatus === 'amber')
                                                <span class="inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                    {{ $labelStatus }}
                                                </span>
                                            @elseif ($warnaStatus === 'red')
                                                <span class="inline-flex items-center gap-2 rounded-full border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                                    {{ $labelStatus }}
                                                </span>
                                            @elseif ($warnaStatus === 'blue')
                                                <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                                    {{ $labelStatus }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-bold text-slate-600">
                                                    {{ $labelStatus }}
                                                </span>
                                            @endif
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4 text-center">
                                            @if ($peminjaman->tanggal_kembali !== null)
                                                <span class="inline-flex items-center gap-1.5 rounded-xl bg-slate-100 px-3 py-2 text-xs font-bold text-slate-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m5 12 4 4L19 6" />
                                                    </svg>
                                                    Selesai
                                                </span>
                                            @elseif ($status === 'disetujui')
                                                <form
                                                    action="{{ route('admin.pengembalian.proses', $peminjaman->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin mencatat buku ini sudah dikembalikan?')"
                                                >
                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-slate-900 to-blue-800 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:from-blue-900 hover:to-blue-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-4 w-4" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m5 12 4 4L19 6" />
                                                        </svg>
                                                        Kembalikan
                                                    </button>
                                                </form>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 rounded-xl bg-slate-100 px-3 py-2 text-xs font-bold text-slate-500">
                                                    Belum dapat diproses
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="flex flex-col gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                        <p class="text-sm text-slate-500">
                            Menampilkan
                            <span class="font-bold text-slate-700">{{ $peminjamans->firstItem() ?? 0 }}</span>
                            sampai
                            <span class="font-bold text-slate-700">{{ $peminjamans->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-bold text-slate-700">{{ $peminjamans->total() }}</span>
                            data
                        </p>

                        <div class="pagination-perpustakaan">
                            {{ $peminjamans->links() }}
                        </div>
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-center gap-2 pb-2 text-xs text-slate-400">
                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                Sistem Informasi Perpustakaan
            </div>
        </div>
    </div>
</x-app-layout>
